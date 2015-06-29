<?php

namespace Solution10\SQL;

/**
 * Interface ExpressionInterface
 *
 * Interface for expressions so you can create / pass your own. All we need
 * is the __toString() function so the SQL builder can concatenate.
 *
 * @package     Solution10\ORM\SQL
 * @author      Alex Gisby<alex@solution10.com>
 * @license     MIT
 */
interface ExpressionInterface
{
    /**
     * Return the expression ready for concatenation into the query
     *
     * @return  string
     */
    public function __toString();
}
