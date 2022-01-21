<?php

namespace ale10257\algorithms\arraySort;

class MergeSort
{
    private array $array;

    public function sortMerge(array &$array)
    {
        $this->array = &$array;
        $size = 1;
        $count = count($this->array);
        while ($size < $count) {
            for ($i = 0; $i < $count; $i += 2 * $size) {
                $this->merge($i, $i + $size, $size);
            }
            $size *= 2;
            //echo ArrToString::arrToString($this->array, false) . PHP_EOL;
        }
        //return $this->array;
    }

    private function merge(int $leftIndex, int $rightIndex, int $size)
    {
        $dest = $this->array;
        $count = count($this->array);

        $arrayLeftEnd = min($leftIndex + $size, $count);
        $arrayRightEnd = min($rightIndex + $size, $count);

        if ($leftIndex + $size > $count) {
            return;
        }

        $iterationCount = $arrayLeftEnd + $arrayRightEnd - $rightIndex;

        for ($i = $leftIndex; $i < $iterationCount; $i++) {
            if (
                $leftIndex < $arrayLeftEnd
                &&
                (
                    $rightIndex >= $arrayRightEnd
                    || $this->array[$leftIndex] < $this->array[$rightIndex]
                )
            ) {
                $dest[$i] = $this->array[$leftIndex];
                $leftIndex++;
            } else {
                $dest[$i] = $this->array[$rightIndex];
                $rightIndex++;
            }
        }
        $this->array = $dest;
        unset($dest);
    }

    public function mergeSort(array $arr, int $size = 1): array|null
    {
        if ($size >= count($arr)) {
            return $arr;
        }
        if ($size === 1) {
            $count = count($arr);
            for ($i = 1; $i < $count; $i += 2) {
                if ($arr[$i - 1] > $arr[$i]) {
                    $tmp =  $arr[$i];
                    $arr[$i] = $arr[$i - 1];
                    $arr[$i - 1] = $tmp;
                }
            }
            $size *= 2;
        }
        $arrays = array_chunk($arr, $size);
        $arr = [];
        while ($arrays) {
            $left = array_shift($arrays) ?: [];
            $right = array_shift($arrays) ?: [];
            while ($left && $right) {
                if ($left[0] < $right[0]) {
                    $arr[] = array_shift($left);
                } else {
                    $arr[] = array_shift($right);
                }
            }
            $arr = array_merge($arr, $left, $right);
        }
        //echo ArrToString::arrToString($arr, false) . PHP_EOL;
        $this->mergeSort($arr, $size * 2);
        return null;
    }
}