<?php

namespace ale10257\algorithms\arraySort;

class SelectionSort
{
    public function selectionSort(array $arr): array
    {
        $count = count($arr);
        for ($i = 0; $i < $count; $i++) {
            $min = $this->min($arr, $i);
            if ($min === $i) {
                continue;
            }
            $current = $arr[$i];
            $arr[$i] = $arr[$min];
            $arr[$min] = $current;
        }
        return $arr;
    }

    public function min(array $arr, int $index = 0): int
    {
        $minIndex = $index;
        $minValue = $arr[$minIndex];
        $count = count($arr);
        for ($i = $minIndex + 1; $i < $count; $i++) {
            if ($arr[$i] < $minValue) {
                $minIndex = $i;
                $minValue = $arr[$i];
            }
        }
        return $minIndex;
    }
}