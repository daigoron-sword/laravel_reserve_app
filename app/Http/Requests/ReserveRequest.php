<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\hiragana;
use App\Rules\fullWidth;

class ReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'reserve/check') //checkアクションのみバリデーションルール許可
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'hurigana' => ['required', new hiragana()],
            'gender' => 'required',
            'mail' => ['required', 'email'],
            'dob' => 'required',
            'postal' => ['required', 'integer'],
            'prefectures' => 'required',
            'city' => 'required',
            'tel' => ['required', 'numeric'],
            'transportation' => 'required',
            'dinner_start_time' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必ず入力してください。',
            'hurigana.required' => 'ふりがなは必ず入力してください。',
            'gender.required' => '性別は必ず選択してください。',
            'mail.required' => 'メールアドレスは必ず入力してください。',
            'mail.email' => 'email形式で記入してください',
            'dob.required' => '生年月日は必ず記入してください。',
            'postal.required' => '郵便番号は記入してください。',
            'postal.integer' => '数字のみ記入してください。',
            'prefectures.required' => '都道府県必ず選択してください。',
            'city.required' => '市区町村、番地まで記入してください。',
            'tel.required' => '電話番号は必ず記入してください。',
            'tel.numeric' => '番号のみ記入してください。',
            'transportation.required' => '交通手段は必ず選択してください。',
            'dinner_start_time.required' => 'ご夕食の時間は必ず選択してください。'
        ];
    }
}
