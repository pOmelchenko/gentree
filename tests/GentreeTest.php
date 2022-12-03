<?php

namespace DevOmelchenkoTest\Gentree;

use DevOmelchenko\Gentree\Gentree;
use PHPUnit\Framework\TestCase;

class GentreeTest extends TestCase
{
    public function testVersion(): void
    {
        self::assertEquals('v0.0.0', Gentree::version());
    }
}
