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
            'recommend' => 'required|numeric|min:1',
            'safe' => 'required|integer|min:1',
            'cost' => 'required|integer|min:1',
            'fun' => 'required|integer|min:1',
            'tourism' => 'required|integer|min:1',
            'food' => 'required|integer|min:1',
            'english' => 'required|integer|min:1',
            'review' => 'required|max:200',
            'imgpath' => 'image'
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
