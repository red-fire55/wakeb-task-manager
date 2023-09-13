<?php

namespace App\Http\Requests;


use AhsanDev\Support\Requests\FormRequest;
use App\Models\Milestone;
use App\Models\Note;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class MilestoneRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'start_date' => 'required',
            'end_date' => 'required',
            'order' => 'sometimes|integer',
            'tasks' => 'nullable|array',
            'project_id' => 'nullable|exists:projects,id',
            'project_list_id' => 'nullable|exists:project_lists,id',
            'note' => 'nullable'
        ];
    }

    public function transaction(): void
    {
        DB::transaction(function () {
            unset($this->attributes['tasks']);
            unset($this->attributes['note']);
            $this->model->forceFill($this->attributes);
            $this->model->save();

            // add milestone id for each task
            // if ($this->request->tasks) {
            //     //old tasks =>> needed in update
            //     $old_tasks = $this->model->tasks->pluck('id')->toArray();
            //     $tasksToDelete = array_diff($old_tasks, $this->request->tasks);
            //     if (!empty($tasksToDelete)) {
            //         Task::whereIn('id', $tasksToDelete)->update(['milestone_id' => null]);
            //     }
            //     foreach ($this->request->tasks as $task_id) {
            //         Task::find($task_id)?->update(['milestone_id' => $this->model->id]);
            //     }
            // }

            if ($this->request->note) {
                //last note =>> needed to update his status
                $action = "Created";
                $properties = ['attributes' => array_merge($this->model->getAttributes(), ['note' => $this->request->note])];
                if (!$this->model->wasRecentlyCreated) {
                    $action = "Updated";
                    $old_milestone = Activity::where('subject_type', Milestone::class)
                        ->where('subject_id', $this->model->id)
                        ->latest()
                        ->first();
                    $properties = ['old' => $this->getOldMilestoneFormat($old_milestone), 'new' => array_merge($this->model->getAttributes(), ['note' => $this->request->note])];
                }
                activity()
                    ->causedBy(auth()->user())
                    ->performedOn($this->model)
                    ->withProperties($properties)
                    ->log($action);
            }
        });
    }

    /**
     * @param $old_milestone
     * @return array
     */
    private function getOldMilestoneFormat($old_milestone): array
    {
        if (property_exists($old_milestone, 'new'))
            return (array)json_decode($old_milestone->properties)->new;
        return (array)json_decode($old_milestone->properties)->attributes;
    }
}
