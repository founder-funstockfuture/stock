<?php

namespace App\Http\Requests;

class TagRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'tag_name' => 'required|min:1',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            'tittag_namele.min' => '必須至少一個字符',
        ];
    }
}