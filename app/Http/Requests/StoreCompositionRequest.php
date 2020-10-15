<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompositionRequest extends FormRequest
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
            'qte'        => 'required|numeric'
        ];
    }

    public function messages(){
        return [
            'qte.required' => 'Veuillez indiquer une quantité',
            'qte.numeric' => 'La quantité doit être numérique'
        ];
    }
}
