<?php

namespace PoK\ValueObject\Exception;

use PoK\Exception\ServerError\InternalServerErrorException;

class InvalidFileExtensionException extends InternalServerErrorException
{
    public function __construct(\Throwable $previous = NULL) {
        parent::__construct('INVALID_FILE_EXTENSION_VALUE', $previous);
    }
}
