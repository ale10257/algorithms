<?php

namespace ale10257\algorithms\primeNumbers;

use InvalidArgumentException;

class CheckNumber
{
    public static function check(int|string $number)
    {
        if (!is_numeric($number)) {
            throw new InvalidArgumentException('Not a number sent!');
        }
        if ($number < 2) {
            throw new InvalidArgumentException('The passed value cannot be less than the number 2');
        }
        if (str_contains($number, '.')) {
            throw new InvalidArgumentException('Not an integer passed!');
        }
    }
}