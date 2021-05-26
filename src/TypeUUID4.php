<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidUUID4Exception;

class TypeUUID4
{
    const VALID_PATTERN = '^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$';

    private $value;

    public function __construct($value)
    {
        try {
            $this->value = (string) $value;
        } catch (\Exception $exception) {
            throw new InvalidUUID4Exception();
        }
        $this->validateValue();
    }

    public function __toString()
    {
        return $this->value;
    }

    private function validateValue()
    {
        if (!preg_match('/' . self::VALID_PATTERN . '/', $this->value))
            throw new InvalidUUID4Exception();
    }

    public static function generate(): TypeUUID4
    {
        // https://stackoverflow.com/questions/2040240/php-function-to-generate-v4-uuid
        $data = random_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return new static(vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4)));
    }

}
