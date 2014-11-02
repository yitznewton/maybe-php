<?php

namespace Yitznewton\Maybe\Tests;

use Yitznewton\Maybe\LooseMaybe;

class LooseMaybeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function valueOrWithLooseFalsy()
    {
        $value = '';
        $alternative = 'b';
        $maybe = new LooseMaybe($value);

        $this->assertSame($alternative, $maybe->valueOr($alternative));
    }
}
