<?php

require __DIR__ . '/../vendor/autoload.php';

use \Ryanhs\Chess\Chess;

class PiecePlacementTest extends \PHPUnit_Framework_TestCase
{
	public function testAll()
	{
		$chess = new Chess('8/8/8/8/8/8/8/8 w KQkq - 0 1');
		
		$this->assertSame($chess->get('a1'), NULL);
		$this->assertSame($chess->get('a2'), NULL);
		$this->assertSame($chess->get('e4'), NULL);
		$this->assertSame($chess->get('g8'), NULL);
		
		$piece = ['type' => Chess::QUEEN, 'color' => Chess::WHITE];
		$chess->put($piece, 'e4');
		$this->assertSame($chess->get('e4'), $piece);
		
		$piece = ['type' => Chess::KING, 'color' => Chess::BLACK];
		$chess->put($piece, 'd3');
		$this->assertSame($chess->get('d3'), $piece);
	}
}
