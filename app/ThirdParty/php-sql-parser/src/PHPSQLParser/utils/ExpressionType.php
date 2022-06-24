<?php
/**
 * ExpressionType.php
 *
 * Defines all values, which are possible for the [expr_type] field
 * within the parser output.
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

namespace PHPSQLParser\utils;

/**
 * This class defines all values, which are possible for the [expr_type] field
 * within the parser output.
 *
 * @license http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 */
class ExpressionType
{
    public const USER_VARIABLE              = 'user_variable';
    public const SESSION_VARIABLE           = 'session_variable';
    public const GLOBAL_VARIABLE            = 'global_variable';
    public const LOCAL_VARIABLE             = 'local_variable';
    public const COLDEF                     = 'column-def';
    public const COLREF                     = 'colref';
    public const RESERVED                   = 'reserved';
    public const CONSTANT                   = 'const';
    public const AGGREGATE_FUNCTION         = 'aggregate_function';
    public const CUSTOM_FUNCTION            = 'custom_function';
    public const SIMPLE_FUNCTION            = 'function';
    public const EXPRESSION                 = 'expression';
    public const BRACKET_EXPRESSION         = 'bracket_expression';
    public const TABLE_EXPRESSION           = 'table_expression';
    public const SUBQUERY                   = 'subquery';
    public const IN_LIST                    = 'in-list';
    public const OPERATOR                   = 'operator';
    public const SIGN                       = 'sign';
    public const RECORD                     = 'record';
    public const MATCH_ARGUMENTS            = 'match-arguments';
    public const MATCH_MODE                 = 'match-mode';
    public const ALIAS                      = 'alias';
    public const POSITION                   = 'pos';
    public const TEMPORARY_TABLE            = 'temporary-table';
    public const TABLE                      = 'table';
    public const VIEW                       = 'view';
    public const DATABASE                   = 'database';
    public const SCHEMA                     = 'schema';
    public const PROCEDURE                  = 'procedure';
    public const ENGINE                     = 'engine';
    public const USER                       = 'user';
    public const DIRECTORY                  = 'directory';
    public const UNION                      = 'union';
    public const CHARSET                    = 'character-set';
    public const COLLATE                    = 'collation';
    public const LIKE                       = 'like';
    public const CONSTRAINT                 = 'constraint';
    public const PRIMARY_KEY                = 'primary-key';
    public const FOREIGN_KEY                = 'foreign-key';
    public const UNIQUE_IDX                 = 'unique-index';
    public const INDEX                      = 'index';
    public const FULLTEXT_IDX               = 'fulltext-index';
    public const SPATIAL_IDX                = 'spatial-index';
    public const INDEX_TYPE                 = 'index-type';
    public const CHECK                      = 'check';
    public const COLUMN_LIST                = 'column-list';
    public const INDEX_COLUMN               = 'index-column';
    public const INDEX_SIZE                 = 'index-size';
    public const INDEX_PARSER               = 'index-parser';
    public const INDEX_ALGORITHM            = 'index-algorithm';
    public const INDEX_LOCK                 = 'index-lock';
    public const REFERENCE                  = 'foreign-ref';
    public const DATA_TYPE                  = 'data-type';
    public const COLUMN_TYPE                = 'column-type';
    public const DEF_VALUE                  = 'default-value';
    public const COMMENT                    = 'comment';
    public const PARTITION                  = 'partition';
    public const PARTITION_LIST             = 'partition-list';
    public const PARTITION_RANGE            = 'partition-range';
    public const PARTITION_HASH             = 'partition-hash';
    public const PARTITION_KEY              = 'partition-key';
    public const PARTITION_COUNT            = 'partition-count';
    public const PARTITION_DEF              = 'partition-def';
    public const PARTITION_VALUES           = 'partition-values';
    public const PARTITION_COMMENT          = 'partition-comment';
    public const PARTITION_INDEX_DIR        = 'partition-index-dir';
    public const PARTITION_DATA_DIR         = 'partition-data-dir';
    public const PARTITION_MAX_ROWS         = 'partition-max-rows';
    public const PARTITION_MIN_ROWS         = 'partition-min-rows';
    public const PARTITION_KEY_ALGORITHM    = 'partition-key-algorithm';
    public const SUBPARTITION               = 'sub-partition';
    public const SUBPARTITION_DEF           = 'sub-partition-def';
    public const SUBPARTITION_HASH          = 'sub-partition-hash';
    public const SUBPARTITION_KEY           = 'sub-partition-key';
    public const SUBPARTITION_COUNT         = 'sub-partition-count';
    public const SUBPARTITION_COMMENT       = 'sub-partition-comment';
    public const SUBPARTITION_INDEX_DIR     = 'sub-partition-index-dir';
    public const SUBPARTITION_DATA_DIR      = 'sub-partition-data-dir';
    public const SUBPARTITION_MAX_ROWS      = 'sub-partition-max-rows';
    public const SUBPARTITION_MIN_ROWS      = 'sub-partition-min-rows';
    public const SUBPARTITION_KEY_ALGORITHM = 'sub-partition-key-algorithm';
    public const QUERY                      = 'query';
    public const SUBQUERY_FACTORING         = 'subquery-factoring';
}
