# Expressions

And finally, sometimes you need to use something that you don't want to be quoted
or escaped; a Database Expression. S10\SQL supports these like so:

```php
$q->orderBy(new Solution10\SQL\Expression('RAND()'), 'ASC');
```

**THIS IS AN AWESOME WAY OF CREATING SQL INJECTIONS!!!**

Use Expressions with extreme care, they __will not__ be escaped or sanitised by either
S10\SQL or PDO.
