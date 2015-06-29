<?php

namespace Solution10\SQL\Dialect;

use Solution10\SQL\DialectInterface;

/**
 * ANSI
 *
 * Dialect for ANSI-SQL, ie what Postgres uses.
 *
 * @package     Solution10\ORM\SQL\Dialect
 * @author      Alex Gisby<alex@solution10.com>
 * @license     MIT
 */
class ANSI implements DialectInterface
{
    use Quote;

    /**
     * Quotes a table name correctly as per this engines dialect.
     *
     * @param   string $table
     * @return  string
     */
    public function quoteTable($table)
    {
        return $this->quoteStructureParts($table, '"');
    }

    /**
     * Correctly quotes a field name, either in "name" or "table.name" format.
     *
     * @param   string $field
     * @return  string
     */
    public function quoteField($field)
    {
        return $this->quoteStructureParts($field, '"', ['*']);
    }
}
