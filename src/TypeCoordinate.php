<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidCoordinateException;

class TypeCoordinate
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
        $this->validateValue();
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }

    private function validateValue()
    {
        try {
            if (!is_float($this->value + 0))
                throw new InvalidCoordinateException();
        } catch (\Exception $ex) {
            throw new InvalidCoordinateException();
        }
    }
}
