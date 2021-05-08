<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'reserve/fill')
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
            'hurigana' => 'required',
            'gender' => 'required',
            'mail' => ['required', 'email'],
            'dob' => 'required',
            'postal' => ['integer', 'required'],
            'prefectures' => 'required',
            'city' => 'required',
            'building' => 'required',
            'tel' => ['required', 'integer'],
            'transportation' => 'required',
            'dinner_start_time' => 'required'
        ];
    }
}
