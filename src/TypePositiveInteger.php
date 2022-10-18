<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidPositiveIntegerException;

class TypePositiveInteger extends TypeInteger
{
    protected function validateValue($value)
    {
        parent::validateValue($value);
        if ($this->getValue() < 0)
            throw new InvalidPositiveIntegerException();
    }
}
