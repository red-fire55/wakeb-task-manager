<?php

namespace App\Http\Requests;


use AhsanDev\Support\Requests\FormRequest;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

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
            'tasks' => 'nullable|array',
            'project_id' => 'nullable|exists:projects,id',
            'project_list_id' => 'nullable|exists:project_lists,id',
        ];
    }

    public function transaction(): void
    {
        DB::transaction(function () {
            unset($this->attributes['tasks']);
            $this->model->forceFill($this->attributes);
            $this->model->save();

            // add milestone id for each task
            if ($this->request->tasks) {
                //old tasks =>> needed in update
                $old_tasks = $this->model->tasks->pluck('id')->toArray();
                $tasksToDelete = array_diff($old_tasks, $this->request->tasks);
                if (!empty($tasksToDelete)) {
                    Task::whereIn('id', $tasksToDelete)->update(['milestone_id' => null]);
                }
                foreach ($this->request->tasks as $task_id) {
                    Task::find($task_id)?->update(['milestone_id' => $this->model->id]);
                }
            }
        });
    }
}
