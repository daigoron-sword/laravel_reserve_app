<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class EditRoomSourceRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name' => ['required', 'unique:rooms,name,'.$request->base_name.',name'],
            'price' => ['required', 'integer'],
            'start_period' => 'required',
            'end_period' => 'required',   
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必ず入力してください。',
            'name.unique' => '他の部屋名と同じ名前は使えません。',
            'price.required' => '金額は必ず入力してください。',
            'price.integer' => '入力は数値で入力してください。',
            'start_period.required' => '入力必須です。',
            'end_period.required' => '入力必須です。',
        ];
    }

}
