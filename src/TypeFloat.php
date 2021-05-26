<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidFloatException;

class TypeFloat
{
    private $value;
    
    public function __construct($value)
    {
        $this->value = $value;
        $this->validateValue();
        $this->value += 0; // casting to float just in case
    }
    
    public function __toString() {
        return (string) $this->value;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    protected function validateValue()
    {
        if (!is_float($this->value+0))
            throw new InvalidFloatException();
    }
}
