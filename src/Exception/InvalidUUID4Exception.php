<?php

namespace PoK\ValueObject\Exception;

use PoK\Exception\ServerError\InternalServerErrorException;

class InvalidUUID4Exception extends InternalServerErrorException
{
    public function __construct(\Throwable $previous = NULL) {
        parent::__construct('INVALID_UUID4_VALUE', $previous);
    }
}
