<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanTypeRequest extends FormRequest
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
        $varidate_func = function($atribute, $value, $fail)
        {
            $input_data = $this->all();
            $type_1 = $input_data['type_id']['1'];
            $type_2 = $input_data['type_id']['2'];
            $type_3 = $input_data['type_id']['3'];
            $type_4 = $input_data['type_id']['4'];
            $type_5 = $input_data['type_id']['5'];
            $type_6 = $input_data['type_id']['6'];
            $type_8 = $input_data['type_id']['8'];
            $type_10 = $input_data['type_id']["10"];
            if(0 == $type_1 && 0 == $type_2 )
            {
                return $fail('大人のお客様は最低でも2人でお願いします。');
            }

            $sum = $type_1 + $type_2;
            if($sum == 1)
            {
                return $fail('大人のお客様は最低でも2人でお願いします。');
            }

            $sum = $type_1 + $type_2 + $type_3 + $type_4 + $type_5 + $type_6 + $type_8 + $type_10;
            if(2 > $sum || 4 < $sum )
            {
                return $fail('定員は2～4名様(寝具なしのお子様はカウントされません)でお願いします。');
            }

        };
        return [
            'meal_plan_id' => 'required',
            'type_id.2' => $varidate_func
        ];
    }

    public function messages()
    {
        return [
            'meal_plan_id.required' => 'プランを選択してください。'
        ];
    }

}
