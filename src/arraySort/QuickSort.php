<?php

namespace ale10257\algorithms\arraySort;

class QuickSort extends BaseSort
{
    public function sort(array &$arr)
    {
        $this->quickSort($arr, 0, count($arr) - 1);
    }

    private function quickSort(array &$arr, int $from, int $to)
    {
        if ($from < $to) {
            $divideIndex = $this->partition($arr, $from, $to);
            $this->quickSort($arr, $from, $divideIndex - 1);
            $this->quickSort($arr, $divideIndex, $to);
        }
    }

    private function partition(array &$arr, int $from, int $to): int
    {
        $rightIndex = $to;
        $leftIndex = $from;
        $pivotIndex = (int)($from + ($to - $from) / 2);
        $pivot = $arr[$pivotIndex];

        while ($leftIndex <= $rightIndex) {
            while ($arr[$leftIndex] < $pivot) {
                $leftIndex++;
            }
            while ($arr[$rightIndex] > $pivot) {
                $rightIndex--;
            }
            if ($leftIndex <= $rightIndex) {
                if ($rightIndex !== $leftIndex) {
                    $tmp = $arr[$rightIndex];
                    $arr[$rightIndex] = $arr[$leftIndex];
                    $arr[$leftIndex] = $tmp;
                    $rightIndex--;
                }
                $leftIndex++;
            }
        }
        if ($this->steps) {
            $this->printSortStep($arr, $from, $to, $leftIndex, $pivotIndex, $pivot);
        }
        return $leftIndex;
    }

    private function printSortStep(array $arr, int $from, int $to, int $partitionIndex, int $pivotIndex, int $pivot)
    {
        echo 'from:' . $from . ' ' . 'to: ' . $to . ' ' . 'pivotIndex: ' . $pivotIndex . ' ' . 'pivot: ' . $pivot . PHP_EOL;
        $left = $right = [];
        for ($i = $from; $i < $partitionIndex; $i++) {
            $left[] = $arr[$i];
        }
        for ($i = $partitionIndex; $i < $to + 1; $i++) {
            $right[] = $arr[$i];
        }
        echo 'Left: ' . ArrToString::arrToString($left) . ' ' . 'Right: ' . ArrToString::arrToString($right) . PHP_EOL;
        echo 'Current array: ' . ArrToString::arrToString($arr) . PHP_EOL;
        echo PHP_EOL;
    }
}
