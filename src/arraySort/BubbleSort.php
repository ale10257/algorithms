<?php

namespace ale10257\algorithms\arraySort;

use ale10257\algorithms\common\ArrToString;

class BubbleSort extends BaseSort
{
    private bool $isSorted = false;

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
                    if ($this->steps) {
                        echo ArrToString::arrToString($arr) . PHP_EOL;
                    }
                }
            }
        }
        if ($i === 0) {
            $this->isSorted = true;
            echo 'The array has already been sorted' . PHP_EOL;
        }
    }

    public function checkIsSorted(array &$arr)
    {
        $this->sort($arr);
        if ($this->isSorted) {
            echo 'The array has already been sorted' . PHP_EOL;
        } else {
            echo 'The array was not sorted' . PHP_EOL;
        }
    }
}