<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            // 'user_id' => 'required|integer|unique:acounts,user_id',
            'user_id' => 'required|integer',
            'gender' => 'required|string|max:3',
            'age' => 'required|string|max:6',
            'profile' => 'nullable|string|max:300',
            'hobby' => 'nullable|string|max:50',
            'icon' => 'nullable|image',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => '性別',
            'gender' => '性別',
            'age' => '年齢',
            'profile' => 'プロフィール',
            'hobby' => '趣味',
            'icon' => 'アイコン',
        ];
    }
    public function messages()
    {
        return [
            'user_id.unique' => '既に投稿済みです。'
        ];
    }
}
