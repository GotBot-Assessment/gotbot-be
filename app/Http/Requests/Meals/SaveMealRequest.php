<?php

namespace App\Http\Requests\Meals;

use Illuminate\Foundation\Http\FormRequest;

class SaveMealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'name'        => 'required|string|max:255|min:3',
            'description' => 'required|string|max:2000|min:3',
            'price'       => 'required|numeric|min:0',
            'category'    => 'required|string|max:255|min:3',
            'area'        => 'required|string|max:255|min:3',
        ];
    }
}
