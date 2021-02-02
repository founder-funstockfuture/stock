<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
            'name' => 'required|between:2,25|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:200',
            'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=208,min_height=208',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => '會員名稱已被佔用，請重新填寫',
            'name.regex' => '會員名稱只支持英文、數字、橫槓和下劃線。',
            'name.between' => '會員名稱必須介於 3 - 25 個字符之間。',
            'name.required' => '會員名稱不能爲空。',
            'avatar.mimes' =>'頭像必須是 jpeg, bmp, png, gif 格式的圖片',
            'avatar.dimensions' => '圖片的清晰度不夠，寬和高需要 208px 以上',
        ];
    }
}