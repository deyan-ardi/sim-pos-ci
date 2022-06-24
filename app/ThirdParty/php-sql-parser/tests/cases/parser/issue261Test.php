<?php
/**
 * issue261.php
 *
 * Test case for PHPSQLParser.
 */

namespace PHPSQLParser\Test\Parser;

use PHPSQLParser\PHPSQLParser;

/**
 * @internal
 */
final class issue261Test extends \PHPUnit\Framework\TestCase
{
    public function testIssue261()
    {
        /*
         * https://github.com/greenlion/PHP-SQL-Parser/issues/261
         * Hash in VALUE parsed as comment
         */
        $sql      = 'INSERT INTO `wp_posts` (`post_content`, `post_title`, `guid`) VALUES (\'{\n    \"sydney::primary_color\": {\n        \"value\": \"#cde053\",\n        \"type\": \"theme_mod\",\n        \"user_id\": 1\n    }\n}\', \'\', \'\');';
        $parser   = new PHPSQLParser($sql);
        $expected = getExpectedValue(__DIR__, 'issue261.serialized');
        $this->assertSame($expected, $parser->parsed, 'hash in VALUE');
    }
}
