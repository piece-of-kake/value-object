<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidImageTypeException;

class TypeImageType
{
    private $value;

    public static function getAvailableValues()
    {
        // https://developer.mozilla.org/en-US/docs/Web/Media/Formats/Image_types
        // one of the IMAGETYPE_XXX constants indicating the type of the image: https://www.php.net/manual/en/image.constants.php
        return [
            IMAGETYPE_GIF,
            IMAGETYPE_JPEG,
            IMAGETYPE_PNG,
            IMAGETYPE_BMP,
            IMAGETYPE_ICO
                //...
        ];
    }

    public function __construct($value)
    {
        $this->value = (int) $value;
        $this->validateValue();
    }

    public function getValue(): int
    {
        return $this->value;
    }

    private function validateValue()
    {
        if (!in_array($this->value, self::getAvailableValues()))
            throw new InvalidImageTypeException();
        return $this;
    }

    public function isGif(): bool
    {
        return $this->value === IMAGETYPE_GIF;
    }

    public function isJpeg(): bool
    {
        return $this->value === IMAGETYPE_JPEG;
    }

    public function isPng(): bool
    {
        return $this->value === IMAGETYPE_PNG;
    }

    public function isBmp(): bool
    {
        return $this->value === IMAGETYPE_BMP;
    }

    public function isIco(): bool
    {
        return $this->value === IMAGETYPE_ICO;
    }
}
