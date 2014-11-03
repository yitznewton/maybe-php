<?php

namespace Yitznewton\Maybe;

class Dictionary
{
    const MAYBE_CLASS = '\\Yitznewton\\Maybe\\Maybe';

    private $rawValue;
    private $maybeClass;

    /**
     * @param array $rawValue The array to be wrapped
     * @param string $maybeClass The type (subclass) of Maybe to use for wrapping
     */
    public function __construct(array $rawValue, $maybeClass = self::MAYBE_CLASS)
    {
        $this->validateMaybeClass($maybeClass);
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

    private function validateMaybeClass($maybeClass)
    {
        if ($maybeClass == self::MAYBE_CLASS) {
            return;
        }

        if (!class_exists($maybeClass)) {
            throw new \UnexpectedValueException('Desired class does not exist');
        }

        $reflection = new \ReflectionClass($maybeClass);
        if (!$reflection->isSubclassOf(self::MAYBE_CLASS)) {
            throw new \UnexpectedValueException('Desired class must be a subclass of Maybe');
        }
    }
}
