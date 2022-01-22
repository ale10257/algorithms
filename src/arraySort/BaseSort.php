<?php

namespace ale10257\algorithms\arraySort;

abstract class BaseSort
{
    protected bool $steps = false;

    public abstract function sort(array &$arr);

    public function stepByStep() {
        $this->steps = true;
        $arr = [];
        for ($i = 0; $i < 5; $i++) {
            $arr[] = rand(10, 100);
        }
        echo PHP_EOL . 'Class ' . get_class($this) . '. Source array: ' . ArrToString::arrToString($arr) . PHP_EOL . PHP_EOL;
        $this->sort($arr);
    }
}