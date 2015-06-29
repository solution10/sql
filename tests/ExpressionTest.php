<?php

namespace Solution10\SQL\Tests;

use PHPUnit_Framework_TestCase;
use Solution10\SQL\Expression;

class ExpressionTest extends PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $e = new Expression('COUNT(*)');
        $this->assertInstanceOf('Solution10\\SQL\\Expression', $e);
    }

    public function testToString()
    {
        $e = new Expression('COUNT(*)');
        $this->assertEquals('COUNT(*)', (string)$e);
    }
}
