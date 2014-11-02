<?php

namespace Yitznewton\Maybe;

class Maybe
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
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
     * @param callable $alternativeCallback
     * @return mixed
     */
    public function valueOrCallback(callable $alternativeCallback)
    {
        if ($this->isNothing()) {
            return $alternativeCallback();
        }

        return $this->value;
    }

    public function select($callback)
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
