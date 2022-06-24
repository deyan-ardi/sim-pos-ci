<?php
/**
 * select.php
 *
 * Test case for PHPSQLParser.
 *
 * PHP version 5
 *
 * LICENSE:
 * Copyright (c) 2010-2014 Justin Swanhart and André Rothe
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. The name of the author may not be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
 * OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
 * NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF
 * THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @copyright 2010-2014 Justin Swanhart and André Rothe
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 *
 * @version   SVN: $Id$
 */

namespace PHPSQLParser\Test\Parser;

use PHPSQLParser\PHPSQLParser;

/**
 * @internal
 */
final class selectTest extends \PHPUnit\Framework\TestCase
{
    public function testSelect()
    {
        $parser = new PHPSQLParser();

        $sql = 'SELECT
        1';
        $p = $parser->parse($sql);

        $this->assertCount(1, $p);
        $this->assertCount(1, $p['SELECT']);

        $this->assertSame('const', $p['SELECT'][0]['expr_type']);
        $this->assertSame('1', $p['SELECT'][0]['base_expr']);
        $this->assertSame('', $p['SELECT'][0]['sub_tree']);

        $sql = 'SELECT 1+2 c1, 1+2 as c2, 1+2,  sum(a) sum_a_alias,a,a an_alias, a as another_alias,terminate
                  from some_table an_alias
        	where d > 5;';
        $parser->parse($sql);
        $p = $parser->parsed;

        $this->assertCount(3, $p);
        $this->assertCount(8, $p['SELECT']);

        $this->assertSame('terminate', $p['SELECT'][count($p['SELECT']) - 1]['base_expr']);

        $this->assertCount(3, $p);
        $this->assertCount(1, $p['FROM']);
        $this->assertCount(3, $p['WHERE']);

        $parser->parse('SELECT NOW( ),now(),sysdate( ),sysdate() as now');
        $this->assertSame('sysdate', $parser->parsed['SELECT'][3]['base_expr']);

        $sql = ' SELECT a.*, surveyls_title, surveyls_description, surveyls_welcometext, surveyls_url  FROM SURVEYS AS a INNER JOIN SURVEYS_LANGUAGESETTINGS on (surveyls_survey_id=a.sid and surveyls_language=a.language)  order by active DESC, surveyls_title';
        $parser->parse($sql);
        $p        = $parser->parsed;
        $expected = getExpectedValue(__DIR__, 'select1.serialized');
        $this->assertSame($expected, $p, 'a test for ref_clauses');

        $sql = "SELECT pl_namespace,pl_title FROM `pagelinks` WHERE pl_from = '1' FOR UPDATE";
        $parser->parse($sql);
        $p        = $parser->parsed;
        $expected = getExpectedValue(__DIR__, 'select2.serialized');
        $this->assertSame($expected, $p, 'select for update');
    }
}
