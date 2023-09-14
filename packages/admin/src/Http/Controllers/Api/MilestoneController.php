<?php

namespace Admin\Http\Controllers\Api;

use AhsanDev\Support\Field;
use App\Http\Controllers\Controller;
use App\Http\Requests\MilestoneRequest;
use App\Models\Milestone;
use App\Models\Task;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class MilestoneController extends Controller
{

    /**
     * @param Request $request
     * @return Paginator
     */
    public function index(Request $request): Paginator
    {
        $query = Milestone::query();
        if ($request->has('project_id'))
            $query = $query->where('project_id', '=', $request->project_id);
        return $query->with(['tasks'])->simplePaginate($request->input('per_page', 10));
    }


    /**
     * @return Collection
     */
    public function getAllMilestones(): Collection
    {
        return Milestone::options();
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
        return $this->fields(Milestone::find($milestone_id));
    }

    /**
     * @param $milestone_id
     * @return Field
     */
    public function edit($milestone_id): Field
    {
        return $this->fields(Milestone::find($milestone_id));
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
        Activity::where('subject_type', Milestone::class)->where('subject_id', $milestone->id)->delete();
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
            ->field('order', $model->order)
            ->field('start_date', $model->start_date)
            ->field('end_date', $model->end_date)
            ->field('tasks', $model->tasks()->get(), Task::options())
            ->field('note',)
            ->field('project', $model->project()->get() ?? null, ['send project id as a foreign key']);
    }
}
