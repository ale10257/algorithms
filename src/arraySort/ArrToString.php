<?php

namespace ale10257\algorithms\arraySort;

class ArrToString
{
    public static function arrToString(array $arr): string
    {
        return '[' . implode(' ', $arr) . ']';
    }
}