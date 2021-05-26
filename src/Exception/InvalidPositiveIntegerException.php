<?php

namespace PoK\ValueObject\Exception;

use PoK\Exception\ServerError\InternalServerErrorException;

class InvalidPositiveIntegerException extends InternalServerErrorException
{
    public function __construct(\Throwable $previous = NULL) {
        parent::__construct('INVALID_POSITIVE_INTEGER_VALUE', $previous);
    }
}
