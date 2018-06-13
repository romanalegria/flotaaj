<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsignarCreateRequest extends FormRequest
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
            'encargado'=>'required',
            'vehiculo'=>'required',   
            'fecha_asignacion'=>'max:10',   
            'descripcion'=>'required|max:250',            
        ];
    }
}
