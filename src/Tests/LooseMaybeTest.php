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

    /**
     * @test
     */
    public function selectWithLooseFalsy()
    {
        $value = '';
        $alternative = 'b';

        $callback = function ($value) {
            return substr($value, 0, -1);
        };

        $maybe = new LooseMaybe($value);
        $resultMaybe = $maybe->select($callback);

        $this->assertEquals($alternative, $resultMaybe->valueOr($alternative));
    }
}
