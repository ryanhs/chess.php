<?php

require __DIR__ . '/../vendor/autoload.php';

use \Ryanhs\Chess\Chess;

// a proxy for testing protected method
class ChessPublicator extends Chess
{
	public function getBoard()
	{
		return $this->board;
	}
	
	public function getHistory()
	{
		return $this->history;
	}
	
	public function getLastHistory()
	{
		return $this->history[count($this->history) - 1];
	}
	
	public function attackedPublic($color, $square)
	{
		return $this->attacked($color, $square);
	}
	
	public function generateMovesPublic($options = [])
	{
		return $this->generateMoves($options);
	}
	
	static public function buildMovePublic($turn, $board, $from, $to, $flags, $promotion = null)
	{
		return self::buildMove($turn, $board, $from, $to, $flags, $promotion);
	}
	
	public function makeMovePublic($move)
	{
		return $this->makeMove($move);
	}
	
	public function undoMovePublic()
	{
		return $this->undoMove();
	}
	
	public function moveToSANPublic($move)
	{
		return $this->moveToSAN($move);
	}
	
	public function moveFromSANPublic($san)
	{
		return $this->moveFromSAN($san);
	}
}
