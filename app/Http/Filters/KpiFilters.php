<?php

namespace App\Http\Filters;


class KpiFilters
{
    public function apply($builder, $filters)
    {
        foreach ($filters as $filter => $value) {
            if (method_exists($this, $filter)) {
                if (is_array($value) && sizeof($value) > 1) {
                    $this->$filter($builder, $value[0], $value[1]);
                } else {
                    $this->$filter($builder, is_array($value) ? $value[0] : $value);
                }
            }
        }
        return $builder;
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    private function category($query, $value): mixed
    {
        return $query->where('kpi_category_id', $value);
    }

    private function date($query, $start, $end): mixed
    {
        //swap values if range is reversed
        if ($start > $end) {
            [$start, $end] = [$end, $start];
        }

        return $query->where('created_at', '>=', $start)->where('created_at', '<=', $end);
    }
}
