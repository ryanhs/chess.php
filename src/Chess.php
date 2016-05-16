<?php

namespace Ryanhs\Chess;

class Chess
{	
	const BLACK = 'b';
	const WHITE = 'w';
	
	// here we use NULL, instead of self::EMPTY
	//~ const EMPTY = -1;
	
	const PAWN = 'p';
	const KNIGHT = 'n';
	const BISHOP = 'b';
	const ROOK = 'r';
	const QUEEN = 'q';
	const KING = 'k';
	
	const SYMBOLS = 'pnbrqkPNBRQK';
	
	const DEFAULT_POSITION = 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1';
	
	const POSSIBLE_RESULTS = ['1-0', '0-1', '1/2-1/2', '*'];
	
	const SHIFTS = [ 
		'p' 			=> 0, 
		'n' 			=> 1, 
		'b' 			=> 2, 
		'r' 			=> 3, 
		'q' 			=> 4, 
		'k' 			=> 5 
	];

	const FLAGS = [
		'NORMAL' 		=> 'n',
		'CAPTURE' 		=> 'c',
		'BIG_PAWN' 		=> 'b',
		'EP_CAPTURE' 	=> 'e',
		'PROMOTION' 	=> 'p',
		'KSIDE_CASTLE' 	=> 'k',
		'QSIDE_CASTLE' 	=> 'q'
	];

	const BITS = [
		'NORMAL' 		=> 1,
		'CAPTURE' 		=> 2,
		'BIG_PAWN' 		=> 4,
		'EP_CAPTURE' 	=> 8,
		'PROMOTION' 	=> 16,
		'KSIDE_CASTLE' 	=> 32,
		'QSIDE_CASTLE' 	=> 64
	];

	const SQUARES = [
		'a8' =>   0, 'b8' =>   1, 'c8' =>   2, 'd8' =>   3, 'e8' =>   4, 'f8' =>   5, 'g8' =>   6, 'h8' =>   7,
		'a7' =>  16, 'b7' =>  17, 'c7' =>  18, 'd7' =>  19, 'e7' =>  20, 'f7' =>  21, 'g7' =>  22, 'h7' =>  23,
		'a6' =>  32, 'b6' =>  33, 'c6' =>  34, 'd6' =>  35, 'e6' =>  36, 'f6' =>  37, 'g6' =>  38, 'h6' =>  39,
		'a5' =>  48, 'b5' =>  49, 'c5' =>  50, 'd5' =>  51, 'e5' =>  52, 'f5' =>  53, 'g5' =>  54, 'h5' =>  55,
		'a4' =>  64, 'b4' =>  65, 'c4' =>  66, 'd4' =>  67, 'e4' =>  68, 'f4' =>  69, 'g4' =>  70, 'h4' =>  71,
		'a3' =>  80, 'b3' =>  81, 'c3' =>  82, 'd3' =>  83, 'e3' =>  84, 'f3' =>  85, 'g3' =>  86, 'h3' =>  87,
		'a2' =>  96, 'b2' =>  97, 'c2' =>  98, 'd2' =>  99, 'e2' => 100, 'f2' => 101, 'g2' => 102, 'h2' => 103,
		'a1' => 112, 'b1' => 113, 'c1' => 114, 'd1' => 115, 'e1' => 116, 'f1' => 117, 'g1' => 118, 'h1' => 119
	];

	const ROOKS = [
		'w' => [['square' => self::SQUARES['a1'], 'flag' => self::BITS['QSIDE_CASTLE']],
				['square' => self::SQUARES['h1'], 'flag' => self::BITS['KSIDE_CASTLE']]],
		'b' => [['square' => self::SQUARES['a8'], 'flag' => self::BITS['QSIDE_CASTLE']],
				['square' => self::SQUARES['h8'], 'flag' => self::BITS['KSIDE_CASTLE']]]
	];
	
	
	protected $board;
	protected $kings;
	protected $turn;
	protected $castling;
	protected $epSquare;
	protected $halfMoves;
	protected $moveNumber;
	protected $history;
	protected $heade;
	
	public function __construct($fen = null)
	{
		$this->init();
		
		if (strlen(strval($fen)) > 0) $this->load(strval($fen));
		else $this->reset();
	}
	
