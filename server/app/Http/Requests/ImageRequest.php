<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'country_id' => 'required',
            'user_id' => 'required',
            'imgpath' => 'image|required',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'ユーザーID',
            'country_id' => '国名',
            'imgpath' => '画像',
        ];
    }
}
