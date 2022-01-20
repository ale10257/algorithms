<?php

namespace ale10257\algorithms\arraySort;

class ArrToString
{
    public static function arrToString(array $arr, bool $withIndex = true): string
    {
        if (!$withIndex) {
            return '[' . implode(' ', $arr) . ']';
        }
        $str = '[';
        $i = 0;
        foreach ($arr as $item) {
            if ($withIndex) {
                $str .= $i === 0 ? "$i-$item" : " $i-$item";
            }
            $i++;
        }
        $str .= ']';
        return $str;
    }
}