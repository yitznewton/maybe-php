<?php

namespace Yitznewton\Maybe;

class LooseMaybe extends Maybe
{
    /**
     * @return bool
     */
    protected function isNothing()
    {
        return !$this->value;
    }
}
