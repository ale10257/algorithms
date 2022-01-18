<?php

namespace ale10257\algorithms\calculate;

use ale10257\algorithms\calculate\interfaces\IOperators;
use DomainException;

class CheckExpression implements IOperators
{
    private string $expression;

    public function __construct(string $expression)
    {
        $this->expression = $expression;
    }

    public function checkOperatorBetweenNumbers()
    {
        preg_match('/-?\d+\s+-?\d+/', $this->expression, $matches);
        if ($matches) {
            throw new DomainException('There is no operator between numbers!');
        }
    }

    public function checkBrackets()
    {
        $openBracket = substr_count($this->expression, self::OPEN_BRACKET);
        $closeBracket = substr_count($this->expression, self::CLOSE_BRACKET);
        if ($openBracket !== $closeBracket) {
            throw new DomainException('Unpaired parentheses!');
        }
    }

    public function replaceCommaToPoint()
    {
        $this->expression = str_replace(',', '.', $this->expression);
    }

    public function removeSpaces()
    {
        $this->expression = preg_replace('/\s/', '', $this->expression);
    }

    /** @noinspection RegExpRedundantEscape */
    public function validOperators()
    {
        // /[^\d()+\/*-.^]+/
        $pattern = '/[' .
            self::EXPONENTIATION .
            '\d' .
            self::OPEN_BRACKET .
            self::CLOSE_BRACKET .
            self::PLUS .
            '\\' .
            self::DIVISION .
            self::MULTIPLICATION .
            self::MINUS .
            '.' .
            self::EXPONENTIATION .
            ']+/';
        preg_match($pattern, $this->expression, $matches);
        if ($matches) {
            throw new DomainException('Error! A string can contain only numbers, brackets, and operators +, -, *, /, ^');
        }
    }

    public function checkInvalidExpression()
    {
        // перед скобкой нет оператора, после скобки нет оператора, неверное дробное выражение (.3 или 3.)
        preg_match('/(\d\()|(\)(\(|\d))|((^\.)|(\.$)|(\D\.)|(\.\D))/', $this->expression, $matches);
        if ($matches) {
            throw new DomainException('Invalid expression!');
        }
    }

    /** @noinspection RegExpRedundantEscape */
    public function checkInvalidOperator()
    {
        // /[+\/*.^]{2,}/
        $pattern = '/[' . self::PLUS . '\\' . self::DIVISION . self::MULTIPLICATION . '.' . self::EXPONENTIATION . ']{2,}/';
        preg_match($pattern, $this->expression, $matches);
        if ($matches) {
            throw new DomainException('Invalid operator: ' . $matches[0]);
        }
    }

    public function getExpression(): string
    {
        return $this->expression;
    }
}
