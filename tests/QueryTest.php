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

    /* ---------------- Flag Testing ----------------------- */

    public function testNoFlags()
    {
        /* @var     \Solution10\SQL\Query   $query  */
        $query = $this->getMockForAbstractClass('Solution10\\SQL\\Query', []);
        $this->assertEquals([], $query->flags());
        $this->assertEquals(null, $query->flag('unknown'));
    }

    public function testGetSetFlag()
    {
        /* @var     \Solution10\SQL\Query   $query  */
        $query = $this->getMockForAbstractClass('Solution10\\SQL\\Query', []);
        $dummyQuery = $this->getMockForAbstractClass('Solution10\\SQL\\Query', []);

        $this->assertEquals($query, $query->flag('ttl', 30));
        $this->assertEquals($query, $query->flag('model', 'User'));
        $this->assertEquals($query, $query->flag('fields', ['name', 'location']));
        $this->assertEquals($query, $query->flag('subquery', $dummyQuery));

        $this->assertEquals(30, $query->flag('ttl'));
        $this->assertEquals('User', $query->flag('model'));
        $this->assertEquals(['name', 'location'], $query->flag('fields'));
        $this->assertEquals($dummyQuery, $query->flag('subquery'));
    }

    public function testGetSetFlags()
    {
        /* @var     \Solution10\SQL\Query   $query  */
        $query = $this->getMockForAbstractClass('Solution10\\SQL\\Query', []);
        $dummyQuery = $this->getMockForAbstractClass('Solution10\\SQL\\Query', []);

        $flags = [
            'ttl'     => 30,
            'model'     => 'User',
            'fields'    => ['name', 'location'],
            'subquery'  => $dummyQuery,
        ];

        $this->assertEquals($query, $query->flags($flags));
        $this->assertEquals($flags, $query->flags());
    }
    
    public function testDeleteFlag()
    {
        /* @var     \Solution10\SQL\Query $query */
        $query = $this->getMockForAbstractClass('Solution10\\SQL\\Query', []);
        $query->flag('ttl', 30);
        $this->assertEquals(30, $query->flag('ttl'));

        $this->assertEquals($query, $query->deleteFlag('ttl'));
        $this->assertEquals(null, $query->flag('ttl'));
    }

    public function testGetSetQueryBase()
    {
        /* @var     \Solution10\SQL\Query    $q  */
        $q = $this->getMockForAbstractClass('Solution10\\SQL\\Query');
        $this->assertNull($q->queryBaseStatement());

        $this->assertEquals($q, $q->queryBaseStatement('SELECT DISTINCT'));
        $this->assertEquals('SELECT DISTINCT', $q->queryBaseStatement());
    }
}
