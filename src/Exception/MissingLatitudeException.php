<?php

namespace PoK\ValueObject\Exception;

use PoK\Exception\ServerError\InternalServerErrorException;

class MissingLatitudeException extends InternalServerErrorException
{
    public function __construct(\Throwable $previous = NULL) {
        parent::__construct('MISSING_COORDINATES_LATITUDE_VALUE', $previous);
    }
}
