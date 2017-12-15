<?php

namespace Monkeycorp\Meli\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateMeRequest
 * @package Monkeycorp\Meli\Http\Requests\Users
 */
class UpdateMeRequest extends FormRequest
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
            'first_name' => 'required|min:4',
            'last_name' => 'required|min:4',
            'identification_type' => 'min:3',
            'identification_number' => 'required_with:identification_type|min:10',
            'city' => 'required|min:5',
            'zip_code' => 'required|regex:/\b\d{5}\b/'
        ];
    }
}