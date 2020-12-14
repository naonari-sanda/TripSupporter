<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'name' => 'required|max:20',
            'recommend' => 'required|integer|between: 0,5',
            'safe' => 'required|integer|between: 0,5',
            'cost' => 'required|integer|between: 0,5',
            'fun' => 'required|integer|between: 0,5',
            'food' => 'required|integer|between: 0,5',
            'english' => 'required|integer|between: 0,5',
            'comment' => 'max:1000',
            'review' => 'required|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '国名',
            'recommend' => 'オススメ',
            'safe' => '治安',
            'cost' => '物価',
            'fun' => '楽しさ',
            'food' => '料理',
            'english' => '英語力',
            'comment' => 'コメント',
            'covid' => '入国制限',
            'review' => 'レビュー',
        ];
    }
}