	protected function init()
	{
		$this->board		= [];
		$this->kings		= ['w' => null, 'b' => null];
		$this->turn 		= self::WHITE;
		$this->castling		= ['w' => 0, 	'b' => 0];
		$this->epSquare		= null;
		$this->halfMoves	= 0;
		$this->moveNumber	= 1;
		$this->history		= [];
		$this->header		= [];
		
		for($i = 0; $i < 120; $i++) $this->board[$i] = null;
	}
	
	public function load($fen)
	{
		if (!self::validateFen($fen)['valid']) return false;
		$tokens = explode(' ', $fen);
		$this->init();
		
		// position
		$position = $tokens[0];
		$square = 0;
		for ($i = 0; $i < strlen($position); $i++) {
			$piece = $position{$i};
			if($piece === '/') {
				$square += 8;
			}
			else if (ctype_digit($piece)) {
				$square += intval($piece, 10);
			}
			else {
				$color = (ord($piece) < ord('a')) ? self::WHITE : self::BLACK;
				$this->put([
					'type' => strtolower($piece),
					'color' => $color,
				],
					self::algebraic($square)
				);
				$square++;
			}
		}
		
		// turn
		$turn = $tokens[1];
		
		// castling options
		if (strpos($tokens[2], 'K') !== false) $this->castling['w'] |= self::BITS['KSIDE_CASTLE'];
		if (strpos($tokens[2], 'Q') !== false) $this->castling['w'] |= self::BITS['QSIDE_CASTLE'];
		if (strpos($tokens[2], 'k') !== false) $this->castling['b'] |= self::BITS['KSIDE_CASTLE'];
		if (strpos($tokens[2], 'q') !== false) $this->castling['b'] |= self::BITS['QSIDE_CASTLE'];
		
		// ep square
		$this->epSquare = ($tokens[3] === '-') ? null : self::SQUARES[$tokens[3]];
		
		// half moves
		$this->halfMoves = intval($tokens[4], 10);
		
		// move number
		$this->moveNumber = intval($tokens[5], 10);
		
		//~ $this->updateSetup($this->generateFen());
		return true;
	}
	
	public function reset()
	{
		return $this->load(self::DEFAULT_POSITION);
	}
	
	
	
	static public function validateFen($fen)
	{
		$errors = [
			0	=> 'No errors.',
			1	=> 'FEN string must contain six space-delimited fields.',
			2	=> '6th field (move number) must be a positive integer.',
			3	=> '5th field (half move counter) must be a non-negative integer.',
			4	=> '4th field (en-passant square) is invalid.',
			5	=> '3rd field (castling availability) is invalid.',
			6	=> '2nd field (side to move) is invalid.',
			7	=> '1st field (piece positions) does not contain 8 \'/\'-delimited rows.',
			8	=> '1st field (piece positions) is invalid [consecutive numbers].',
			9	=> '1st field (piece positions) is invalid [invalid piece].',
			10	=> '1st field (piece positions) is invalid [row too large].',
			11	=> 'Illegal en-passant square',
		];
		
		$tokens = explode(' ', $fen);
		
		// 1st criterion: 6 space-separated fields
		if (count($tokens) !== 6) return ['valid' => false, 'error_number' => 1, 'error' => $errors[1]];
		
		// 2nd criterion: move number field is a integer value > 0
		if (!ctype_digit($tokens[5]) || intval($tokens[5], 10) <= 0) return ['valid' => false, 'error_number' => 2, 'error' => $errors[2]];
		
		// 3rd criterion: half move counter is an integer >= 0
		if (!ctype_digit($tokens[4]) || intval($tokens[4], 10) < 0) return ['valid' => false, 'error_number' => 3, 'error' => $errors[3]];
		
		// 4th criterion: 4th field is a valid e.p.-string
		if (!(preg_match('/^(-|[a-h]{1}[3|6]{1})$/', $tokens[3]) === 1)) return ['valid' => false, 'error_number' => 4, 'error' => $errors[4]];
		
		// 5th criterion: 3th field is a valid castle-string
		if (!(preg_match('/(^-$)|(^[K|Q|k|q]{1,}$)/', $tokens[2]) === 1)) return ['valid' => false, 'error_number' => 5, 'error' => $errors[5]];
		
		// 6th criterion: 2nd field is "w" (white) or "b" (black)
		if (!(preg_match('/^(w|b)$/', $tokens[1]) === 1)) return ['valid' => false, 'error_number' => 6, 'error' => $errors[6]];
		
		// 7th criterion: 1st field contains 8 rows
		$rows = explode('/', $tokens[0]);
		if (count($rows) !== 8) return ['valid' => false, 'error_number' => 7, 'error' => $errors[7]];
		
		// 8-10th check
		for ($i = 0; $i < count($rows); $i++) {
			$sumFields = 0;
			$previousWasNumber = false;
			for ($k = 0; $k < strlen($rows[$i]); $k++) {
				if (ctype_digit($rows[$i]{$k})) {
					// 8th criterion: every row is valid
					if ($previousWasNumber) return ['valid' => false, 'error_number' => 8, 'error' => $errors[8]];
					$sumFields += intval($rows[$i]{$k}, 10);
					$previousWasNumber = true;
				} else {
					// 9th criterion: check symbols of piece
					if (strpos(self::SYMBOLS, $rows[$i]{$k}) === false) return ['valid' => false, 'error_number' => 9, 'error' => $errors[9]];
					$sumFields++;
					$previousWasNumber = false;
				}
			}
			// 10th criterion: check sum piece + empty square must be 8
			if($sumFields !== 8) return ['valid' => false, 'error_number' => 10, 'error' => $errors[10]];
		}
		
		
		// 11th criterion: en-passant if last is black's move, then its must be white turn
		if (strlen($tokens[3]) > 1) {
			if (($tokens[3]{1} == '3' && $tokens[1] == 'w') ||
				($tokens[3]{1} == '6' && $tokens[1] == 'b')) {
				return ['valid' => false, 'error_number' => 11, 'error' => $errors[11]];
			}
		}
		
		return ['valid' => true, 'error_number' => 0, 'error' => 'No errors.'];
	}
	
