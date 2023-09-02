<?php

namespace Admin\Http\Controllers\Api;

use AhsanDev\Support\Authorization\Http\Controllers\AuthorizeController;
use AhsanDev\Support\Field;
use App\Http\Requests\LevelRequest;
use App\Models\Level;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class LevelController extends AuthorizeController
{
    /**
     * @param Request $request
     * @return Paginator
     */
    public function index(Request $request): Paginator
    {
        $query = Level::query();
        return $query->simplePaginate($request->input('per_page', 10));
    }

    /**
     * @param Level $level
     * @return Field
     */
    public function create(Level $level): Field
    {
        return $this->fields($level);
    }

    /**
     * @param Request $request
     * @param Level $level
     * @return LevelRequest
     */
    public function store(Request $request, Level $level): LevelRequest
    {
        return new LevelRequest($request, $level);
    }

    /**
     * @param $level
     * @return Field
     */
    public function show($level): Field
    {
        return $this->fields(Level::find($level));
    }

    /**
     * @param $level
     * @return Field
     */
    public function edit($level): Field
    {
        return $this->fields(Level::find($level));
    }

    /**
     * @param Request $request
     * @param Level $level
     * @return LevelRequest
     */
    public function update(Request $request, Level $level): LevelRequest
    {
        return new LevelRequest($request, $level);
    }


    public function destroy($level)
    {
        $result = Level::find($level)?->delete();
        return ['message' => 'Result deleted successfully'];
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
