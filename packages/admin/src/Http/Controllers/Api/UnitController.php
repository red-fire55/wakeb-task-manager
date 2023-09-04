<?php

namespace Admin\Http\Controllers\Api;

use AhsanDev\Support\Authorization\Http\Controllers\AuthorizeController;
use AhsanDev\Support\Field;
use App\Http\Requests\UnitRequest;
use App\Models\Level;
use App\Models\Section;
use App\Models\Unit;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class UnitController extends AuthorizeController
{
    /**
     * @param Request $request
     * @return Paginator
     */
    public function index(Request $request): Paginator
    {
        $query = Unit::query();
        return $query->with('section')->with('level')->simplePaginate($request->input('per_page', 10));
    }

    /**
     * Show the form for creating a new resource.
     * @param Unit $unit
     * @return Field
     */
    public function create(Unit $unit): Field
    {
        return $this->fields($unit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Unit $unit
     * @return UnitRequest
     */
    public function store(Request $request, Unit $unit): UnitRequest
    {
        return new UnitRequest($request, $unit);
    }

    /**
     * Display the specified resource.
     *
     * @param int $unit_id
     * @return Field
     */
    public function show(int $unit_id): Field
    {
        return $this->fields(Unit::find($unit_id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $unit_id
     * @return Field
     */
    public function edit(int $unit_id): Field
    {
        return $this->fields(Unit::find($unit_id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Unit $unit
     * @return UnitRequest
     */
    public function update(Request $request, Unit $unit): UnitRequest
    {
        return new UnitRequest($request, $unit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $unit_id
     * @return array
     */
    public function destroy(int $unit_id): array
    {
        Unit::find($unit_id)?->delete();
        return ['message' => 'Unit deleted successfully'];
    }

    /**
     * @param $model
     * @return Field
     */
    private function fields($model): Field
    {
        return Field::make()
            ->field('name', $model->name)
            ->field('description', $model->description)
            ->field('section_id', optional($model->section)->id, Section::options())
            ->field('level_id', optional($model->level)->id, Level::options())
            ->field('next_level', $model->next_level);
    }
}
