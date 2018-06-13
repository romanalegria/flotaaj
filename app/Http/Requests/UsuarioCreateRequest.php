<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioCreateRequest extends FormRequest
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
            'name'=>'required|max:50',
            'email'=>'required|max:50',
            'idrol'=>'required|max:2',   
            'password'=>'max:20',
            'codigosap'=>'min:8',
            'montoMaximo'=>'required',
            'idJefe'=>'required',
           
            
        ];
    }
}
