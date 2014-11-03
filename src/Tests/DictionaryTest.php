<?php

namespace Yitznewton\Maybe\Tests;

use Yitznewton\Maybe\Dictionary;

class DictionaryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function oneValue()
    {
        $key = 'foo';
        $value = 'bar';
        $alternative = 'baz';

        $valueObject = new Dictionary([$key => $value]);

        $this->assertEquals($value, $valueObject->$key->valueOr($alternative));
    }

    /**
     * @test
     */
    public function missingValue()
    {
        $key = 'foo';
        $alternative = 'baz';

        $valueObject = new Dictionary([]);

        $this->assertEquals($alternative, $valueObject->$key->valueOr($alternative));
    }

    /**
     * @test
     */
    public function oneValueWithLoose()
    {
        $key = 'foo';
        $value = false;
        $alternative = 'baz';

        $valueObject = new Dictionary([$key => $value], '\\Yitznewton\\Maybe\\LooseMaybe');

        $this->assertEquals($alternative, $valueObject->$key->valueOr($alternative));
    }
}
