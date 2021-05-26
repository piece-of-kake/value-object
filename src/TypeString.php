<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidStringException;

class TypeString
{
    private $value;
    
    public function __construct($value)
    {
        try {
            $this->value = (string) $value;
        } catch (\Exception $exception) {
            throw new InvalidStringException();
        }
    }
    
    public function __toString() {
        return $this->value;
    }
}
