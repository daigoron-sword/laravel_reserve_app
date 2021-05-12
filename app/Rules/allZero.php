<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


class allZero implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($ints)
    {
        $this->ints = $ints;

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
        $zero_count = 0;
        foreach($this->ints as $int => $i)
        {
            if($i == 0){
                $zero_count++;
            }
        }
        $list_count = count($this->ints);
        if($zero_count === $list_count )
        {
            return true;
        }
        return false;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '人数を選択してください。';
    }
}
