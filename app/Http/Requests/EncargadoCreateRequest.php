<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EncargadoCreateRequest extends FormRequest
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
            'rut'=>'required|max:10',
            'nombres'=>'required|max:50',
            'apellidos'=>'required|max:50',   
            'telefono'=>'max:12',
            'licencia'=>'mimes:jpeg,bmp,png,pdf',
           
            
        ];
    }
}
