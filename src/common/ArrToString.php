<?php

namespace ale10257\algorithms\common;

class ArrToString
{
    public static function arrToString(array $arr): string
    {
        return '[' . implode(' ', $arr) . ']';
    }

    public static function arrWithKeyToString(array $arr): string
    {
        $str = '[';
        foreach ($arr as $items) {
            $count = count($items);
            $i = 1;
            foreach ($items as $key => $item) {
                $str .= $key . ':' . $item;
                if ($i < $count) {
                    $str .= ', ';
                } else {
                    $str .= '; ';
                }
                $i++;
            }
        }
        $str .= ']';
        return $str;
    }
}