<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class SendReviewRequest extends FormRequest
{
    public function authorize()
    {
        return [
            'reviews.*.rating' => '評分',
            'reviews.*.review' => '評價',
        ];
    }


    public function rules()
    {
        return [
            'reviews'          => ['required', 'array'],
            'reviews.*.id'     => [
                'required',
                Rule::exists('order_items', 'id')->where('order_id', $this->route('order')->id)
            ],
            'reviews.*.rating' => ['required', 'integer', 'between:1,5'],
            'reviews.*.review' => ['required'],
        ];
    }
}
