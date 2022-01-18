<?php

namespace ale10257\algorithms\primeNumbers;

class PrimeNumberTest
{
    public static function test(string|int $number): bool
    {
        CheckNumber::check($number);
        $number = (int)$number;
        if ($number % 2 === 0) {
            return $number === 2;
        }
        if ($number % 3 === 0) {
            return $number === 3;
        }
        $limit = (int)sqrt($number);
        for ($i = 5; $i <= $limit; $i += 6) {
            if ($number % $i === 0 || $number % $i + 2 === 0) {
                return false;
            }
        }
        return true;
    }
}