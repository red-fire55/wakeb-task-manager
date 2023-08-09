<?php

namespace Admin\Http\Controllers\Api;

use AhsanDev\Support\Field;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectTypeRequest;
use App\Models\ProjectType;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{
    /**
     * @return Paginator
     */
    public function index(): Paginator
    {
        return ProjectType::query()->simplePaginate();
    }

    /**
     * @return Collection
     */
    public function getaAllTypes(): Collection
    {
        return ProjectType::all();
    }

    /**
     * @param ProjectType $projectType
     * @return Field
     */
    public function create(ProjectType $projectType): Field
    {
        return $this->fields($projectType);
    }

    /**
     * @param Request $request
     * @param ProjectType $projectType
     * @return ProjectTypeRequest
     */
    public function store(Request $request, ProjectType $projectType): ProjectTypeRequest
    {
        return new ProjectTypeRequest($request, $projectType);
    }

    /**
     * @param $id
     * @return Field
     */
    public function show($id): Field
    {
        return $this->fields(ProjectType::find($id));
    }


    /**
     * @param $id
     * @return Field
     */
    public function edit($id): Field
    {
        return $this->fields(ProjectType::find($id));
    }

    /**
     * @param Request $request
     * @param $id
     * @return ProjectTypeRequest
     */
    public function update(Request $request, $id): ProjectTypeRequest
    {
        return new ProjectTypeRequest($request, ProjectType::find($id));
    }

    /**
     * @param $id
     * @return string[]
     */
    public function destroy($id): array
    {
        ProjectType::find($id)?->delete();
        return ['message' => 'Project type deleted successfully'];
    }


    /**
     * @param $model
     * @return Field
     */
    private function fields($model): Field
    {
        return Field::make()
            ->field('name', $model->name)
            ->field('name_ar', $model->name_ar)
            ->field('description', $model->description);
    }
}
