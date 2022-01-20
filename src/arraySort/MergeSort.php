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

    public function mergeSort(array $arr): array
    {
        $count = count($arr);
        if ($count <= 1) {
            return $arr;
        }

        $left = array_slice($arr, 0, (int)($count / 2));
        $right = array_slice($arr, (int)($count / 2));

        $left = $this->mergeSort($left);
        $right = $this->mergeSort($right);

        return $this->mergeO($left, $right);
    }

    public function mergeO(array $left, array &$right)
    {
        $ret = [];
        while (count($left) > 0 && count($right) > 0) {
            if ($left[0] < $right[0]) {
                $ret[] = array_shift($left);
            } else {
                $ret[] = array_shift($right);
            }
        }

        array_splice($ret, count($ret), 0, $left);
        array_splice($ret, count($ret), 0, $right);

        return $ret;
    }
}