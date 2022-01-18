<?php

namespace ale10257\algorithms\calculate;

use InvalidArgumentException;

class LexemeCalculatorFunctions
{
    public function min(array $arr): float
    {
        if (count($arr) === 1) {
            throw new InvalidArgumentException('Multiple arguments must be passed to calculate the minimum value');
        }
        return min($arr);
    }

    public function rand(): int
    {
        return rand(1, 256);
    }

    public function average(array $arr): float|int
    {
        if (count($arr) === 1) {
            throw new InvalidArgumentException('To calculate the arithmetic mean, you need to pass several arguments');
        }
        return array_sum($arr) / count($arr);
    }
}