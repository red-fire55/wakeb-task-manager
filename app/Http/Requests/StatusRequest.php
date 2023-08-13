<?php

namespace App\Http\Requests;

use AhsanDev\Support\Requests\FormRequest;

class StatusRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:statuses,name' . ($this->request->status ? ',' . $this->request->status : ''),
            'color' => 'nullable',
            'description' => 'nullable',
        ];
    }
}
