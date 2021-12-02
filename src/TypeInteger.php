<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidIntegerException;

class TypeInteger
{
    private $value;
    
    public function __construct($value)
    {
        try {
            $this->value = (int) $value;
        } catch (\Exception $exception) {
            throw new InvalidIntegerException();
        }
        $this->validateValue();
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

    protected function validateValue()
    {
        if (!is_int($this->value))
            throw new InvalidIntegerException();
    }
}
