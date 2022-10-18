<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidIntegerException;

class TypeInteger
{
    private int $value;

    public function __construct($value)
    {
        try {
            $this->value = (int) $value;
        } catch (\Exception $exception) {
            throw new InvalidIntegerException();
        }
        $this->validateValue($value);
    }

    public function __toString() {
        return (string) $this->value;
    }

    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $amount
     * @return $this
     */
    public function increment($amount = 1)
    {
        $this->value += $amount;
        return $this;
    }

    public function decrement($amount = 1)
    {
        $this->value -= $amount;
        return $this;
    }

    protected function validateValue($value)
    {
        if (!is_int($this->value) || !preg_match('/^-?\d+$/',$value))
            throw new InvalidIntegerException();
    }
}
