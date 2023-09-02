<?php

namespace Admin\Http\Controllers\Api;

use AhsanDev\Support\Authorization\Http\Controllers\AuthorizeController;
use AhsanDev\Support\Field;
use App\Http\Requests\SectionRequest;
use App\Models\Level;
use App\Models\Section;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class SectionController extends AuthorizeController
{
    /**
     * @param Request $request
     * @return Paginator
     */
    public function index(Request $request): Paginator
    {
        $query = Section::query();
        return $query->with('levels')->simplePaginate($request->input('per_page', 10));
    }

    /**
     * @param Request $request
     * @param Section $section
     * @return SectionRequest
     */
    public function store(Request $request, Section $section): SectionRequest
    {
        return new SectionRequest($request, $section);
    }

    /**
     * @param Section $section
     * @return Field
     */
    public function create(Section $section): Field
    {
        return $this->fields($section);
    }

    /**
     * @param $section
     * @return Field
     */
    public function show($section): Field
    {
        return $this->fields(Section::find($section));
    }

    /**
     * @param $section
     * @return Field
     */
    public function edit($section): Field
    {
        return $this->fields(Section::find($section));
    }

    /**
     * @param Request $request
     * @param Section $section
     * @return SectionRequest
     */
    public function update(Request $request, Section $section): SectionRequest
    {
        return new SectionRequest($request, $section);
    }

    /**
     * @param $section
     * @return string[]
     */
    public function destroy($section): array
    {
        $section = Section::find($section);
        $section->levels()->detach();
        $section->delete();
        return ['message' => 'Section deleted successfully'];
    }

    /**
     * @param $model
     * @return Field
     */
    protected function fields($model): Field
    {
        return Field::make()
            ->field('name', $model->name)
            ->field('description', $model->description)
            ->field('levels', $model->levels, Level::options());
    }
}
