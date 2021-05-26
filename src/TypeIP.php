<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidIPException;

class TypeIP
{
    private $value;
    
    public function __construct($value)
    {
        try {
            $this->value = (string) $value;
        } catch (\Exception $exception) {
            throw new InvalidIPException();
        }
        $this->validateValue();
    }
    
    public function __toString() {
        return (string) $this->value;
    }
    
    private function validateValue()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_IP))
            throw new InvalidIPException();
    }   
}
