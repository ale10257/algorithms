#!/usr/bin/env php
<?php
require_once dirname((dirname(__DIR__))) . '/vendor/autoload.php';

use ale10257\algorithms\primeNumbers\PrimeNumbers;
use ale10257\algorithms\primeNumbers\PrimeNumberTest;

$calculateType = readline(
    'What will we calculate? Get prime numbers in a given range (enter 1), or test a number for primeness (enter 2): '
);
if ($calculateType != 1 && $calculateType != 2) {
    echo 'Unknown value ' . $calculateType . PHP_EOL;
    exit(1);
}
if ($calculateType == 1) {
    $primeNumbers = new PrimeNumbers();
    $rangeStart = readline('Enter the start value of the range (default 2): ');
    if ($rangeStart) {
        $primeNumbers->rangeStart = $rangeStart;
    }
    $primeNumbers->rangeEnd = readline('Enter end of range value (min 2): ');
    echo 'Prime numbers: ' . PHP_EOL . implode(', ', $primeNumbers->getPrimeNumbers()) . PHP_EOL;
    exit(0);
}
$number = readline('Enter a number to test for primality: ');
if (PrimeNumberTest::test($number)) {
    echo $number . ' is a prime number' . PHP_EOL;
    exit(0);
}
echo $number . ' is not a prime number' . PHP_EOL;

