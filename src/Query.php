<?php

namespace Solution10\SQL;

use Solution10\SQL\Dialect\ANSI;

/**
 * Query
 *
 * Base Query class that all other query types should inherit from.
 *
 * @package     Solution10\ORM\SQL
 * @author      Alex Gisby<alex@solution10.com>
 * @license     MIT
 */
abstract class Query
{
    /**
     * @var     DialectInterface
     */
    protected $dialect;

    /**
     * Pass in a dialect, otherwise it'll assume ANSI SQL.
     *
     * @param   DialectInterface|null    $dialect
     */
    public function __construct(DialectInterface $dialect = null)
    {
        $this->dialect = ($dialect === null)? new ANSI() : $dialect;
    }

    /**
     * Generates the full SQL statement for this query with all the composite parts.
     *
     * @return  string
     */
    abstract public function sql();

    /**
     * Serves as a shortcut for sql()
     *
     * @return  string
     */
    public function __toString()
    {
        return $this->sql();
    }

    /**
     * Returns all the parameters, in the correct order, to pass into PDO.
     *
     * @return  array
     */
    abstract public function params();

    /**
     * Resets the entire query.
     *
     * @return  $this
     */
    abstract public function reset();
}
