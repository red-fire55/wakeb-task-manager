<?php

namespace Admin\Http\Controllers\Api;

use AhsanDev\Support\Field;
use App\Http\Controllers\Controller;
use App\Http\Requests\MilestoneRequest;
use App\Models\Milestone;
use App\Models\Task;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{

    public function index()
    {
        $query = Milestone::query();
        return $query->with('tasks')->get();
    }

    /**
     * @param Milestone $milestone
     * @return Field
     */
    public function create(Milestone $milestone): Field
    {
        return $this->fields($milestone);
    }

    /**
     * @param Request $request
     * @return MilestoneRequest
     */
    public function store(Request $request, Milestone $milestone): MilestoneRequest
    {
        return new MilestoneRequest($request, $milestone);
    }

    /**
     * @param $milestone_id
     * @return Field
     */
    public function show($milestone_id): Field
    {
        return $this->fields(Milestone::find($milestone_id)->first());
    }

    /**
     * @param $milestone_id
     * @return Field
     */
    public function edit($milestone_id): Field
    {
        return $this->fields(Milestone::find($milestone_id)->first());
    }

    /**
     * @param Request $request
     * @param Milestone $milestone
     * @return MilestoneRequest
     */
    public function update(Request $request, Milestone $milestone)
    {
        return new MilestoneRequest($request, $milestone);
    }

    /**
     * @param $milestone_id
     * @return string[]
     */
    public function destroy($milestone_id): array
    {
        $milestone = Milestone::find($milestone_id);
        $milestone->tasks()->update(['milestone_id' => null]);
        $milestone->delete();
        return ['message' => 'Milestone deleted successfully'];
    }

    /**
     * @param $model
     * @return Field
     */
    private function fields($model): Field
    {
        return Field::make()
            ->field('id', $model->id)
            ->field('name', $model->name)
            ->field('start_date', $model->start_date)
            ->field('end_date', $model->end_date)
            ->field('tasks', $model->tasks()->get(),Task::all()->toArray())
            ->field('project', $model->project()->get() ?? null, ['send project id as a foreign key'])
            ->field('projectList', $model->projectList()->get() ?? null, ['send project list id as a foreign key']);
    }
}
