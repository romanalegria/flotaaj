<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SsggCreateRequest extends FormRequest
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
            'sucursal'=>'required|max:2',
            'severidad'=>'required|max:2',   
            'asignado'=>'max:25', 
            'resumen'=>'required|max:250',     
            'descripcion'=>'required|max:250',   
            'fecha_creacion'=>'max:8',   
            'fecha_cierre'=>'max:8',   
        ];
    }
}
