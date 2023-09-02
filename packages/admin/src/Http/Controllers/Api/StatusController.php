<?php

namespace Admin\Http\Controllers\Api;

use AhsanDev\Support\Authorization\Http\Controllers\AuthorizeController;
use AhsanDev\Support\Field;
use App\Http\Requests\StatusRequest;
use App\Models\Status;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class StatusController extends AuthorizeController
{
    /**
     * @return Paginator
     */
    public function index(): Paginator
    {
        return Status::query()->simplePaginate();
    }

    /**
     * @return mixed
     */
    public function getAllStatuses(): mixed
    {
        return Status::all();
    }

    /**
     * @param Status $status
     * @return Field
     */
    public function create(Status $status): Field
    {
        return $this->fields($status);
    }

    /**
     * @param Request $request
     * @param Status $status
     * @return StatusRequest
     */
    public function store(Request $request, Status $status): StatusRequest
    {
        return new StatusRequest($request, $status);
    }

    /**
     * @param $id
     * @return Field
     */
    public function show($id): Field
    {
        return $this->fields(Status::find($id));
    }

    /**
     * @param $id
     * @return Field
     */
    public function edit($id): Field
    {
        return $this->fields(Status::find($id));
    }

    /**
     * @param Request $request
     * @param $id
     * @return StatusRequest
     */
    public function update(Request $request, $id): StatusRequest
    {
        return new StatusRequest($request, Status::find($id));
    }

    /**
     * @param $id
     * @return string[]
     */
    public function destroy($id): array
    {
        Status::find($id)?->delete();
        return ['message' => 'Status deleted successfully'];
    }

    /**
     * @param $model
     * @return Field
     */
    private function fields($model): Field
    {
        return Field::make()
            ->field('name', $model->name)
            ->field('color', $model->color)
            ->field('description', $model->description);
    }
}
