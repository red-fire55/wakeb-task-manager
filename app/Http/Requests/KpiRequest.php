<?php

namespace App\Http\Requests;

use AhsanDev\Support\Requests\FormRequest;
use App\Models\KpiResultHistory;
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
            unset($this->attributes['previous_result']);
            unset($this->attributes['current_result']);
            $this->model->forceFill($this->attributes);
            $this->model->save();

            if ($this->request->current_result) {
                $lastResult = $this->model->resultHistory()->latest()->first();
                if ($lastResult) {
                    $lastResult->update(['description' => $this->request->previous_result, 'status' => 'previous']);
                }
                KpiResultHistory::create([
                    'description' => $this->request->current_result,
                    'status' => 'current',
                    'kpi_id' => $this->model->id,
                ]);
            }
        });
    }
}
