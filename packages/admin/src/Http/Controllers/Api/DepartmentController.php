<?php

namespace Admin\Http\Controllers\Api;

use AhsanDev\Support\Field;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * @return Paginator
     */
    public function index(): Paginator
    {
        return Department::query()->simplePaginate();
    }

    /**
     * @return mixed
     */
    public function getAllDepartments(): mixed
    {
        return Department::options();
    }

    /**
     * @param Department $Department
     * @return Field
     */
    public function create(Department $Department): Field
    {
        return $this->fields($Department);
    }

    /**
     * @param Request $request
     * @param Department $Department
     * @return DepartmentRequest
     */
    public function store(Request $request, Department $Department): DepartmentRequest
    {
        return new DepartmentRequest($request, $Department);
    }

    /**
     * @param $id
     * @return Field
     */
    public function show($id): Field
    {
        return $this->fields(Department::find($id));
    }


    /**
     * @param $id
     * @return Field
     */
    public function edit($id): Field
    {
        return $this->fields(Department::find($id));
    }

    /**
     * @param Request $request
     * @param $id
     * @return DepartmentRequest
     */
    public function update(Request $request, $id): DepartmentRequest
    {
        return new DepartmentRequest($request, Department::find($id));
    }

    /**
     * @param $id
     * @return string[]
     */
    public function destroy($id): array
    {
        Department::find($id)?->delete();
        return ['message' => 'Department deleted successfully'];
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
