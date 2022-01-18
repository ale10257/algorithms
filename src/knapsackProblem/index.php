#!/usr/bin/env php
<?php
require_once dirname((dirname(__DIR__))) . '/vendor/autoload.php';

use ale10257\algorithms\knapsackProblem\ItemDto;
use ale10257\algorithms\knapsackProblem\KnapsackProblem;

$knapsackProblem = new KnapsackProblem();
$knapsackProblem->maxWeight = 8;
$weights = [1, 5, 3];
$prices = [2, 3, 4];
$items = [];

for ($i = 0; $i < count($weights); $i++) {
    $item = new ItemDto();
    $item->weight = $weights[$i];
    $item->price = $prices[$i];
    $item->number = $i + 1;
    $items[] = $item;
}
$knapsackProblem->items = $items;
$result = $knapsackProblem->calculate();

echo 'Matrix: ' . PHP_EOL;
foreach ($knapsackProblem->matrix as $item) {
    echo implode(' ', $item) . PHP_EOL;
}

echo PHP_EOL;
echo 'Result: ' . PHP_EOL;
print_r($result);
