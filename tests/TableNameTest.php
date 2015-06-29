<?php

namespace Solution10\SQL\Tests;

use PHPUnit_Framework_TestCase;
use Solution10\SQL\TableName;

class TableNameTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return TableName
     */
    protected function traitObject()
    {
        return $this->getMockForTrait('Solution10\\SQL\\TableName');
    }

    public function testSetGet()
    {
        $t = $this->traitObject();
        $this->assertNull($t->table());
        $this->assertEquals($t, $t->table('users'));
        $this->assertEquals('users', $t->table());
    }
}
