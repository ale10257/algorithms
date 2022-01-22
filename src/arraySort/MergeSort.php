<?php

namespace ale10257\algorithms\arraySort;

class MergeSort extends BaseSort
{
    public function sort(array &$arr)
    {
        $count = count($arr);
        $size = 1;
        $dest = [];
        while ($size < $count) {
            $leftStart = 0;
            $leftEnd = $rightStart = $size;
            $rightEnd = min($rightStart + $size, $count);
            while (count($dest) < $count) {
                if ($arr[$leftStart] < $arr[$rightStart]) {
                    $dest[] = $arr[$leftStart];
                    $leftStart++;
                } else {
                    $dest[] = $arr[$rightStart];
                    $rightStart++;
                }
                if ($leftStart === $leftEnd || $rightStart === $rightEnd) {
                    for ($j = $rightStart; $j < $rightEnd; $j++) {
                        $dest[] = $arr[$j];
                    }
                    for ($j = $leftStart; $j < $leftEnd; $j++) {
                        $dest[] = $arr[$j];
                    }
                    if (count($dest) < $count) {
                        $leftStart = $rightEnd;
                        $leftEnd = min($leftStart + $size, $count);
                        if ($leftEnd === $count) {
                            for ($j = $leftStart; $j < $leftEnd; $j++) {
                                $dest[] = $arr[$j];
                            }
                        } else {
                            $rightStart = $leftEnd;
                            $rightEnd = min($rightStart + $size, $count);
                        }
                    }
                }
            }
            $arr = $dest;
            if ($this->steps) {
                echo ArrToString::arrToString($arr) . PHP_EOL;
            }
            $dest = [];
            $size *= 2;
        }
    }
}