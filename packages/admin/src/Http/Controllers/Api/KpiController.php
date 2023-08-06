<?php

namespace Admin\Http\Controllers\Api;

use AhsanDev\Support\Field;
use App\Http\Controllers\Controller;
use App\Http\Requests\KpiRequest;
use App\Models\Kpi;
use App\Models\KpiCategory;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class KpiController extends Controller
{

    /**
     * @return Paginator
     */
    public function index(): Paginator
    {
        $query = Kpi::query();
        return $query->with('owner')->with('category')->simplePaginate();
    }

    /**
     * @param Kpi $Kpi
     * @return Field
     */
    public function create(Kpi $Kpi): Field
    {
        return $this->fields($Kpi);
    }

    /**
     * @param Request $request
     * @return KpiRequest
     */
    public function store(Request $request, Kpi $Kpi): KpiRequest
    {
        return new KpiRequest($request, $Kpi);
    }

    /**
     * @param $Kpi_id
     * @return Field
     */
    public function show($Kpi_id): Field
    {
        return $this->fields(Kpi::find($Kpi_id));
    }

    /**
     * @param $Kpi_id
     * @return Field
     */
    public function edit($Kpi_id): Field
    {
        return $this->fields(Kpi::find($Kpi_id));
    }

    /**
     * @param Request $request
     * @param Kpi $Kpi
     * @return KpiRequest
     */
    public function update(Request $request, Kpi $Kpi)
    {
        return new KpiRequest($request, $Kpi);
    }

    /**
     * @param $Kpi_id
     * @return string[]
     */
    public function destroy($Kpi_id): array
    {
        $Kpi = Kpi::find($Kpi_id);
        $Kpi->delete();
        return ['message' => 'Kpi deleted successfully'];
    }

    /**
     * @param $model
     * @return Field
     */
    private function fields($model): Field
    {
        return Field::make()
            ->field('id', $model->id)
            ->field('measure', $model->measure)
            ->field('owner_id', $model->owner_id, User::options())
            ->field('notes', $model->notes)
            ->field('status', $model->status)
            ->field('target', $model->target)
            ->field('frequency', $model->frequency)
            ->field('sub_weight', $model->sub_weight)
            ->field('kpi_category_id', $model->kpi_category_id, KpiCategory::options());
    }
}
