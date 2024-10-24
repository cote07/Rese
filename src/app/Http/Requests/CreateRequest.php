<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'area_id' => ['required'],
            'genre_id' => ['required'],
            'image_url' => ['required', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名は必須です。',
            'description.required' => '説明は必須です。',
            'description.max' => '説明は255文字以内で入力してください。',
            'area_id.required' => 'エリアを選択してください。',
            'genre_id.required' => 'ジャンルを選択してください。',
            'image_url.required' => '画像を選択してください。',
            'image_url.image' => 'アップロードされたファイルは画像である必要があります。',
            'image_url.mimes' => '画像ファイルはjpeg、png、jpg、gif形式である必要があります。',
            'image_url.max' => '画像ファイルのサイズは2MB以下である必要があります。',
        ];
    }
}
