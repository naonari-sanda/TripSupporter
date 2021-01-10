<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'country_id' => 'required|integer',
            'recommend' => 'required|numeric|between:1,5',
            'safe' => 'required|integer|between:1,5',
            'cost' => 'required|integer|between:1,5',
            'fun' => 'required|integer|between:1,5',
            'tourism' => 'required|integer|between:1,5',
            'food' => 'required|integer|between:1,5',
            'english' => 'required|integer|between:1,5',
            'city' => 'required|max:15',
            'review' => 'required|max:200',
            'imgpath' => 'nullable|image'
        ];
    }

    public function attributes()
    {
        return [
            'recommend' => 'オススメ',
            'safe' => '治安',
            'cost' => '物価',
            'fun' => '楽しさ',
            'food' => '料理',
            'english' => '英語力',
            'tourism' => '観光',
            'review' => 'レビュー',
            'imgpath' => '画像',
        ];
    }
}
