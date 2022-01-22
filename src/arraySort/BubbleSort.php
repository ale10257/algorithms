<?php

namespace ale10257\algorithms\arraySort;

class BubbleSort implements ISort
{
    public function sort(array &$arr)
    {
        $isSorted = false;
        $i = 0;
        while (!$isSorted) {
            $isSorted = true;
            foreach ($arr as $key => $item) {
                if ($key > 0 && $arr[$key - 1] > $item) {
                    $prev = $arr[$key - 1];
                    $arr[$key - 1] = $item;
                    $arr[$key] = $prev;
                    $isSorted = false;
                    $i++;
                }
            }
        }
        if ($i === 0) {
            echo 'The array has already been sorted' . PHP_EOL;
        }
    }
}