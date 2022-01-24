<?php

namespace ale10257\algorithms\backpack;

class Backpack
{
    public int $maxWeight = 10;
    /** @var ItemBackPackDto[] */
    public array $items = [];
    public array $matrix = [];
    private array $result = [];

    public function calculate(): array
    {
        $count = count($this->items);
        for ($row = 0; $row <= $count; $row++) {
            $item = $this->items[$row - 1] ?? null;
            for ($weight = 0; $weight <= $this->maxWeight; $weight++) {
                if ($row === 0 || $weight === 0) {
                    $this->matrix[$row][$weight] = 0;
                } else {
                    if ($weight >= $item->weight) {
                        $prevCostForWeight = $this->matrix[$row - 1][$weight];
                        $costInCellPrev = $this->matrix[$row - 1][$weight - $item->weight];
                        $currentCostForWeight = $costInCellPrev + $item->price;
                        $this->matrix[$row][$weight] = max($prevCostForWeight, $currentCostForWeight);
                    } else {
                        $this->matrix[$row][$weight] = $this->matrix[$row - 1][$weight];
                    }
                }
            }
        }
        $this->trace($count, $this->maxWeight);
        return $this->result;
    }

    private function trace(int $count, int $weight)
    {
        if ($this->matrix[$count][$weight] === 0) {
            return;
        }
        if ($this->matrix[$count - 1][$weight] === $this->matrix[$count][$weight]) {
            $this->trace(--$count, $weight);
        } else {
            $count--;
            $item = $this->items[$count];
            $this->result[] = [
                'number' => $item->itemNumber,
                'weight' => $item->weight,
                'price' => $item->price,
            ];
            $weight -= $item->weight;
            $this->trace($count, $weight);
        }
    }
}
