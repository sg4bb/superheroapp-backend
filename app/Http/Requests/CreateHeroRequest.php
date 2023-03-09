<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHeroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        // return [
        //     'nombre' => 'required|string|min:3|max:20|unique:super_heroes',
        //     'descripcion' => 'string|min:2|max:255'
        // ];

        return [
            'nombre' => 'required|string|min:3|max:20|unique:super_heroes',
            'descripcion' => 'string|min:2|max:255'
        ];
    }
}
