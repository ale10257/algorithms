<?php

namespace ale10257\algorithms\arraySort;

class BubbleSort
{
    public static function sort(array $array): array
    {
        $isSorted = false;
        while (!$isSorted) {
            $isSorted = true;
            foreach ($array as $key => $item) {
                if ($key > 0 && $array[$key - 1] > $item) {
                    $prev = $array[$key - 1];
                    $array[$key - 1] = $item;
                    $array[$key] = $prev;
                    $isSorted = false;
                }
            }
        }
        return $array;
    }
}