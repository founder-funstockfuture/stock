<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerificationMobileRequest extends FormRequest
{

    public function rules()
    {
        return [
            'mobile' => [
                'required',
                'regex:/^09[0-9]{8}$/',
                'unique:users'
            ]
        ];
    }


}
