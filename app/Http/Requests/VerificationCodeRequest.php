<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerificationCodeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'verification_key' => 'required|string',
            'verification_code' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'verification_key' => '簡訊驗證碼 key',
            'verification_code' => '簡訊驗證碼',
        ];
    }
}
