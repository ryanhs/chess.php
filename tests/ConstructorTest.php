<?php

declare(strict_types=1);

namespace Ryanhs\Chess\Test;

use PHPUnit\Framework\TestCase;
use Ryanhs\Chess\Chess;

class ConstructorTest extends TestCase
{
    public function testDefaultPosition(): void
    {
        $a = new Chess;
        $b = new Chess;
        $b->load(Chess::DEFAULT_POSITION);
        $this->assertEquals($a->ascii(), $b->ascii());
        
        $b->reset();
        $this->assertEquals($a->ascii(), $b->ascii());
    }
    
    public function testAsciiIsEchoString(): void
    {
        $a = new Chess;
        $b = new Chess;
        $this->assertEquals($a->ascii(), strval($b));
    }
}
