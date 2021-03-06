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

        $dictionary = new Dictionary([$key => $value]);

        $this->assertEquals($value, $dictionary->$key->valueOr($alternative));
    }

    /**
     * @test
     */
    public function missingValue()
    {
        $key = 'foo';
        $alternative = 'baz';

        $dictionary = new Dictionary([]);

        $this->assertEquals($alternative, $dictionary->$key->valueOr($alternative));
    }

    /**
     * @test
     */
    public function oneValueWithLoose()
    {
        $key = 'foo';
        $value = false;
        $alternative = 'baz';

        $dictionary = new Dictionary([$key => $value], '\\Yitznewton\\Maybe\\LooseMaybe');

        $this->assertEquals($alternative, $dictionary->$key->valueOr($alternative));
    }

    /**
     * @test
     */
    public function invalidMaybeClass()
    {
        $this->setExpectedException('\\UnexpectedValueException');
        new Dictionary([], '\\Yitznewton\\Maybe\\Dictionary');
    }

    /**
     * @test
     */
    public function nonexistentMaybeClass()
    {
        $this->setExpectedException('\\UnexpectedValueException');
        new Dictionary([], 'nosuchclass');
    }
}
