<?php

namespace ale10257\algorithms;

use ale10257\algorithms\arraySort\BubbleSort;
use ale10257\algorithms\arraySort\MergeSort;
use ale10257\algorithms\arraySort\QuickSort;
use ale10257\algorithms\arraySort\SelectionSort;
use ale10257\algorithms\common\ArrToString;
use ale10257\algorithms\backpack\Backpack;
use ale10257\algorithms\backpack\ItemBackPackDto;
use ale10257\algorithms\calculate\ArithmeticCalculator;
use ale10257\algorithms\calculate\LexemeCalculator;
use ale10257\algorithms\common\Timer;
use ale10257\algorithms\primeNumbers\PrimeNumbers;
use ale10257\algorithms\primeNumbers\PrimeNumberTest;

class Example
{
    public function calc()
    {
        $expr = readline('Enter expression example 3 * ((-25 - 10 * -2 ^ 2 / 4) * (4 + 5)) / 2 : ');
        $calc = new ArithmeticCalculator($expr);
        echo 'Result: ' . $calc->result . PHP_EOL;
    }

    public function lexeme()
    {
        $expr = readline('Enter expression example 3.5 + min((-3 + 2), (-3 - 1)) * average(2 ^ 2 ^ 3, 1) : ');
        $calc = new LexemeCalculator($expr);
        echo 'Result: ' . $calc->result . PHP_EOL;
    }

    public function prime()
    {
        $primeNumbers = new PrimeNumbers();
        $rangeStart = readline('Enter the start value of the range (default 2): ');
        if ($rangeStart) {
            $primeNumbers->rangeStart = $rangeStart;
        }
        $primeNumbers->rangeEnd = readline('Enter end of range value (min 2): ');
        echo 'Prime numbers: ' . PHP_EOL . implode(', ', $primeNumbers->getPrimeNumbers()) . PHP_EOL;
    }

    public function checkPrime()
    {
        $number = readline('Enter a number to test for primality: ');
        if (PrimeNumberTest::test($number)) {
            echo $number . ' is a prime number' . PHP_EOL;
            exit(0);
        }
        echo $number . ' is not a prime number' . PHP_EOL;
    }

    public function backpack()
    {
        $weightItems = trim(readline('Enter the weight of each item for the backpack, example 2 3 4 5 : '));
        $costItems = trim(readline('Enter the cost of each backpack item, example 1 10 3 7 : '));
        $maxWeight = trim(readline('Enter the maximum weight of the backpack: '));
        $weightItemsArr = explode(' ', $weightItems);
        $costItemsArr = explode(' ', $costItems);
        if (count($weightItemsArr) !== count($costItemsArr)) {
            throw new \InvalidArgumentException('The number of items does not match');
        }
        $items = [];
        $backpack = new Backpack();
        for ($i = 0; $i < count($weightItemsArr); $i++) {
            $item = new ItemBackPackDto();
            $item->weight = $weightItemsArr[$i];
            $item->price = $costItemsArr[$i];
            $item->itemNumber = $i + 1;
            $items[] = $item;
        }
        $backpack->items = $items;
        $backpack->maxWeight = $maxWeight;
        $result = $backpack->calculate();
        echo 'Matrix: ' . PHP_EOL;
        foreach ($backpack->matrix as $item) {
            echo implode(' ', $item) . PHP_EOL;
        }

        echo PHP_EOL;

        echo 'Source items' . PHP_EOL
            . 'Weights: ' . ArrToString::arrToString($weightItemsArr)
            . ' Cost: ' . ArrToString::arrToString($costItemsArr)
            . ' maxWeight: ' . $maxWeight
            . PHP_EOL . PHP_EOL;

        echo 'Result: ' . PHP_EOL;
        echo ArrToString::arrWithKeyToString($result) . PHP_EOL;
    }

    public function sort()
    {
        $arr = $this->getSortTypes();
        $types = trim(readline('Select algorithms to compare performance: BubbleSort (1), SelectionSort (2), QuickSort (3), MergeSort(4), for example: 2 3 4 : '));
        $numberIterations = (int)readline('Enter number of iterations, for example: 1000 : ');
        $typesArr = explode(' ', $types);
        for ($i = 0; $i < $numberIterations; $i++) {
            $array[] = rand(10, 1000000);
        }
        foreach ($typesArr as $item) {
            if (array_key_exists($item, $arr)) {
                $classname = (new \ReflectionClass($arr[$item]))->getShortName();
                $timer = new Timer($classname);
                $arrayCopy = $array;
                echo PHP_EOL;
                $timer->begin();
                $arr[$item]->sort($arrayCopy);
                $timer->end();
            }
        }
    }

    public function sortStep()
    {
        $arr = $this->getSortTypes();
        $type = trim(readline('Choose an algorithm for step-by-step output of results: BubbleSort (1), SelectionSort (2), QuickSort (3), MergeSort(4), for example: 2  : '));
        $type = (int)$type;
        if (array_key_exists($type, $arr)) {
            $arr[$type]->stepByStep();
        }
    }

    private function getSortTypes(): array
    {
        return [
            1 => new BubbleSort(),
            2 => new SelectionSort(),
            3 => new QuickSort(),
            4 => new MergeSort()
        ];
    }
}