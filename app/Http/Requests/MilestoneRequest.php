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

            $old_milestone = Activity::where('subject_type', Milestone::class)
                ->where('subject_id', $this->model->id)
                ->latest()
                ->first();
            //dd($this->checkIfNoteIsChanged($old_milestone, $this->request->note));
            if ($this->request->note && $this->checkIfNoteIsChanged($old_milestone, $this->request->note)) {
                //last note =>> needed to update his status
                if (!$this->model->wasRecentlyCreated) {
                    $action = "Updated";

                    $properties = ['old' => $this->getOldMilestoneFormat($old_milestone), 'new' => array_merge(['note' => $this->request->note])];
                    activity()
                        ->causedBy(auth()->user())
                        ->performedOn($this->model)
                        ->withProperties($properties)
                        ->log($action);
                }
            }
        });
    }

    /**
     * @param $old_milestone
     * @return array
     */
    private function getOldMilestoneFormat($old_milestone): array
    {
        if ($old_milestone && property_exists(json_decode($old_milestone?->properties), 'new'))
            return (array)json_decode($old_milestone->properties)->new;
        return [];
    }

    /**
     * @param $old_milestone
     * @param $newNote
     * @return bool
     */
    private function checkIfNoteIsChanged($old_milestone, $newNote): bool
    {
        if (!$old_milestone)
            return true;
        $attributes = json_decode($old_milestone->properties);
        if (!property_exists($attributes, 'new'))
            return true;

        if (!isset($attributes->new->note))
            return true;
        return $attributes->new->note != $newNote;
    }

}
