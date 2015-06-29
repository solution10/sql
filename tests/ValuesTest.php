<?php

namespace Solution10\SQL\Tests;

use PHPUnit_Framework_TestCase;
use Solution10\SQL\Values;

class ValuesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return Values
     */
    protected function traitObject()
    {
        return $this->getMockForTrait('Solution10\\SQL\\Values');
    }

    public function testDefault()
    {
        $v = $this->traitObject();
        $this->assertEquals([], $v->values());
        $this->assertEquals(null, $v->value('name'));
    }

    public function testSetGetArray()
    {
        $v = $this->traitObject();
        $this->assertEquals($v, $v->values(['name' => 'Alex', 'city' => 'London']));
        $this->assertEquals(['name' => 'Alex', 'city' => 'London'], $v->values());
    }

    public function testSetGetSingleValue()
    {
        $v = $this->traitObject();
        $this->assertEquals($v, $v->value('name', 'Alex'));
        $this->assertEquals('Alex', $v->value('name'));
    }
}
