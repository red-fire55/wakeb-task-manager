<?php

namespace App\Http\Requests;


use AhsanDev\Support\Requests\FormRequest;

class UnitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'nullable',
            'section_id' => 'required|exists:sections,id',
            'level_id' => 'required|exists:levels,id',
            'next_level' => 'nullable|exists:levels,id',
        ];
    }
}
