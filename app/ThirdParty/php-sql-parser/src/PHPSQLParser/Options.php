<?php

namespace PHPSQLParser;

final class Options
{
    /**
     * @const string
     */
    public const CONSISTENT_SUB_TREES = 'consistent_sub_trees';

    /**
     * @const string
     */
    public const ANSI_QUOTES = 'ansi_quotes';

    /**
     * @var array
     */
    private $options;

    /**
     * Options constructor.
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * @return bool
     */
    public function getConsistentSubtrees()
    {
        return isset($this->options[self::CONSISTENT_SUB_TREES]) && $this->options[self::CONSISTENT_SUB_TREES];
    }

    /**
     * @return bool
     */
    public function getANSIQuotes()
    {
        return isset($this->options[self::ANSI_QUOTES]) && $this->options[self::ANSI_QUOTES];
    }
}
