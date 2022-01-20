<?php

namespace ale10257\algorithms\arraySort;

class MergeSort
{
    public function sort(&$array)
    {
        $dest = [];
        $size = 1;
        $count = count($array);
        $mergeSortDto = new MergeSortDto();
        while (true) {
            if ($size >= $count) {
                unset($dest);
                break;
            }
            for ($i = 0; $i < $count; $i += 2 * $size) {
                $mergeSortDto->arrayLeft = $array;
                $mergeSortDto->arrayRight = $array;
                $mergeSortDto->arrayLeftStart = $i;
                $mergeSortDto->arrayRightStart = $i + $size;
                //$mergeSortDto->dest = &$dest;
                $mergeSortDto->destStart = $i;
                $mergeSortDto->size = $size;
                $this->mergeOptimizer($mergeSortDto);
            }
            $tmp = $array;
            $array = $dest;
            $dest = $tmp;
            $size *= 2;
            echo 'Tmp: ' . ArrToString::arrToString($tmp, false) . PHP_EOL;
            echo 'Arr: ' . ArrToString::arrToString($array, false) . PHP_EOL . PHP_EOL;
        }
    }

    private function mergeOptimizer(MergeSortDto $mergeSortDto) {

        $arrayLeftIndex = $mergeSortDto->arrayLeftStart;
        $arrayRightIndex = $mergeSortDto->arrayRightStart;

        $arrayLeftEnd = min($arrayLeftIndex + $mergeSortDto->size, count($mergeSortDto->arrayLeft));
        $arrayRightEnd = min($arrayRightIndex + $mergeSortDto->size, count($mergeSortDto->arrayRight));

        $count = count($mergeSortDto->arrayLeft);
        if ($arrayLeftIndex + $mergeSortDto->size > $count) {
            for ($i = $arrayLeftIndex; $i < $arrayLeftEnd; $i++) {
                $mergeSortDto->dest[$i] = $mergeSortDto->arrayLeft[$i];
            }
            return;
        }

        $iterationCount = ($arrayLeftEnd - $mergeSortDto->arrayLeftStart) + ($arrayRightEnd - $mergeSortDto->arrayRightStart);

        for ($i = $mergeSortDto->destStart; $i < $mergeSortDto->destStart + $iterationCount; $i++) {
            if ($arrayLeftIndex < $arrayLeftEnd && ($arrayRightIndex >= $arrayRightEnd || $mergeSortDto->arrayLeft[$arrayLeftIndex] < $mergeSortDto->arrayRight[$arrayRightIndex])) {
                $mergeSortDto->dest[$i] = $mergeSortDto->arrayLeft[$arrayLeftIndex];
                $arrayLeftIndex++;
            } else {
                $mergeSortDto->dest[$i] = $mergeSortDto->arrayRight[$arrayRightIndex];
                $arrayRightIndex++;
            }
        }
    }

    public function mergeSort(array $arr): array
    {
        $count = count($arr);
        if ($count <= 1) {
            return $arr;
        }
        $left  = array_slice($arr, 0, (int)($count/2));
        $right = array_slice($arr, (int)($count/2));
        $left = $this->mergeSort($left);
        $right = $this->mergeSort($right);
        return $this->merge($left, $right);
    }

    private function merge(array $left, array $right): array
    {
        $ret = array();
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