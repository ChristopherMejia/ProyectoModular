<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest
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
            'FirstName' => 'required|max:255',
            'LastName' => 'required|max:255',
            'email' => 'required|email:rfc,dns',
            'inputGroupRoles' => 'required',
            'password' => 'required|min:8',
        ];
    }
    public function messages()
    {
        return [
            'FirstName.required' => 'El :attribute es obligatorio.',
            'LastName.required' => 'El :attribute es obligatorio.',
            'email.required' => 'El :attribute es obligatorio.',
            'inputGroupRoles.required' => 'El :atribute es obligatorio.',
            'password.required' => 'El :atribute es obligatorio',
        ];
    }
    public function attributes()
    {
        return [
            'FirstName' => 'Nombre',
            'LastName' => 'Apellido',
            'email' => 'Email',
            'inputGroupRoles' => 'Role',
            'password' => ' Password'
        ];
    }
}
