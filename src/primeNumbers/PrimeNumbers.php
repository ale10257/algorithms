<?php

namespace ale10257\algorithms\primeNumbers;

class PrimeNumbers
{
    public string|int|null $rangeStart = 2;
    public string|int|null $rangeEnd = null;

    public function getPrimeNumbers(): array
    {
        CheckNumber::check($this->rangeStart);
        CheckNumber::check($this->rangeEnd);
        $this->rangeStart = (int)$this->rangeStart;
        $this->rangeEnd = (int)$this->rangeEnd;
        $primeNumbers = [];
        for ($i = $this->rangeStart; $i <= $this->rangeEnd; $i++) {
            $primeNumbers[$i] = $i;
        }
        $limit = (int)sqrt($this->rangeEnd);
        for ($i = 2; $i <= $limit; $i++) {
            $j = $i;
            while (($number = $j * $i) <= $this->rangeEnd) {
                if (!empty($primeNumbers[$number])) {
                    unset($primeNumbers[$number]);
                }
                $j++;
            }
        }
        return $primeNumbers;
    }
}