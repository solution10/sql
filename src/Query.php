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
     * @var     string      The base part of the query (SELECT, INSERT etc)
     */
    protected $queryBase = null;

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
     * Gets/sets the query base for this query.
     * Note: This will NOT be escaped in any way! Be super careful what you pass.
     *
     * @param   null|string     $base   Null to get, string to set
     * @return  string|$this    String on get, $this on set
     */
    public function queryBaseStatement($base = null)
    {
        if ($base === null) {
            return $this->queryBase;
        }
        $this->queryBase = $base;
        return $this;
    }

    /**
     * Get/set the dialect in use for this query.
     *
     * @param   null|DialectInterface   $dialect    Null to get, DialectInterface to set
     * @return  DialectInterface|$this  DialectInterface on get, $this on set.
     */
    public function dialect(DialectInterface $dialect = null)
    {
        if ($dialect === null) {
            return $this->dialect;
        }
        $this->dialect = $dialect;
        return $this;
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

    /**
     * Returns all the tables that this query makes mention of, in FROMs and JOINs
     *
     * @return  array
     */
    abstract public function allTablesReferenced();
}
