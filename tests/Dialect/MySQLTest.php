<?php

namespace Solution10\ORM\Tests\SQL\Dialect;

use PHPUnit_Framework_TestCase;
use Solution10\SQL\Dialect\MySQL;

class MySQLTest extends PHPUnit_Framework_TestCase
{
    /*
     * ---------------- Table Quoting ----------------------
     */

    public function testTableEmptyString()
    {
        $a = new MySQL();
        $this->assertEquals('', $a->quoteTable(''));
    }

    public function testTableNull()
    {
        $a = new MySQL();
        $this->assertEquals(null, $a->quoteTable(null));
    }

    public function testTableQuotingBasic()
    {
        $a = new MySQL();
        $this->assertEquals('`mytable`', $a->quoteTable('mytable'));
    }

    public function testTableQuoteMultipleComponents()
    {
        $a = new MySQL();
        $this->assertEquals('`mydb`.`mytable`', $a->quoteTable('mydb.mytable'));
    }

    public function testTableQuoteHangingPeriod()
    {
        $a = new MySQL();
        $this->assertEquals('`mybad`', $a->quoteTable('mybad.'));
    }

    /*
     * ------------------ Field Quoting --------------------
     */

    public function testFieldEmptyString()
    {
        $a = new MySQL();
        $this->assertEquals('', $a->quoteField(''));
    }

    public function testFieldNull()
    {
        $a = new MySQL();
        $this->assertEquals(null, $a->quoteField(null));
    }

    public function testFieldQuotingBasic()
    {
        $a = new MySQL();
        $this->assertEquals('`myfield`', $a->quoteField('myfield'));
    }

    public function testFieldQuoteMultipleComponents()
    {
        $a = new MySQL();
        $this->assertEquals('`mytable`.`myfield`', $a->quoteField('mytable.myfield'));
        $this->assertEquals('`mydb`.`mytable`.`myfield`', $a->quoteField('mydb.mytable.myfield'));
    }

    public function testFieldQuoteStar()
    {
        $a = new MySQL();
        $this->assertEquals('`mytable`.*', $a->quoteField('mytable.*'));
    }

    public function testFieldQuoteHangingPeriod()
    {
        $a = new MySQL();
        $this->assertEquals('`mybad`', $a->quoteField('mybad.'));
    }
}
