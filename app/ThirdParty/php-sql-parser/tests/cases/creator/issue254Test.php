<?php

namespace PHPSQLParser\Test\Creator;

use PHPSQLParser\PHPSQLCreator;
use PHPSQLParser\PHPSQLParser;

/**
 * https://github.com/greenlion/PHP-SQL-Parser/issues/254
 *
 * @internal
 */
final class issue254Test extends \PHPUnit\Framework\TestCase
{
    protected function _test($sql, $message)
    {
        $parser = new PHPSQLParser();
        $parser->parse($sql);
        $creator = new PHPSQLCreator();
        $created = $creator->create($parser->parsed);
        $this->assertSame($sql, $created, $message);
    }

    public function testIssue254UnsingedZerofill()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS wp_feedback_responses (id bigint UNSIGNED NOT NULL AUTO_INCREMENT, test int (4) ZEROFILL, PRIMARY KEY (id))';
        $this->_test($sql, '');
    }
}
