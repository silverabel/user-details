<?php declare(strict_types=1);
namespace silverabel;

use PHPUnit\Framework\TestCase;

use Brain\Monkey;

class MonkeyTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
    }

    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }
}
