# Introduction

Solution10\SQL (or S10\SQL for short) is a library for generating SQL query strings for a variety of
Database backends. It allows you to use a common, expressive syntax, define parameters and values in place
and get out safe queries and parameter arrays ready to execute in PDO.

The main features are:

- No database connection required, entirely standalone
- Return SQL string and params in order for PDO queries
- Support for MySQL and ANSI SQL variations
- Complex queries (nested where, having etc)
- Simple, expressive syntax
- Can return query parts at any point

The documentation will go into each feature in more depth, but for now, here are some examples of how to use
the library alongside PDO.

**Select**

```php
$query = (new Solution10\SQL\Select())
    ->select(['users.name', 'locations.name'])
    ->from('users')
    ->join('locations', 'users.location_id', '=', 'locations.id')
    ->where('users.id', '>', 15)
    ->limit(25)
    ->offset(10)
    ->orderBy('name', 'DESC');

// Make use of an existing PDO object to actually run the query:
$stmt = $pdo->prepare((string)$query);
$stmt->execute($query->params());
$rows = $stmt->fetchAll();
```

**Insert**

```php
$query = (new Solution10\SQL\Insert())
    ->table('users')
    ->values([
        'name' => 'Alex',
        'location_id' => 27
    ]);

// Use with PDO in exactly the same way as SELECT:
$stmt = $pdo->prepare((string)$query);
$stmt->execute($query->params());
```

**Update**

```php
$query = (new Solution10\SQL\Update())
    ->table('users')
    ->where('id', '=', 15)
    ->values([
        'name' => 'Alex',
        'location_id' => 27
    ]);

// Use with PDO in exactly the same way as SELECT:
$stmt = $pdo->prepare((string)$query);
$stmt->execute($query->params());
```

**Delete**

```php
$query = (new Solution10\SQL\Delete())
    ->table('users')
    ->where('id', '=', 27)
    ->limit(1);

// Use with PDO in exactly the same way as SELECT:
$stmt = $pdo->prepare((string)$query);
$stmt->execute($query->params());
```

## Installation

Install via composer as you normally would:

```sh
$ composer require solution10/sql
```

As long as you're using the Composer autoloader (or any other PSR-4 compliant loader), you
will now be able to build queries.
