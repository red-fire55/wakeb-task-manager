<?php

namespace App\Http\Filters;


class KpiFilters
{
    public function apply($builder, $filters)
    {
        foreach ($filters as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($builder, $value);
            }
        }
        return $builder;
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    private function category($query, $categories): mixed
    {
        return $query->whereIn('kpi_category_id', $categories);
    }

    private function date($query, $dateRange): mixed
    {
        return $query->whereBetween('created_at', $dateRange);
    }

    private function project($query, $project_id): mixed
    {
        return $query->where('project_id', $project_id);
    }
}
