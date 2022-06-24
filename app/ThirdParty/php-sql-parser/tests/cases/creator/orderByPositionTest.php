<?php

/**
 * Test the support for positions in ORDER BY expressions.
 */

namespace PHPSQLParser\Test\Parser;

/**
 * @internal
 */
final class orderByPositionTest extends \PHPSQLParser\Test\AbstractTestCase
{
    public function testOrderByPosition()
    {
        $query = 'SELECT c1, c2 FROM t ORDER BY 1';

        $parsed   = $this->parser->parse($query);
        $created  = $this->creator->create($parsed);
        $expected = getExpectedValue(__DIR__, 'orderbyposition.sql', false);
        $this->assertSame($expected, $created, 'creating ORDER BY with positions is not supported');
    }
}
