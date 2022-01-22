#!/usr/bin/env php
<?php
require_once dirname((dirname(__DIR__))) . '/vendor/autoload.php';

use ale10257\algorithms\arraySort\BubbleSort;
use ale10257\algorithms\arraySort\SelectionSort;
use ale10257\algorithms\arraySort\QuickSort;
use ale10257\algorithms\arraySort\MergeSort;
use ale10257\algorithms\arraySort\ArrToString;

for ($i = 0; $i < 100000; $i++) {
    $arr[] = rand(10, 1000000);
}

$arrayCopy = $arr;
$bubbleSort = new BubbleSort();

//$selectionSort = new SelectionSort();
//$start = microtime(true);
//$selectionSort->selectionSort($arr);
//$time = round(microtime(true) - $start, 4);
//echo 'Selection sort time: ' . $time . PHP_EOL;
//BubbleSort::sort($arr);

//$arr = $arrayCopy;
$quickSort = new QuickSort();
$start = microtime(true);
$quickSort->sort($arr);
$time = round(microtime(true) - $start, 4);
echo 'Quick sort time: ' . $time . PHP_EOL;
$bubbleSort->sort($arr);

$arr = $arrayCopy;
$mergeSort = new MergeSort();
$start = microtime(true);
$mergeSort->sort($arr);
$time = round(microtime(true) - $start, 4);
echo 'Merge sort time: ' . $time . PHP_EOL;
//echo ArrToString::arrToString($arr, false) . PHP_EOL;
$bubbleSort->sort($arr);

