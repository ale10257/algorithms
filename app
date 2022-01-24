#!/usr/bin/env php
<?php
require_once (__DIR__) . '/vendor/autoload.php';

use ale10257\algorithms\Example;

try {
    if (empty($argv[1])) {
        echo 'Unknown command' . PHP_EOL;
        exit(1);
    }
    $example = new Example();
    $method = $argv[1];
    if (method_exists($example, $method)) {
        $example->$method();
    } else {
        echo 'Unknown command ' . $argv[1] . PHP_EOL;
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}