	public function put($piece, $square)
	{
		// check for valid piece object
		if (!(isset($piece['type']) && isset($piece['color']))) return false;
		
		// check for piece
		if (strpos(self::SYMBOLS, strtolower($piece['type'])) === false) return false;
		
		// check for valid square
		if (!array_key_exists($square, self::SQUARES)) return false;
		
		$sq = self::SQUARES[$square];
		
		// don't let the use place more than one king
		if ($piece['type'] == self::KING &&  !($this->kings[$piece['color']] == null || $this->kings[$piece['color']] == $sq)) return false;
		
		$this->board[$sq] = ['type' => $piece['type'], 'color' => $piece['color']];
		if ($piece['type'] == self::KING) {
			$this->kings[$piece['color']] = $sq;
		}
		
		//~ $this->updateSetup($this->generateFen());
		return true;
	}
	
	
	
	
	
	
	
	
	static protected function rank($i)
	{
		return $i >> 4;
	}
	
	static protected function file($i)
	{
		return $i & 15;
	}
	
	static protected function algebraic($i)
	{
		$f = self::file($i);
		$r = self::rank($i);
		return substr('abcdefgh', $f, 1) . substr('87654321', $r, 1);
	}
	
	
	
	
	
	
	
	public function moves()
	{
		return [];
	}
	
	public function move($move)
	{
		
	}
	
	
	
	
	public function gameOver()
	{
		return mt_rand(0, 1) == 1;
	}
	
	
	
	public function __toString()
	{
		return $this->ascii();
	}
	
	public function ascii()
	{
		$s = '   +------------------------+' . PHP_EOL;
		for ($i = self::SQUARES['a8']; $i <= self::SQUARES['h1']; $i++) {
			// display the rank
			if (self::file($i) === 0) $s .= ' ' . substr('87654321', self::rank($i), 1) . ' |';
			
			if ($this->board[$i] == null) {
				$s .= ' . ';
			} else {
				$piece = $this->board[$i]['type'];
				$color = $this->board[$i]['color'];
				$symbol = ($color === self::WHITE) ? strtoupper($piece) : strtolower($piece);
				
				$s .= ' ' . $symbol . ' ';
			}
			
			if (($i + 1) & 0x88) {
				$s .= '|' . PHP_EOL;
				$i += 8;
			}
		}
		$s .= '   +------------------------+' . PHP_EOL;
		$s .= '     a  b  c  d  e  f  g  h' . PHP_EOL;
		return $s;
	}
}
