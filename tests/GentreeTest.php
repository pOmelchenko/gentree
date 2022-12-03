<?php

namespace DevOmelchenkoTest\Gentree;

use DevOmelchenko\Gentree\Gentree;
use PHPUnit\Framework\TestCase;

class GentreeTest extends TestCase
{
    public function testName(): void
    {
        self::assertEquals('Gentree', Gentree::name());
    }

    public function testVersion(): void
    {
        self::assertEquals('0.0.0', Gentree::version());
    }
}
