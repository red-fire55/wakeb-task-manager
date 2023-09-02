<?php

namespace App\Http\Requests;


use AhsanDev\Support\Requests\FormRequest;

class LevelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'description' => 'nullable',
            'order' => 'nullable|numeric',
        ];
    }
}
