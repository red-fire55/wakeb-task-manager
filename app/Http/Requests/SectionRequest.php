<?php

namespace App\Http\Requests;

use AhsanDev\Support\Requests\FormRequest;
use Illuminate\Support\Facades\DB;

class SectionRequest extends FormRequest
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
            'levels' => 'nullable|array'
        ];
    }

    /**
     * @return void
     */
    public function transaction(): void
    {
        DB::transaction(function () {
            if (isset($this->attributes['levels'])) {
                unset($this->attributes['levels']);
            }
            $this->model->forceFill($this->attributes);
            $this->model->save();
            $this->model->levels()->sync($this->request->levels);
        });
    }
}
