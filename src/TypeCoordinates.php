<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidCoordinatesException;
use PoK\ValueObject\Exception\MissingLongitudeException;
use PoK\ValueObject\Exception\MissingLatitudeException;
use PoK\ValueObject\Exception\InvalidCoordinateException;

class TypeCoordinates
{
    private $value;
    
    public function __construct($value)
    {
        $this->value = $value;
        $this->validateValue();
    }
    
    public function __toString() {
        return $this->value;
    }
    
    public function getLatitude()
    {
        return $this->value['latitude'];
    }
    
    public function getLongitude()
    {
        return $this->value['longitude'];
    }
    
    private function validateValue()
    {
        if (!is_array($this->value))
            throw new InvalidCoordinatesException();
        
        if (!array_key_exists('latitude', $this->value))
            throw new MissingLatitudeException();
        
        if (!array_key_exists('longitude', $this->value))
            throw new MissingLongitudeException();
        
        $this->validateCoordinate($this->value['latitude']);
        $this->validateCoordinate($this->value['longitude']);
        $this->value['latitude'] = $this->value['latitude']+0;
        $this->value['longitude'] = $this->value['longitude']+0;
    }
    
    private function validateCoordinate($coordinate)
    {
        try {
            if (!is_float($coordinate+0))
                throw new InvalidCoordinateException();
        } catch (\Exception $ex) {
            throw new InvalidCoordinateException();
        }
    }
}
