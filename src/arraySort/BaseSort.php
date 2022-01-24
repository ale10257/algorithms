<?php

namespace ale10257\algorithms\arraySort;

use ale10257\algorithms\common\ArrToString;

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
        $classname = (new \ReflectionClass($this))->getShortName();
        echo PHP_EOL . 'Class ' . $classname . '. Source array: ' . ArrToString::arrToString($arr) . PHP_EOL;
        echo 'Steps: ' . PHP_EOL;
        $this->sort($arr);
    }
}