<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            "codigo" => "unique:employees",
            "salarioPesos" => "numeric|min:1",
            "salarioDolares" => "numeric|min:1",
            "correo" => "unique:employees|email",
            "nombre" => "required",
            "direccion" => "required",
            "telefono" => "required",
            "estado" => "required",
            "ciudad" => "required"
        ];
    }

    public function messages()
    {
        return [
            "codigo.unique" => "El código ya existe en el sistema, favor de ingresar otro.",
            "email.unique" => "El correo ya existe en el sistema, favor de ingresar otro.",
            "salarioDolares.min" => "El salario en dolares debe ser mayor a 0.",
            "salarioPesos.min" => "El salario en pesos debe ser mayor a 0."
        ];

    }
}
