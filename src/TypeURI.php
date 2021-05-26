<?php

namespace PoK\ValueObject;

use PoK\ValueObject\Exception\InvalidURLException;

class TypeURI
{
    // https://en.wikipedia.org/wiki/Uniform_Resource_Identifier#Generic_syntax

    // https://john.doe@www.example.com:123/forum/questions/?tag=networking&order=newest#top
    // scheme://username:password@host:port/path?query#fragment

    /**
     * @var string
     */
    private $scheme;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $port;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $fragment;

    public function __construct($scheme, $host)
    {
        $this->scheme = $scheme;
        $this->host = $host;
    }

    public function getFullURI(): string
    {
        $uri = $this->scheme.'://';

        if ($this->username)
            if ($this->password)
                $uri .= $this->username.':'.$this->password.'@';
            else
                $uri .= $this->username.'@';

        $uri .= $this->host;

        if ($this->port)
            $uri .= ':'.$this->port;

        if ($this->path)
            $uri .= $this->path;

        if ($this->query)
            $uri .= '?'.$this->query;

        if ($this->fragment)
            $uri .= '#'.$this->fragment;

        return $uri;
    }

    /**
     * @param string $username
     * @return TypeURI
     */
    public function setUsername(string $username): TypeURI
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $password
     * @return TypeURI
     */
    public function setPassword(string $password): TypeURI
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $port
     * @return TypeURI
     */
    public function setPort(string $port): TypeURI
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @param string $path
     * @return TypeURI
     */
    public function setPath(string $path): TypeURI
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param string $query
     * @return TypeURI
     */
    public function setQuery(string $query): TypeURI
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param string $fragment
     * @return TypeURI
     */
    public function setFragment(string $fragment): TypeURI
    {
        $this->fragment = $fragment;
        return $this;
    }

    /**
     * @param string $string
     * @return TypeURI
     */
    public static function makeFromString(string $string): TypeURI
    {
        self::validateString($string);
        $parsedUri = parse_url($string);
        $uri = new static(
            array_key_exists('scheme', $parsedUri) ? $parsedUri['scheme'] : 'http',
            $parsedUri['host']
        );
        if (array_key_exists('port', $parsedUri)) $uri->setPort($parsedUri['port']);
        if (array_key_exists('user', $parsedUri)) $uri->setUsername($parsedUri['user']);
        if (array_key_exists('pass', $parsedUri)) $uri->setPassword($parsedUri['pass']);
        if (array_key_exists('path', $parsedUri)) $uri->setPath($parsedUri['path']);
        if (array_key_exists('query', $parsedUri)) $uri->setQuery($parsedUri['query']);
        if (array_key_exists('fragment', $parsedUri)) $uri->setFragment($parsedUri['fragment']);

        return $uri;
    }

    private static function validateString($string)
    {
        if(!filter_var($string, FILTER_VALIDATE_URL))
            throw new InvalidURLException();
    }
}