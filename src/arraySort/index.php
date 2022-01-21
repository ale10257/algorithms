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

$array = [64, 42, 73, 41, 32, 53, 16, 24, 57, 42, 74, 55, 36];
//$arr = [64, 42, 73, 41, 32, 53, 16, 24, 57, 42, 74, 55, 36];
//$start = microtime(true);
//BubbleSort::sort($arr);
//$time = round(microtime(true) - $start, 4);
//echo 'Bubble sort time: ' . $time . PHP_EOL;
////
//
//$selectionSort = new SelectionSort();
//$start = microtime(true);
//$selectionSort->selectionSort($arr);
//$time = round(microtime(true) - $start, 4);
//echo 'Selection sort time: ' . $time . PHP_EOL;
//
////$array = $arr;
//$quickSort = new QuickSort();
////echo $quickSort->arrToString($arr) . PHP_EOL . PHP_EOL;
//$start = microtime(true);
//$quickSort->sort($arr);
//$time = round(microtime(true) - $start, 4);
//echo 'Quick optimize sort time: ' . $time . PHP_EOL;
//echo $quickSort->arrToString($arr) . PHP_EOL;

//$start = microtime(true);
//$array = $quickSort->quickSort($array);
//$time = round(microtime(true) - $start, 4);
//echo 'Quick sort time: ' . $time . PHP_EOL;
//echo $quickSort->arrToString($arr) . PHP_EOL;

//$array = $arr;
$start = microtime(true);
$mergeSort = new MergeSort();
$mergeSort->mergeSort($arr);
//echo ArrToString::arrToString($array, false) . PHP_EOL;
$time = round(microtime(true) - $start, 4);
echo 'Merge sort time: ' . $time . PHP_EOL;
//echo ArrToString::arrToString($arr, false) . PHP_EOL;
//echo '========' . PHP_EOL;
//echo ArrToString::arrToString($mergeSort->mergeSort($array), false) . PHP_EOL;
//print_r($arr);
