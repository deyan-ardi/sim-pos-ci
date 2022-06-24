<?php

namespace PHPSQLParser\Test\Parser;

use PHPSQLParser\PHPSQLParser;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class issue233Test extends TestCase
{
    public function testIssue233()
    {
        $sql = "#Check parser doesn't break with single quotes
              CREATE TABLE moomoo (cow VARCHAR(20));";

        $parser = new PHPSQLParser($sql);

        $p        = $parser->parsed;
        $expected = getExpectedValue(__DIR__, 'issue233.serialized');
        $this->assertSame($expected, $p, 'comment with single quote');
    }
}
