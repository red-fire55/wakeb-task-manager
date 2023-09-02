<?php

namespace Admin\Http\Controllers\Api;

use AhsanDev\Support\Authorization\Http\Controllers\AuthorizeController;
use AhsanDev\Support\Field;
use App\Http\Requests\KpiCategoryRequest;
use App\Models\KpiCategory;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class KpiCategoryController extends AuthorizeController
{
    /**
     * @return Paginator
     */
    public function index(): Paginator
    {
        $query = KpiCategory::query();
        return $query->simplePaginate();
    }

    /**
     * @param KpiCategory $kpiCategory
     * @return Field
     */
    public function create(KpiCategory $kpiCategory): Field
    {
        return $this->fields($kpiCategory);
    }

    /**
     * @param Request $request
     * @param KpiCategory $category
     * @return KpiCategoryRequest
     */
    public function store(Request $request, KpiCategory $category): KpiCategoryRequest
    {
        return new KpiCategoryRequest($request, $category);
    }

    /**
     * @param $id
     * @return Field
     */
    public function show($id): Field
    {
        return $this->fields(KpiCategory::find($id));
    }


    /**
     * @param $id
     * @return Field
     */
    public function edit($id): Field
    {
        return $this->fields(KpiCategory::find($id));
    }

    /**
     * @param Request $request
     * @param $id
     * @return KpiCategoryRequest
     */
    public function update(Request $request, $id): KpiCategoryRequest
    {
        return new KpiCategoryRequest($request, KpiCategory::find($id));
    }

    /**
     * @param $id
     * @return string[]
     */
    public function destroy($id): array
    {
        KpiCategory::find($id)?->delete();
        return ['message' => 'Category deleted successfully'];
    }

    /**
     * @param $model
     * @return Field
     */
    protected function fields($model): Field
    {
        return Field::make()
            ->field('name', $model->name)
            ->field('description', $model->description);
    }
}
