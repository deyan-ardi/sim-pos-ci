<?php
/**
 * issue57.php
 *
 * Test case for PHPSQLCreator.
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

namespace PHPSQLParser\Test\Creator;

use PHPSQLParser\PHPSQLCreator;
use PHPSQLParser\PHPSQLParser;

/**
 * @internal
 */
final class issue57Test extends \PHPUnit\Framework\TestCase
{
    public function testIssue57()
    {
        $sql = 'SELECT a.*, SUM(b.home) AS home,b.language,l.image,l.sef,l.title_native
        FROM iuz6l_menu_types AS a
        LEFT JOIN iuz6l_menu AS b ON b.menutype = a.menutype AND b.home != 0
        LEFT JOIN iuz6l_languages AS l ON l.lang_code = language
        WHERE (b.client_id = 0 OR b.client_id IS NULL)
        GROUP BY a.id, a.menutype, a.description, a.title, b.menutype,b.language,l.image,l.sef,l.title_native';
        $parser   = new PHPSQLParser($sql);
        $creator  = new PHPSQLCreator($parser->parsed);
        $created  = $creator->created;
        $expected = getExpectedValue(__DIR__, 'issue57.sql', false);
        $this->assertSame($expected, $created, 'constants in ref-clause');
    }
}
