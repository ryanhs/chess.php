<?php

require __DIR__ . '/../vendor/autoload.php';

use \Ryanhs\Chess\Chess;

class GameTest extends \PHPUnit_Framework_TestCase
{
	public function testRandomMove()
	{
		$chess = new Chess;
		
		$i = 0;
		while (!$chess->gameOver()) {
			$i++;
			if ($i > 50) break;
			
			$moves = $chess->moves();
			$moveRandom = $moves[mt_rand(0, count($moves) - 1)];
			
			//~ echo $i % 2 == 1 ? (($i + 1) / 2) . '.' : '';
			//~ echo $moveRandom;
			//~ echo $i % 2 == 1 ? ' ' : ((($i + 1) / 2) % 6 == 0 ? PHP_EOL : ' ');
			
			$move = $chess->move($moveRandom);
			$this->assertNotNull($move);
		}
		
		$this->assertTrue($chess->gameOver() || $i > 50);
	}
}
