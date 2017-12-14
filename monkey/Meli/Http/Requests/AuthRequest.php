<?php

namespace Monkeycorp\Meli\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|min:20'
        ];
    }
}