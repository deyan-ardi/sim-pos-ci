<?php

namespace PHPSQLParser\Test\Creator;

use PHPSQLParser\PHPSQLCreator;
use PHPSQLParser\PHPSQLParser;

/**
 * @internal
 */
final class issue342Test extends \PHPUnit\Framework\TestCase
{
    public function testIssue342()
    {
        $sql = 'SELECT if(true,true,false) FROM t';

        $parser  = new PHPSQLParser();
        $creator = new PHPSQLCreator();

        $parser->parse($sql, true);

        $this->assertSame($sql, $creator->create($parser->parsed));
    }
}
