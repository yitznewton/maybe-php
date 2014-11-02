<?php

namespace Yitznewton\Maybe\Tests;

use Yitznewton\Maybe\Maybe;

class MaybeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function valueOrWithNull()
    {
        $value = null;
        $default = 'b';
        $maybe = new Maybe($value);

        $this->assertSame($default, $maybe->valueOr($default));
    }
}
