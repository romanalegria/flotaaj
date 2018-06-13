<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculoCreateRequest extends FormRequest
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
            'nombre'=>'required|max:50',
            'marca'=>'required|max:25',   
            'modelo'=>'required|max:25', 
            'axo'=>'required|max:4',     
            'tipovehiculo'=>'required|max:2',   
            'estadovehiculo'=>'required|max:2',   
            'numserie'=>'required|max:25', 
            'patente'=>'required|max:10',     
            'color'=>'required|max:25',     
            'areanegocio'=>'required|max:2',     
            'encargado'=>'required|max:2', 
            'inspeccion'=>'required',
            'mantencion'=>'required', 
               
        ];
    }
}
