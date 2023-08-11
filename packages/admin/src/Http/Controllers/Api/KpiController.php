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
use Illuminate\Support\Facades\DB;

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
        $resultHistory = $model->resultHistory()->count();
        return Field::make()
            ->field('id', $model->id)
            ->field('measure', $model->measure)
            ->field('owner_id', $model->owner_id, User::options())
            ->field('notes', $model->notes)
            ->field('status', $model->status)
            ->field('target', $model->target)
            ->field('frequency', $model->frequency, DB::table('frequencies')->select('id as value', 'name as label')->get())
            ->field('sub_weight', $model->sub_weight)
            ->field('kpi_category_id', $model->kpi_category_id, KpiCategory::options())
            ->field('previous_result', $resultHistory > 1 ? $model->resultHistory()->offset($resultHistory - 2)->limit(1)->get() : null)
            ->field('current_result', $model->resultHistory()->latest()->first());
    }
}
