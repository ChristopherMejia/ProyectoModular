<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramaEducativoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'educacion' => 'required|max:255',
            'nivel' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'educacion.required' => 'El :attribute es obligatorio.',
            'nivel.required' => 'El :attribute es obligatorio.',
        ];
    }
    public function attributes()
    {
        return [
            'educacion' => 'Nombre',
            'nivel' => 'Nivel',
        ];
    }
}

?>