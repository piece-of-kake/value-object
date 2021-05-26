<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidBooleanException;

class TypeBoolean
{
    private $value;
    
    public function __construct($value)
    {
        try {
            $this->value = (bool) $value;
        } catch (\Exception $exception) {
            throw new InvalidBooleanException();
        }
        $this->validateValue();
    }
    
    public function __toString() {
        return $this->value
            ? 'true'
            : 'false';
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function toInt()
    {
        return $this->value
            ? 1
            : 0;
    }
    
    protected function validateValue()
    {
        if (!is_bool($this->value))
            throw new InvalidBooleanException();
    }
}
