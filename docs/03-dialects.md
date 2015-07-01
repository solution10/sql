# Dialects

As anyone who's worked with multiple database backends before knows, not all
of them quack the same language. They all claim to be "SQL" but in fact, some
follow ANSI SQL and others make it up as they go along (*cough* MySQL *cough*).

No matter, S10\SQL can handle those differences, allowing you to write queries
the same way and simply setting a dialect in the Constructor:

```php
// Defaults to ANSI SQL (Postgres mostly)
$q = new Solution10\SQL\Select();

// If using a MySQL backend, provide the MySQL dialect:
$q = new Solution10\SQL\Select(
    new Solution10\SQL\Dialect\MySQL()
);
```

## What changes?

The differences mostly boil down to how names are quoted. Under ANSI SQL, table
and column names are wrapped in "double quotes". MySQL however uses \`backticks\`.

## My DB has a weird dialect, can I write my own?

Sure thing! Simply implement the `Solution10\SQL\DialectInterface` interface. There is also
the `Solution10\SQL\Dialect\Quote` class which can help you with not double quoting strings etc.
