<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RendicionRequest extends FormRequest
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
            'zona'=>'required|numeric',
            'tipodoc'=>'required|numeric',
            'ndoc'=>'required|numeric',
            'fechadoc'=>'required|max:10',
            'concepto'=>'required|numeric',            
            'subconsumo'=>'required|numeric',
            'monto'=>'required|numeric',
            'observaciones'=>'required|max:250',
        ];
    }
}
