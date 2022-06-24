<?php
/**
 * issue268.php
 *
 * Test case for PHPSQLCreator.
 */

namespace PHPSQLParser\Test\Creator;

use PHPSQLParser\PHPSQLCreator;
use PHPSQLParser\PHPSQLParser;

/**
 * @internal
 */
final class issue268Test extends \PHPUnit\Framework\TestCase
{
    public function testIssue268()
    {
        // https://github.com/greenlion/PHP-SQL-Parser/issues/268
        $sql     = 'UPDATE wp_rg_form_view SET count = count + 1,test = count(*) WHERE id = 239';
        $parser  = new PHPSQLParser($sql);
        $creator = new PHPSQLCreator($parser->parsed);
        $this->assertSame($creator->created, $sql);

        $sql     = 'UPDATE wp_rg_form_view SET count = count + 1 WHERE id = 239';
        $parser  = new PHPSQLParser($sql);
        $creator = new PHPSQLCreator($parser->parsed);
        $this->assertSame($creator->created, $sql);

        $sql     = 'UPDATE wp_rg_form_view SET total = count(test) WHERE id = 239';
        $parser  = new PHPSQLParser($sql);
        $creator = new PHPSQLCreator($parser->parsed);
        $this->assertSame($creator->created, $sql);
    }
}
