<?php

namespace Solution10\SQL\Tests;

use PHPUnit_Framework_TestCase;
use Solution10\SQL\Update;

class UpdateTest extends PHPUnit_Framework_TestCase
{
    public function testTable()
    {
        $q = new Update();
        $this->assertNull($q->table());
        $this->assertEquals($q, $q->table('users'));
        $this->assertEquals('users', $q->table());
    }

    public function testValues()
    {
        $q = new Update();
        $this->assertEquals([], $q->values());
        $this->assertEquals($q, $q->values([
            'name' => 'Alex',
            'city' => 'London'
        ]));
        $this->assertEquals([
            'name' => 'Alex',
            'city' => 'London'
        ], $q->values());
    }

    public function testValue()
    {
        $q = new Update();
        $this->assertEquals(null, $q->value('name'));
        $this->assertEquals($q, $q->value('name', 'Alex'));
        $this->assertEquals('Alex', $q->value('name'));
    }

    public function testBasicUpdateSQL()
    {
        $q = new Update();
        $q
            ->table('users')
            ->values(['name' => 'Alex', 'city' => 'London'])
            ->where('id', '=', 1)
            ->limit(1)
        ;

        $this->assertEquals('UPDATE "users" SET "name" = ?, "city" = ? WHERE "id" = ? LIMIT 1', (string)$q);
        $this->assertEquals(['Alex', 'London', 1], $q->params());
    }

    public function testResetUpdate()
    {
        $q = new Update();
        $q
            ->table('users')
            ->values(['name' => 'Alex', 'city' => 'London'])
            ->where('id', '=', 1)
            ->limit(1)
        ;

        $this->assertEquals($q, $q->reset());
        $this->assertEquals('', (string)$q);
        $this->assertEquals(null, $q->table());
        $this->assertEquals([], $q->values());
        $this->assertEquals([], $q->getWhereParams());
    }

    public function testAllTablesReferenced()
    {
        $q = new Update();
        $this->assertEquals([], $q->allTablesReferenced());

        $q = new Update();
        $q->table('users');
        $this->assertEquals(['users'], $q->allTablesReferenced());

        $q = new Update();
        $q->table('users');
        $q->table('locations');
        $this->assertEquals(['locations'], $q->allTablesReferenced());
    }
}
