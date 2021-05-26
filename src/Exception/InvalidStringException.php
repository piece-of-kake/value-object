<?php

namespace PoK\ValueObject\Exception;

use PoK\Exception\ServerError\InternalServerErrorException;

class InvalidStringException extends InternalServerErrorException
{
    public function __construct(\Throwable $previous = NULL) {
        parent::__construct('INVALID_STRING_VALUE', $previous);
    }
}
