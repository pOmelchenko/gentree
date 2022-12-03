<?php

namespace DevOmelchenko\Gentree;

class Gentree
{
    private const NAME = 'Gentree';
    private const VERSION = '0.0.0';

    public static function name(): string
    {
        return self::NAME;
    }

    public static function version(): string
    {
        return self::VERSION;
    }
}
