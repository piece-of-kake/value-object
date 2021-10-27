<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidFileExtensionException;

class TypeFileExtension
{
    const EXTENSION_NAME_JPG = 'jpg';
    const EXTENSION_NAME_JPEG = 'jpeg';
    const EXTENSION_NAME_PNG = 'png';
    const EXTENSION_NAME_GIF = 'gif';
    const EXTENSION_NAME_BMP = 'bmp';
    const EXTENSION_NAME_ICO = 'ico';
    const EXTENSION_NAME_PDF = 'pdf';

    const EXTENSION_VALUE_JPG = 1;
    const EXTENSION_VALUE_JPEG = 2;
    const EXTENSION_VALUE_PNG = 3;
    const EXTENSION_VALUE_GIF = 4;
    const EXTENSION_VALUE_BMP = 5;
    const EXTENSION_VALUE_ICO = 6;
    const EXTENSION_VALUE_PDF = 7;

    private $value;

    public static function getAvailableValues()
    {
        return [
            self::EXTENSION_VALUE_JPG => self::EXTENSION_NAME_JPG,
            self::EXTENSION_VALUE_JPEG => self::EXTENSION_NAME_JPEG,
            self::EXTENSION_VALUE_PNG => self::EXTENSION_NAME_PNG,
            self::EXTENSION_VALUE_GIF => self::EXTENSION_NAME_GIF,
            self::EXTENSION_VALUE_BMP => self::EXTENSION_NAME_BMP,
            self::EXTENSION_VALUE_ICO => self::EXTENSION_NAME_ICO,
            self::EXTENSION_VALUE_PDF => self::EXTENSION_NAME_PDF
        ];
    }

    public function __construct($value)
    {
        $this->value = (int) $value;
        $this->validateValue();
    }

    public function __toString() {
        return self::getAvailableValues()[$this->value];
    }

    public function getValue()
    {
        return $this->value;
    }

    private function validateValue()
    {
        if (!in_array($this->value, array_flip(self::getAvailableValues()))) throw new InvalidFileExtensionException();
    }

    public static function makeFromString(string $string)
    {
        return new static(array_flip(self::getAvailableValues())[strtolower($string)]);
    }
}