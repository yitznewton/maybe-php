<?php

namespace Yitznewton\Maybe\Tests;

use Yitznewton\Maybe\Maybe;

class MaybeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function valueOrWithValue()
    {
        $value = 'a';
        $alternative = 'b';
        $maybe = new Maybe($value);

        $this->assertEquals($value, $maybe->valueOr($alternative));
    }

    /**
     * @test
     */
    public function valueOrCallbackWithNull()
    {
        $value = null;
        $alternativeValue = 'b';
        $alternativeCallback = function () use ($alternativeValue) {
            return $alternativeValue;
        };

        $maybe = new Maybe($value);

        $this->assertSame($alternativeValue, $maybe->valueOrCallback($alternativeCallback));
    }
}
