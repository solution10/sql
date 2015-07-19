<?php

namespace Solution10\SQL\Tests;

use Solution10\SQL\Dialect\MySQL;

class QueryTest extends \PHPUnit_Framework_TestCase
{
    public function testGettingSettingDialect()
    {
        $query = $this->getMockForAbstractClass('Solution10\\SQL\\Query', []);
        $this->assertInstanceOf('Solution10\\SQL\\Dialect\\ANSI', $query->dialect());

        $dialect = new MySQL();
        $this->assertEquals($query, $query->dialect($dialect));
        $this->assertEquals($dialect, $query->dialect());
    }
}
