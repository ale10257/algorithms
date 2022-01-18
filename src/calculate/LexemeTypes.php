<?php

namespace ale10257\algorithms\calculate;

use ale10257\algorithms\calculate\interfaces\IComma;
use ale10257\algorithms\calculate\interfaces\IOperators;
use InvalidArgumentException;

class LexemeTypes implements IOperators, IComma
{
    const OPERATOR = 'operator';
    const NUMBER = 'number';
    const NAME_FUNC = 'nameFunc';
    const EOF = '';

    private string $type;
    private string|float $value;

    public function setData(string $value): self
    {
        if ($value === self::EOF) {
            $this->type = self::EOF;
            $this->value = self::EOF;
            return $this;
        }
        if (is_numeric($value)) {
            $this->type = self::NUMBER;
            $this->value = (float)$value;
            return $this;
        }
        if (self::isOperator($value)) {
            $this->type = self::OPERATOR;
            $this->value = $value;
            return $this;
        }
        if (method_exists(LexemeCalculatorFunctions::class, $value)) {
            $this->type = self::NAME_FUNC;
            $this->value = $value;
            return $this;
        }
        throw new InvalidArgumentException('Unknown symbol ' . $value);
    }

    public static function isOperator(string $value): bool
    {
        return $value === self::OPEN_BRACKET
            || $value === self::CLOSE_BRACKET
            || $value === self::MINUS
            || $value === self::PLUS
            || $value === self::DIVISION
            || $value === self::MULTIPLICATION
            || $value === self::COMMA
            || $value === self::EXPONENTIATION;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): float|string
    {
        return $this->value;
    }
}
