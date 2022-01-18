<?php

namespace ale10257\algorithms\calculate;

use InvalidArgumentException;

final class LexemeCalculator
{
    /** @var LexemeTypes[] */
    private array $lexemes = [];
    private int $position = 0;

    public ?float $result = null;

    public function __construct(string $expr)
    {
        $this->createLexemes($expr);
        $this->result = $this->calculateExpression();
    }

    /*------------------------------------------------------------------
     * PARSER RULES
     *------------------------------------------------------------------*/

    //    calculateExpression : plusMinus EOF?;
    //
    //    plusMinus: multiplicationDivision ( ( '+' | '-' ) multiplicationDivision )*;
    //
    //    multiplicationDivision : exponentiation ( ( '*' | '/' ) exponentiation )*;
    //
    //    exponentiation: analyzer ( '^' analyzer)*;
    //
    //    analyzer : func | unaryMinus | NUMBER | '(' calculateExpression ')';
    //
    //    unaryMinus: '-' analyzer
    //
    //    func : name '(' (calculateExpression (',' calculateExpression)+)? ')'

    private function calculateExpression(): float
    {
        return $this->plusMinus();
    }

    private function plusMinus(): float
    {
        $value = $this->multiplicationDivision();
        while (true) {
            $lexeme = $this->getCurrent();
            if ($lexeme->getValue() === $lexeme::EOF) {
                return $value;
            }
            switch ($lexeme->getValue()) {
                case $lexeme::PLUS:
                    $value += $this->multiplicationDivision();
                    break;
                case $lexeme::MINUS:
                    $value -= $this->multiplicationDivision();
                    break;
                default:
                    $this->prev();
                    return $value;
            }
        }
    }

    private function multiplicationDivision(): float
    {
        $value = $this->exponentiation();
        while (true) {
            $lexeme = $this->getCurrent();
            if ($lexeme->getValue() === $lexeme::EOF) {
                return $value;
            }
            switch ($lexeme->getValue()) {
                case $lexeme::MULTIPLICATION:
                    $value *= $this->exponentiation();
                    break;
                case $lexeme::DIVISION:
                    $value /= $this->exponentiation();
                    break;
                default:
                    $this->prev();
                    return $value;
            }
        }
    }

    private function exponentiation(): float
    {
        $exponentiationArr = [];
        while (true) {
            $value = $this->analyzer();
            $lexeme = $this->getCurrent();
            if ($lexeme->getValue() === $lexeme::EXPONENTIATION) {
                $exponentiationArr[] = $value;
                continue;
            } else {
                if ($exponentiationArr) {
                    $exponentiationArr[] = $value;
                    while (count($exponentiationArr) !== 1) {
                        $right = array_pop($exponentiationArr);
                        $left = array_pop($exponentiationArr);
                        $value = $left ** $right;
                        $exponentiationArr[] = $value;
                    }
                }
            }
            $this->prev();
            return $value;
        }
    }

    private function analyzer(): float
    {
        $lexeme = $this->getCurrent();
        if ($lexeme->getType() === $lexeme::NUMBER || $lexeme->getType() === $lexeme::EOF) {
            return $lexeme->getValue();
        }
        if ($lexeme->getType() === $lexeme::OPERATOR) {
            if ($lexeme->getValue() === $lexeme::MINUS) {
                $value = $this->analyzer();
                return $value * -1;
            }
            if ($lexeme->getValue() === $lexeme::OPEN_BRACKET) {
                $value = $this->calculateExpression();
                $this->next();
                return $value;
            }
        }
        if ($lexeme->getType() === $lexeme::NAME_FUNC) {
            return $this->func($lexeme->getValue());
        }
        throw new InvalidArgumentException('Failed to parse expression!');
    }

    private function getCurrent(): LexemeTypes
    {
        $lengthArr = count($this->lexemes) - 1;
        $lexeme = $this->lexemes[$this->position];
        if ($this->position < $lengthArr) {
            $this->next();
        }
        return $lexeme;
    }

    private function next()
    {
        $this->position++;
    }

    private function prev()
    {
        $this->position--;
    }

    private function createLexemes(string $expr)
    {
        $expr = $this->check($expr);
        $number = null;
        $length = strlen($expr) - 1;
        $funcName = null;
        for ($i = 0; $i <= $length; $i++) {
            if (is_numeric($expr[$i]) || $expr[$i] === '.') {
                $number .= $expr[$i];
                if ($i === $length) {
                    $this->lexemes[] = (new LexemeTypes())->setData($number);
                    $this->lexemes[] = (new LexemeTypes())->setData(LexemeTypes::EOF);
                }
            } else {
                if ($number !== null) {
                    $this->lexemes[] = (new LexemeTypes())->setData($number);
                    $number = null;
                }
                if (LexemeTypes::isOperator($expr[$i])) {
                    $this->lexemes[] = (new LexemeTypes())->setData($expr[$i]);
                    if ($i === $length) {
                        $this->lexemes[] = (new LexemeTypes())->setData(LexemeTypes::EOF);
                    }
                } else {
                    while ($expr[$i] !== LexemeTypes::OPEN_BRACKET) {
                        $funcName .= $expr[$i];
                        $i++;
                    }
                    $this->lexemes[] = (new LexemeTypes())->setData($funcName);
                    $this->lexemes[] = (new LexemeTypes())->setData($expr[$i]);
                    $funcName = null;
                }
            }
        }
    }

    private function func(string $funcName)
    {
        $lexeme = $this->getCurrent();
        if ($lexeme->getValue() !== LexemeTypes::OPEN_BRACKET) {
            throw new InvalidArgumentException('There must be an opening parenthesis after the function name!');
        }
        $lexeme = $this->getCurrent();
        $args = [];
        if ($lexeme->getValue() !== LexemeTypes::CLOSE_BRACKET) {
            $this->prev();
            while (true) {
                $args[] = $this->calculateExpression();
                $lexeme = $this->getCurrent();
                if ($lexeme->getValue() === LexemeTypes::CLOSE_BRACKET) {
                    break;
                }
            }
        }
        $calculatorFunctions = new LexemeCalculatorFunctions();
        return $args ? $calculatorFunctions->$funcName($args) : $calculatorFunctions->$funcName();
    }

    public function check(string $expression): string
    {
        $checkExpression = new CheckExpression($expression);
        $checkExpression->checkOperatorBetweenNumbers();
        $checkExpression->checkBrackets();
        $checkExpression->removeSpaces();
        $checkExpression->checkInvalidExpression();
        $checkExpression->checkInvalidOperator();
        return $checkExpression->getExpression();
    }
}