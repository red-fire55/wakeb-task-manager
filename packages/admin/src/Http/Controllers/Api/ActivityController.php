<?php

namespace Admin\Http\Controllers\Api;

use AhsanDev\Support\Authorization\Http\Controllers\AuthorizeController;
use App\Http\Filters\ActivityFilters;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends AuthorizeController
{

    public function __invoke(Request $request)
    {
        $filters = $request->all();
        $query = Activity::query();
        $query = (new ActivityFilters)->apply($query, $filters);
        return $query->with('causer')->latest()->simplePaginate($request->input('per_page', 15));
    }
}
