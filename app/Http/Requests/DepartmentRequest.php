<?php

namespace App\Http\Requests;


use AhsanDev\Support\Requests\FormRequest;
use Illuminate\Support\Facades\DB;

class DepartmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|unique:departments,name' . ($this->request->department ? ',' . $this->request->department : ''),
            'name_ar' => 'nullable|string|min:3|unique:departments,name_ar' . ($this->request->department ? ',' . $this->request->department : ''),
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
