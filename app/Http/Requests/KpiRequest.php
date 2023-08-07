<?php

namespace App\Http\Requests;

use AhsanDev\Support\Requests\FormRequest;
use Illuminate\Support\Facades\DB;

class KpiRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'measure' => 'required|numeric',
            'owner_id' => 'required|exists:users,id',
            'status' => 'nullable|string',
            'notes' => 'nullable',
            'target' => 'nullable|string',
            'kpi_category_id' => 'required|exists:kpi_categories,id',
            'frequency' => 'nullable|string',
            'sub_weight' => 'required|numeric',
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
