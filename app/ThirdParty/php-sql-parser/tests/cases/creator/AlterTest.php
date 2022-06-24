<?php

namespace PHPSQLParser\Test\Creator;

use PHPSQLParser\PHPSQLCreator;
use PHPSQLParser\PHPSQLParser;

/**
 * @internal
 */
final class AlterTest extends \PHPUnit\Framework\TestCase
{
    public function testAlterChangeColumn()
    {
        $sql      = "ALTER TABLE `user` CHANGE `id` `id` INT( 11 ) COMMENT 'id of user';";
        $parser   = new PHPSQLParser($sql);
        $creator  = new PHPSQLCreator($parser->parsed);
        $created  = $creator->created;
        $expected = getExpectedValue(__DIR__, 'alter.sql', false);
        $this->assertSame($expected, $created, 'an alter table statement to change a column');
    }

    public function testAlterAddColumn()
    {
        $sql = 'ALTER TABLE `my_table`
                 ADD COLUMN `updated_by` SMALLINT unsigned AFTER `date_created`';
        $parser   = new PHPSQLParser($sql);
        $creator  = new PHPSQLCreator($parser->parsed);
        $created  = $creator->created;
        $expected = getExpectedValue(__DIR__, 'alter2.sql', false);
        $this->assertSame($expected, $created, 'an alter table statement to add a column');
    }
}
