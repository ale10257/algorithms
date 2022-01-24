<?php

namespace ale10257\algorithms\backpack;

use ale10257\algorithms\common\BaseObject;
use InvalidArgumentException;

/**
 * @property int $itemNumber {@see ItemBackPackDto::getItemNumber(), ItemBackPackDto::setItemNumber()}
 * @property int $weight {@see ItemBackPackDto::getWeight(), ItemBackPackDto::setWeight()}
 * @property int $price {@see ItemBackPackDto::getPrice(), ItemBackPackDto::setPrice()}
 */
class ItemBackPackDto extends BaseObject
{
    private int $itemNumber;
    private int $weight;
    private int $price;

    /**
     * @return int
     */
    public function getItemNumber(): int
    {
        return $this->itemNumber;
    }

    /**
     * @param int $itemNumber
     */
    public function setItemNumber(int $itemNumber): void
    {
        $this->check($itemNumber);
        $this->itemNumber = $itemNumber;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight): void
    {
        $this->check($weight);
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->check($price);
        $this->price = $price;
    }

    public function check(int $value)
    {
        if ($value < 1) {
            throw new InvalidArgumentException('Passed value less than 1');
        }
    }

}