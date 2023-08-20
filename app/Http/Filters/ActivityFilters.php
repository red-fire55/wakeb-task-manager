<?php

namespace App\Http\Filters;


use Illuminate\Support\Str;

class ActivityFilters
{
    public function apply($builder, $filters)
    {
        $modules = ['kpi', 'task', 'milestone'];
        foreach ($filters as $filter => $value) {
            if (in_array($filter, $modules))
                $this->module($builder, $filter, $value);
        }
        return $builder;
    }

    public function module($query, $module_name, $module_id)
    {
        return $query->where('subject_type', 'App\Models\\' . Str::ucfirst($module_name))->where('subject_id', $module_id);
    }
}
