<?php

namespace JarirAhmed\AuthTokenMaker\Tests;

use JarirAhmed\AuthTokenMaker\AuthTokenMaker;
use PHPUnit\Framework\TestCase;

class AuthTokenMakerTest extends TestCase
{
    public function testDefaultLengthIs60()
    {
        $this->assertSame(60, strlen(AuthTokenMaker::generate()));
    }

    public function testExactLengthForEvenAndOdd()
    {
        foreach ([1, 2, 15, 16, 61, 100] as $len) {
            $this->assertSame($len, strlen(AuthTokenMaker::generate($len)));
        }
    }

    public function testOutputIsHex()
    {
        $this->assertMatchesRegularExpression('/^[0-9a-f]+$/', AuthTokenMaker::generate(40));
    }

    public function testRejectsNonPositiveLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        AuthTokenMaker::generate(0);
    }

    public function testTokensAreUnique()
    {
        $this->assertNotSame(AuthTokenMaker::generate(), AuthTokenMaker::generate());
    }
}
