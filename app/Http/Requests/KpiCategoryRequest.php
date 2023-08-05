<?php

namespace App\Http\Requests;


use AhsanDev\Support\Requests\FormRequest;
use Illuminate\Support\Facades\DB;

class KpiCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|unique:kpi_categories,name,' . ($this->kpiCategory ?? 0),
            'description' => 'nullable',
        ];
    }

    public function transaction(): void
    {
        DB::transaction(function () {
            $this->model->forceFill($this->attributes);
            $this->model->save();
        });
    }
}
