<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidGoogleDisplayNameException;

class TypeGoogleDisplayName
{
    private $value;
    
    public function __construct($value)
    {
        try {
            $this->value = (string) $value;
        } catch (\Exception $exception) {
            throw new InvalidGoogleDisplayNameException();
        }
        $this->validateValue();
    }
    
    public function __toString() {
        return $this->value;
    }
    
    private function validateValue()
    {
        if (preg_match('/[\.\-=_><\'\/;:"]/', $this->value))
            throw new InvalidGoogleDisplayNameException();
    }
}
