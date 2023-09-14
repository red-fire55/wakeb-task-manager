<?php

namespace Admin\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProjectFilters;
use App\Http\Requests\ProjectRequest;
use App\Models\Department;
use App\Models\Project;
use App\Models\ProjectList;
use App\Models\ProjectType;
use App\Models\RecentProject;
use App\Models\Status;
use App\Models\User;
use AhsanDev\Support\Field;
use Facades\Admin\Static\Color;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as CollectionAlias;

class ProjectsController extends Controller
{
    protected $name = 'project';

    protected $excludeResource = ['view', 'detail'];

    /**
     * @param ProjectFilters $filters
     * @return Builder[]|Collection|CollectionAlias
     */
    public function index(ProjectFilters $filters): array|Collection|CollectionAlias
    {
        $query = Project::query();

        if (!auth()->user()->isSuperAdmin()) {
            $query->whereHas('users', function (Builder $q) {
                $q->whereId(auth()->id());
            });
        }

        if (request()->has('archived')) {
            $query->onlyTrashed();
        }

        return $query->with(['type', 'department', 'users', 'status'])->get(['id', 'name', 'meta', 'end_time'])
            ->filter(function ($item) {
                return $item->append(['is_favorite', 'progress']);
            });

        $query->filter($filters)
            ->select('id', 'name', 'color_id')
            ->with('color:id,name', 'users:id,name,avatar')
            ->withCount(['tasks' => function ($q) {
                $q->whereNull('completed_at')->whereNull('parent_id');
            }]);

        return $query->simplePaginate()
            ->through(function ($item) {
                return $item->append(['remaining_users', 'is_favorite']);
            });
    }

    /**
     * @param Project $project
     * @return Field
     */
    public function create(Project $project): Field
    {
        return $this->fields($project);
    }

    /**
     * @param Request $request
     * @param Project $project
     * @return ProjectRequest
     */
    public function store(Request $request, Project $project): ProjectRequest
    {
        return new ProjectRequest($request, $project);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id): mixed
    {
        $query = Project::whereId($id);

        if (!auth()->user()->isSuperAdmin()) {
            $query->whereHas('users', function (Builder $q) {
                $q->where('id', auth()->id());
            });
        }

        $project = $query->first();

        if (!$project) {
            abort(403);
        }

        RecentProject::updateOrCreate(
            ['user_id' => auth()->id(), 'project_id' => $project->id],
            ['updated_at' => now()]
        );

        return $project->append(['is_favorite'])->load(['users', 'lists' => function ($query) {
            $query->orderBy('order')->with(['tasks' => function ($q) {
                $q->orderBy('order');
            }, 'tasks.users', 'tasks.comments', 'tasks.checklists.checklistItems', 'tasks.priority', 'tasks.labels']);
        }]);
    }

    /**
     * @param Project $project
     * @return Field
     */
    public function edit(Project $project): Field
    {
        return $this->fields($project);
    }

    /**
     * @param Request $request
     * @param Project $project
     * @return ProjectRequest
     */
    public function update(Request $request, Project $project): ProjectRequest
    {
        return new ProjectRequest($request, $project);
    }

    /**
     * @param Request $request
     * @param $id
     * @return string[]
     */
    public function destroy(Request $request, $id): array
    {
        $project = Project::withTrashed()->find($request->items[0]);

        $project->users()->detach();
        // $project->favoriteBy()->detach();
        $project->tasks()->each(fn($item) => $item->users()->detach());
        $project->tasks()->each(fn($item) => $item->tasks()->forceDelete());
        $project->tasks()->each(fn($item) => $item->comments()->forceDelete());
        $project->tasks()->each(fn($item) => $item->attachments()->forceDelete());

        $project->tasks()->forceDelete();
        $project->lists()->forceDelete();
        $project->forceDelete();

        return [
            'message' => 'Project Deleted Successfully!',
        ];
    }

    /**
     * @param Project $project
     * @param Request $request
     * @return array
     */
    public function complete(Project $project, Request $request): array
    {
        if ($project->completed_at) {
            $project->update(['status_id' => Status::getId('Ongoing'), 'completed_at' => null]);

            return ['success' => true, 'message' => 'Project mark as incomplete successfully!'];
        }

        $project->update(['status_id' => Status::getId('Completed'), 'completed_at' => now()]);

        return ['success' => true, 'message' => 'Project mark as completed successfully!'];
    }

    /**
     * @param Request $request
     * @return true[]
     */
    public function listUpdate(Request $request): array
    {
        ProjectList::find($request->list_id)->update([
            'name' => $request->name,
        ]);

        return ['success' => true];
    }

    /**
     * @param Request $request
     * @return true[]
     */
    public function listDelete(Request $request): array
    {
        $list = ProjectList::find($request->list_id);
        $list->tasks()->each(fn($item) => $item->users()->detach());
        $list->tasks()->each(fn($item) => $item->tasks()->forceDelete());
        $list->tasks()->each(fn($item) => $item->comments()->forceDelete());
        $list->tasks()->each(fn($item) => $item->attachments()->forceDelete());
        $list->tasks()->forceDelete();
        $list->forceDelete();

        return ['success' => true];
    }

    /***
     * @param $model
     * @return Field
     */
    public function fields($model): Field
    {
        return Field::make()
            ->field('name', $model->name)
            ->field('description', $model->description)
            ->field('end_time', $model->end_time)
            ->field('type_id', optional($model->type)->id, ProjectType::options())
            ->field('department_id', optional($model->department)->id, Department::options())
            ->field('status_id', optional($model->status)->id, Status::options())
            ->field('color', $model->meta['color'] ?? Color::default(), Color::options())
            ->field('users', $model->users->isEmpty() ? [auth()->id()] : $model->users->pluck('id'), User::orderBy('name')->get(['id', 'name', 'email', 'avatar', 'meta']));
    }
}
