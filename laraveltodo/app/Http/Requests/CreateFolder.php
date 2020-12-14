<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// FormRequest クラスは基本的に一つのリクエストに対して一つ作成
class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    //リクエストの内容に基づいた権限チェック
    //今回はこの機能を利用しないためリクエストを受け付ける
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    //入力欄ごとにチェックするルールを定義
    //input 要素の name 属性に対応
    //必須入力を意味する required
    {
        return [
            'title' => 'required|max:20',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'フォルダ名',
            ];
    }
}
