# Solution10\SQL

Completely standalone, expressive SQL query creator. No database or ORM needed.

[![Build Status](https://travis-ci.org/Solution10/sql.svg?branch=master)](https://travis-ci.org/Solution10/sql)
[![Coverage Status](https://coveralls.io/repos/Solution10/sql/badge.png)](https://coveralls.io/r/Solution10/sql)

[![Latest Stable Version](https://poser.pugx.org/solution10/sql/v/stable.svg)](https://packagist.org/packages/solution10/sql)
[![Total Downloads](https://poser.pugx.org/solution10/sql/downloads.svg)](https://packagist.org/packages/solution10/sql)
[![License](https://poser.pugx.org/solution10/sql/license.svg)](https://packagist.org/packages/solution10/sql)

## Features

- No database connection required, entirely standalone
- Return SQL string and params in order for PDO queries
- Support for MySQL and ANSI SQL variations
- Complex queries (nested where, having etc)
- Simple, expressive syntax
- Can return query parts at any point

## Installation

Installation is via composer, in the usual manner:

```json
{
    "require": {
        "solution10/sql": "~1.0"
    }
}
```

## Documentation

### Simple Examples

For more detailed documentation, please check the /docs folder in the repo, or the Wiki.

#### Select

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

#### Insert

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

#### Update

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

#### Delete

```php
$query = (new Solution10\SQL\Delete())
    ->table('users')
    ->where('id', '=', 27)
    ->limit(1);

// Use with PDO in exactly the same way as SELECT:
$stmt = $pdo->prepare((string)$query);
$stmt->execute($query->params());
```

#### Using other dialects

By default, S10\SQL will assume that you're using an ANSI SQL compatible database. If you're using something
else, MySQL for instance, simply pass into the constructor the Dialect instance:

```php
$query = (new Solution10\SQL\Select(new Solution10\SQL\Dialect\MySQL()))
    ->select('*')
    ->from('users')
    ->limit(10);
```

You can also write your own dialects by implementing `Solution10\SQL\DialectInterface`.

### Userguide

[Check out the Wiki](https://github.com/Solution10/sql/wiki)

(or the /docs folder in the repo)

### API Docs

From a checkout of this project, run:

    $ make

This will create an api/ folder for you to peruse.

## PHP Requirements

- PHP >= 5.4

## Author

Alex Gisby: [GitHub](http://github.com/alexgisby), [Twitter](http://twitter.com/alexgisby)

## License

[MIT](http://github.com/solution10/sql/tree/master/LICENSE.md)

## Contributing

[Contributors Notes](http://github.com/solution10/sql/tree/master/CONTRIBUTING.md)
