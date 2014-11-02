<?php

namespace Yitznewton\Maybe;

class Maybe
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed $value The value to wrap in a Maybe
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Return the main value, or an alternative if null
     *
     * @param mixed $alternative
     * @return mixed
     */
    public function valueOr($alternative)
    {
        if ($this->isNothing()) {
            return $alternative;
        }

        return $this->value;
    }

    /**
     * Return the main value, or run & return a callback if null
     *
     * @param callable $alternativeCallback A callback to run and return if the main value is null
     * @return mixed
     */
    public function valueOrCallback(callable $alternativeCallback)
    {
        if ($this->isNothing()) {
            return $alternativeCallback();
        }

        return $this->value;
    }

    /**
     * Apply a callback to the main value, and return the result wrapped in a new Maybe
     *
     * @param callable $callback
     * @return self
     */
    public function select(callable $callback)
    {
        if ($this->isNothing()) {
            return $this;
        }

        return new self($callback($this->value));
    }

    /**
     * @return bool
     */
    protected function isNothing()
    {
        return is_null($this->value);
    }
}
