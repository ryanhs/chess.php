<?php

require __DIR__ . '/../vendor/autoload.php';

use \Ryanhs\Chess\Chess;

class ConstructorTest extends \PHPUnit_Framework_TestCase
{
	public function testDefaultPosition()
	{
		$a = new Chess;
		$b = new Chess; $b->load(Chess::DEFAULT_POSITION);
		$this->assertEquals($a->ascii(), $b->ascii());
		
		$b->reset();
		$this->assertEquals($a->ascii(), $b->ascii());
	}
	
	public function testAsciiIsEchoString()
	{
		$a = new Chess;
		$b = new Chess;
		$this->assertEquals($a->ascii(), strval($b));
	}
}
