<?php

namespace App\Http\Requests;

use AhsanDev\Support\Requests\FormRequest;
use Illuminate\Support\Facades\DB;

class ProjectTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|unique:project_types,name,' . ($this->request->project_type ?? 0),
            'name_ar' => 'sometimes|string|unique:project_types,name_ar,' . ($this->request->project_type ?? 0),
            'description' => 'nullable',
        ];
    }

    /**
     * @return void
     */
    public function transaction(): void
    {
        DB::transaction(function () {
            $this->model->forceFill($this->attributes);
            $this->model->save();
        });
    }
}
