<?php

namespace Admin\Http\Controllers\Api;

use AhsanDev\Support\Authorization\Http\Controllers\AuthorizeController;
use App\Models\Milestone;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectStatisticsController extends AuthorizeController
{
    /**
     * @param Request $request
     * @param $id
     * @return int[]
     */
    public function __invoke(Request $request, $id)
    {
        return [
            'project_progress' => $this->getProjectProgress($id),
            'opened_tasks' => $this->decimalRepresentation($this->getOpenedTasksCount($id), Task::count()),
            'completed_tasks' => $this->decimalRepresentation($this->getCompletedTasksCount($id), Task::count()),
            'opened_milestones' => $this->getOpenedMilestonesCount(),
            'completed_milestones' => $this->getCompletedMilestonesCount(),
        ];
    }

    /**
     * @param $id
     * @return float
     */
    public function getProjectProgress($id): float
    {
        return $this->decimalRepresentation($this->getCompletedTasksCount($id), Task::count());
    }

    /**
     * @param $id
     * @return float
     */
    public function getOpenedTasksCount($id): float
    {
        $query = Task::where('completed_at', null)->where('project_id', $id);
        return $query->count();
    }

    /**
     * @param $id
     * @return float
     */
    public function getCompletedTasksCount($id): float
    {
        $query = Task::where('completed_at', '!=', null)->where('project_id', $id);
        return $query->count();
    }

    /**
     * @return float
     */
    public function getOpenedMilestonesCount(): float
    {
        $query = Milestone::join('tasks', 'tasks.milestone_id', 'milestones.id')
            ->where('tasks.completed_at', null)->groupBy('milestones.id');

        return $this->decimalRepresentation($query->count(), Milestone::count());
    }

    /**
     * @return float
     */
    public function getCompletedMilestonesCount(): float
    {
        $query = Milestone::join('tasks', 'tasks.milestone_id', 'milestones.id')
            ->where('tasks.completed_at', '!=', null)->groupBy('milestones.id');

        return $this->decimalRepresentation($query->count(), Milestone::count());
    }

    /**
     * @param float $numerator
     * @param float $denominator
     * @return float
     */

    protected function decimalRepresentation(float $numerator, float $denominator): float
    {
        return number_format(($numerator / max(1, $denominator) * 100), 2);
    }
}
