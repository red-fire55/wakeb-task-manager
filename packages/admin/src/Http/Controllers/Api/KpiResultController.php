<?php

namespace Admin\Http\Controllers\Api;

use AhsanDev\Support\Field;
use App\Http\Controllers\Controller;
use App\Http\Requests\KpiResultRequest;
use App\Models\Kpi;
use App\Models\KpiResult;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class KpiResultController extends Controller
{

    /**
     * @return Paginator
     */
    public function index(): Paginator
    {
        return KpiResult::query()->with('creator')->simplePaginate();
    }

    /**
     * @param $kpi_id
     * @return mixed
     */
    public function getAllResults($kpi_id): mixed
    {
        return KpiResult::where('kpi_id', $kpi_id)->get();
    }

    /**
     * @param KpiResult $result
     * @return Field
     */
    public function create(KpiResult $result): Field
    {
        return $this->fields($result);
    }

    /**
     * @param Request $request
     * @param KpiResult $result
     * @return KpiResultRequest
     */
    public function store(Request $request, KpiResult $result): KpiResultRequest
    {
        return new KpiResultRequest($request, $result);
    }

    /**
     * @param $kpi_id
     * @param $result_id
     * @return Field
     */
    public function show($kpi_id, $result_id): Field
    {
        return $this->fields(KpiResult::find($result_id));
    }

    /**
     * @param $kpi_id
     * @param $result_id
     * @return Field
     */
    public function edit($kpi_id, $result_id): Field
    {
        return $this->fields(KpiResult::find($result_id));
    }

    /**
     * @param Request $request
     * @param $kpi_id
     * @param $result_id
     * @return KpiResultRequest
     */
    public function update(Request $request, $kpi_id, $result_id): KpiResultRequest
    {
        return new KpiResultRequest($request, KpiResult::find($result_id));
    }

    /**
     * @param $kpi_id
     * @param $result_id
     * @return string[]
     */
    public function destroy($kpi_id, $result_id): array
    {
        $result = KpiResult::find($result_id)?->delete();
        return ['message' => 'Result deleted successfully'];
    }

    /**
     * @param $model
     * @return Field
     */
    private function fields($model)
    {
        return Field::make()
            ->field('description', $model->description)
            ->field('status', $model->status)
            ->field('title', $model->status)
            ->field('creator', $model->creator)
            ->field('created_at', $model->created_at)
            ->field('kpi_id', $model->kpi_id, Kpi::options());
    }
}
