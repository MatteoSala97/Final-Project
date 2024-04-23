<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContainsNumber implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/\d/', $value) === 1; // Check if the value contains at least one number
    }

    public function message()
    {
        return 'Make sure to include your street number in the address';
    }
}
