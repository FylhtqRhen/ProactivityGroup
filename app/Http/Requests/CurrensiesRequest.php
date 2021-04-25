<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrensiesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page' => 'integer|min:0',
            'perPage' => 'integer|min:0'
        ];
    }
}
