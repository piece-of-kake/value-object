<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidTimestampException;

class TypeTimestamp
{
    private $value;

    public function __construct($value)
    {
        try {
            $this->value = (int)$value;
        } catch (\Exception $exception) {
            throw new InvalidTimestampException();
        }
        $this->validateValue();
    }

    public function __toString()
    {
        return (string)$this->value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getYearsAgo()
    {
        $date = new \DateTime();
        $date->setTimestamp($this->value);

        $today = new \DateTime();
        $interval = $today->diff($date);
        return (int) $interval->format('%y');
    }

    protected function validateValue()
    {
        if (!is_int($this->value))
            throw new InvalidTimestampException();
    }

    public static function makeNow()
    {
        return new static(time());
    }
}
