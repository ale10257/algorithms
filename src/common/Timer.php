<?php

namespace ale10257\algorithms\common;

class Timer
{
    private float $startTime;
    private float $memory;
    private string $str;

    public function __construct(string $str)
    {
        $this->str = $str;
    }

    public function begin()
    {
        $this->startTime = microtime(true);
        $this->memory = memory_get_usage();
    }

    public function end()
    {
        echo $this->str . ' time: ' . round(microtime(true) - $this->startTime, 4) . PHP_EOL;
        $memory = memory_get_usage() - $this->memory;
        $i = 0;
        while (floor($memory / 1024) > 0) {
            $i++;
            $memory /= 1024;
        }
        echo 'All memory: ' . round($memory) . 'mb' . PHP_EOL;
    }
}