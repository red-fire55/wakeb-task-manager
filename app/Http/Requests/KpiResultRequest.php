<?php

namespace App\Http\Requests;


use AhsanDev\Support\Requests\FormRequest;
use App\Models\Kpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KpiResultRequest extends FormRequest
{
    public function __construct(Request $request, $model = null)
    {
        $request->request->add(['kpi_id' => $request->kpi_id]);
        parent::__construct($request, $model);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'description' => 'required',
            'status' => 'nullable|in:current,previous',
            'kpi_id' => 'required|numeric|exists:kpis,id'
        ];
    }

    public function transaction(): void
    {
        DB::transaction(function () {
            $kpi = Kpi::find($this->attributes['kpi_id']);
            if ($kpi) {
                $kpi->resultHistory()?->latest()?->first()?->update(['status' => 'previous']);
            }
            $this->attributes = array_merge($this->attributes, ['status' => 'current']);
            $this->model->forceFill($this->attributes);
            $this->model->save();
        });
    }
}
