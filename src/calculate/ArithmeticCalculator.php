<?php

namespace ale10257\algorithms\calculate;

use ale10257\algorithms\calculate\interfaces\IOperators;
use ale10257\algorithms\calculate\interfaces\IUnaryMinus;
use ale10257\algorithms\calculate\CheckExpression;
use DomainException;
use Ds\Stack;
use Exception;

final class ArithmeticCalculator implements IOperators, IUnaryMinus
{
    const PRIORITY = [
        self::OPEN_BRACKET => 0,
        self::PLUS => 1,
        self::MINUS => 1,
        self::MULTIPLICATION => 2,
        self::DIVISION => 2,
        self::EXPONENTIATION => 3,
        self::UNARY_MINUS => 4
    ];

    const RIGHT_ASSOCIATIVE_EXPRESSION = [
        self::EXPONENTIATION, self::UNARY_MINUS
    ];

    private string $expression;
    private int $position = 0;
    private int $length;

    private Stack $operatorStack;
    private Stack $numberStack;

    public float|string $result;

    public function __construct(string $expression)
    {
        try {
            $this->expression = $this->checkExpression($expression);
            $this->length = strlen($this->expression);
            $this->numberStack = new Stack();
            $this->operatorStack = new Stack();
            while ($this->position !== $this->length) {
                is_numeric($this->getItem()) ? $this->isNumeric() : $this->isOperator();
            }
            while ($this->operatorStack->count() !== 0) {
                $this->calculateFromStack();
            }
            $this->result = $this->numberStack->pop();
        } catch (Exception $e) {
            $this->result = $e->getMessage() ?: 'Invalid expression!';
        }
    }

    private function calculateFromStack(): bool
    {
        $operator = $this->operatorStack->pop();
        if ($operator == self::OPEN_BRACKET) {
            return false;
        }

        if ($operator === self::UNARY_MINUS) {
            $this->numberStack->push(0 - $this->numberStack->pop());
            return true;
        }

        $right = $this->numberStack->pop();
        $left = $this->numberStack->pop();

        switch ($operator) {
            case self::MINUS:
                $this->numberStack->push($left - $right);
                break;
            case self::PLUS:
                $this->numberStack->push($left + $right);
                break;
            case self::MULTIPLICATION:
                $this->numberStack->push($left * $right);
                break;
            case self::EXPONENTIATION:
                $this->numberStack->push($left ** $right);
                break;
            case self::DIVISION:
                if ($right === 0.0) {
                    throw new DomainException('Division by zero!');
                }
                $this->numberStack->push($left / $right);
                break;
        }
        return true;
    }

    private function isNumeric(): void
    {
        $number = $this->getItem();
        while (true) {
            $right = $this->position === $this->length - 1 ? null : $this->expression[$this->position + 1];
            $this->position++;
            if ($right !== '.' && !is_numeric($right)) {
                $this->numberStack->push((float)$number);
                break;
            }
            $number .= $this->expression[$this->position];
        }
    }

    private function isOperator(): void
    {
        $operator = $this->getItem();
        $left = $this->position === 0 ? null : $this->expression[$this->position - 1];
        $this->position++;

        if ($operator === self::MINUS && !is_numeric($left) && $left !== self::CLOSE_BRACKET) {
            $operator = self::UNARY_MINUS;
        }

        if ($operator === self::CLOSE_BRACKET) {
            do {
                $result = $this->calculateFromStack();
            } while ($result);
            return;
        }

        $stop = (!$this->operatorStack->count() || $operator === self::OPEN_BRACKET)
            ||
            (in_array($operator, self::RIGHT_ASSOCIATIVE_EXPRESSION) && $this->operatorStack->peek() === $operator)
            ||
            (self::PRIORITY[$this->operatorStack->peek()] < self::PRIORITY[$operator]);
        if ($stop) {
            $this->operatorStack->push($operator);
            return;
        }

        while ($this->operatorStack->count() !== 0) {
            if (self::PRIORITY[$this->operatorStack->peek()] < self::PRIORITY[$operator]) {
                break;
            }
            $this->calculateFromStack();
        }
        $this->operatorStack->push($operator);
    }

    private function getItem(): string
    {
        return $this->expression[$this->position];
    }

    private function checkExpression(string $expression): string
    {
        $checkExpression = new CheckExpression($expression);
        $checkExpression->checkOperatorBetweenNumbers();
        $checkExpression->checkBrackets();
        $checkExpression->removeSpaces();
        $checkExpression->replaceCommaToPoint();
        $checkExpression->validOperators();
        $checkExpression->checkInvalidOperator();
        $checkExpression->checkInvalidExpression();
        return $checkExpression->getExpression();
    }
}
