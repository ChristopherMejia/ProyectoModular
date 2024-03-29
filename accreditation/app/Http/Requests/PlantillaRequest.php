<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlantillaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idOrganismo' => 'required',
            'version' => 'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'idOrganismo.required' => 'El :attribute es obligatorio.',
            'version.required' => 'El :attribute es obligatorio.',
        ];
    }
    public function attributes()
    {
        return [
            'idOrganismo' => 'Organismo',
            'version' => 'Versión',
        ];
    }
}
