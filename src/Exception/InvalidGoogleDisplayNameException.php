<?php

namespace PoK\ValueObject\Exception;

use PoK\Exception\ServerError\InternalServerErrorException;

class InvalidGoogleDisplayNameException extends InternalServerErrorException
{
    public function __construct(\Throwable $previous = NULL) {
        parent::__construct('INVALID_URLGOOGLE_DISPLAY_NAME_VALUE', $previous);
    }
}
