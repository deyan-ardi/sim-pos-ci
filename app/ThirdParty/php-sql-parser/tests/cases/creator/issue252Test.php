<?php

namespace PHPSQLParser\Test\Creator;

use PHPSQLParser\PHPSQLCreator;
use PHPSQLParser\PHPSQLParser;

/**
 * https://github.com/greenlion/PHP-SQL-Parser/issues/252
 *
 * @internal
 */
final class issue252Test extends \PHPUnit\Framework\TestCase
{
    protected function _test($sql, $message)
    {
        $parser = new PHPSQLParser();
        $parser->parse($sql);
        $creator = new PHPSQLCreator();
        $created = $creator->create($parser->parsed);
        $this->assertSame($sql, $created, $message);
    }

    public function testIssue252Bool()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS wp_feedback_responses (id bigint NOT NULL AUTO_INCREMENT, response_id varchar (50) NOT NULL, response_public boolean NOT NULL, response_public_bc bool NOT NULL, PRIMARY KEY (id))';
        $this->_test($sql, '');
    }
}
