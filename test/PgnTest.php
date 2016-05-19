<?php

require __DIR__ . '/../vendor/autoload.php';

use \Ryanhs\Chess\Chess;

class PgnTest extends \PHPUnit_Framework_TestCase
{
	public function testClear()
	{		
		// with clear
		$chess = new ChessPublicator();
		$chess->clear();
		$this->assertSame($chess->pgn(), '');
		
		// without clear
		$chess = new ChessPublicator();
		$this->assertSame($chess->pgn(), '');
	}
	
	public function testNormal()
	{		
		$chess = new ChessPublicator();
		$chess->header('White', 'John');
		$chess->header('Black', 'Cena');

		// import some game
		$match = '1. e4 e6 2. d4 d5 3. Nc3 Nf6 4. Bg5 dxe4 5. Nxe4 Be7 6. Bxf6
				gxf6 7. g3 f5 8. Nc3 Bf6';
		$moves = preg_replace("/([0-9]{0,})\./", "", $match);
		$moves = str_replace('  ', ' ', str_replace("\r", ' ', str_replace("\n", ' ', str_replace("\t", '', $moves))));
		$moves = explode(' ', trim($moves));
		foreach($moves as $move) if($chess->move($move) === null) var_dump($move);
		
		$fen = $chess->fen();
		$chess->header('FEN', $fen);
		$pgn = $chess->pgn();
		
		
		// check setup ok
		$this->assertContains('[White "John"]', $pgn);
		$this->assertContains('[Black "Cena"]', $pgn);
		$this->assertContains('[FEN "' . $fen . '"]', $pgn);
		
		// check movements
		$this->assertContains('1. e4 e6', $pgn);
		$this->assertContains('2. d4 d5', $pgn);
		$this->assertContains('3. Nc3 Nf6', $pgn);
		$this->assertContains('4. Bg5 dxe4', $pgn);
		$this->assertContains('5. Nxe4 Be7', $pgn);
		// .
		// .
		// .
		$this->assertContains('8. Nc3 Bf6', $pgn);
	}
	
	public function testBlackFirst()
	{		
		$chess = new ChessPublicator();
		$chess->move('e4');
		$fen = $chess->fen();
		
		$chess->load($fen); // do setup with black first
		$chess->move('e5');
		$chess->move('Nf3');
		$chess->move('Nc6');

		//~ $pgn = $chess->pgn([ 'max_width' => 40, 'new_line' => PHP_EOL ]);
		$pgn = $chess->pgn();
		//~ echo $pgn;exit;
		
		// check setup ok
		$this->assertContains('[SetUp "1"]', $pgn);
		$this->assertContains('[FEN "' . $fen . '"]', $pgn);
		
		// check movements
		$this->assertContains('1. ... e5', $pgn);
		$this->assertContains('2. Nf3 Nc6', $pgn);
	}
}
