<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class fullWidth implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // 全角がどうか判定する
        return preg_match("/^[ぁ-んァ-ヶ一-龥々０-９ａ-ｚＡ-Ｚー・’＠]+$/u", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '全て全角で記入してください';
    }
}
