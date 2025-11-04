<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            /*
            'nro_documento' => 'required|string|max:20|unique:clientes,nro_documento',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:clientes,email',
            'telefono' => 'required|string|max:20',
            'telefono_ref' => 'nullable|string|max:20',
            'direccion' => 'required|string',
            'departamento' => 'required|string|max:100',
            'provincia' => 'required|string|max:100',
            'distrito' => 'required|string|max:100',
            'ocupacion' => 'required|string|max:150',
            'ing_mensual' => 'required|numeric|min:0|max:9999999.99',
            'comentarios' => 'nullable|string',*/

            "nro_documento"=> "required",
            "nombre"=> "required",
            "apellido"=> "required",
            "fecha_nacimiento"=> "nullable|date",
            "genero"=> "nullable",
            "email"=> "required",
            "telefono"=> "required|numeric",
            "telefono_ref"=> "nullable|numeric",
            "direccion"=> "required",
            "departamento"=> "nullable",
            "provincia"=> "nullable",
            "distrito"=> "nullable",
            "nro_cuenta"=> "nullable",
            "ocupacion"=> "nullable",
            "ing_mensual"=> "nullable",
            "comentarios"=> "nullable",
            "foto"=> "nullable",
            "adjuntos"=> "nullable",
        ];
    }

    public function messages(): array
    {
        return [
            'nro_documento.required' => 'El número de documento es obligatorio',
            'nro_documento.unique' => 'Este número de documento ya está registrado',
            'nombre.required' => 'El nombre es obligatorio',
            'apellido.required' => 'El apellido es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Debe ser un correo electrónico válido',
            'email.unique' => 'Este correo ya está registrado',
            'telefono.required' => 'El teléfono es obligatorio',
            'direccion.required' => 'La dirección es obligatoria',
            'departamento.required' => 'El departamento es obligatorio',
            'provincia.required' => 'La provincia es obligatoria',
            'distrito.required' => 'El distrito es obligatorio',
            'ocupacion.required' => 'La ocupación es obligatoria',
            'ing_mensual.required' => 'El ingreso mensual es obligatorio',
            'ing_mensual.numeric' => 'El ingreso mensual debe ser un número',
            'ing_mensual.min' => 'El ingreso mensual debe ser mayor a 0',
        ];
    }
}