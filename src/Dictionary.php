<?php

namespace Yitznewton\Maybe;

class Dictionary
{
    private $rawValue;
    private $maybeClass;

    /**
     * @param array $rawValue The array to be wrapped
     * @param string $maybeClass The type (subclass) of Maybe to use for wrapping
     */
    public function __construct(array $rawValue, $maybeClass = '\\Yitznewton\\Maybe\\Maybe')
    {
        $this->rawValue = $rawValue;
        $this->maybeClass = $maybeClass;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return new $this->maybeClass(\igorw\get_in($this->rawValue, [$name]));
    }
}
