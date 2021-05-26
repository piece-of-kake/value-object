<?php

namespace PoK\ValueObject\Exception;

use PoK\Exception\ServerError\InternalServerErrorException;

class InvalidCoordinatesException extends InternalServerErrorException
{
    public function __construct(\Throwable $previous = NULL) {
        parent::__construct('INVALID_COORDINATES_ARRAY_VALUE', $previous);
    }
}
