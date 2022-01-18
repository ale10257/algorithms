<?php
require_once dirname((dirname(__DIR__))) . '/vendor/autoload.php';

use ale10257\algorithms\calculate\ArithmeticCalculator;
use ale10257\algorithms\calculate\LexemeCalculator;

$expr = '3 * ((-25 - 10 * -2 ^ 2 / 4) * (4 + 5)) / 2';
$calc = new ArithmeticCalculator($expr);
echo 'Result: ' . $calc->result . PHP_EOL;

$expr = '3.5 + min((-3 + 2), (-3 - 1)) * average(2 ^ 2 ^ 3, 1)';
$lexemeCalculator = new LexemeCalculator($expr);
echo 'Result: ' . $lexemeCalculator->result . PHP_EOL;
