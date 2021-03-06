<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use \Ryanhs\Chess\Chess;

class PgnTest extends \PHPUnit\Framework\TestCase
{
    use ArraySubsetAsserts;

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
        $moves = preg_replace("/([0-9]{0,})\./", '', $match);
        $moves = str_replace('  ', ' ', str_replace("\r", ' ', str_replace("\n", ' ', str_replace("\t", '', $moves))));
        $moves = explode(' ', trim($moves));
        foreach ($moves as $move) {
            if ($chess->move($move) === null) {
                var_dump($move);
            }
        }
        
        $fen = $chess->fen();
        $chess->header('FEN', $fen);
        $pgn = $chess->pgn();
        
        
        // check setup ok
        $this->assertStringContainsString('[White "John"]', $pgn);
        $this->assertStringContainsString('[Black "Cena"]', $pgn);
        $this->assertStringContainsString('[FEN "'.$fen.'"]', $pgn);
        
        // check movements
        $this->assertStringContainsString('1. e4 e6', $pgn);
        $this->assertStringContainsString('2. d4 d5', $pgn);
        $this->assertStringContainsString('3. Nc3 Nf6', $pgn);
        $this->assertStringContainsString('4. Bg5 dxe4', $pgn);
        $this->assertStringContainsString('5. Nxe4 Be7', $pgn);
        // .
        // .
        // .
        $this->assertStringContainsString('8. Nc3 Bf6', $pgn);
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
        $this->assertStringContainsString('[SetUp "1"]', $pgn);
        $this->assertStringContainsString('[FEN "'.$fen.'"]', $pgn);
        
        // check movements
        $this->assertStringContainsString('1. ... e5', $pgn);
        $this->assertStringContainsString('2. Nf3 Nc6', $pgn);
    }
    
    public function testParsePgn()
    {
        $chess = new ChessPublicator();
        
        $parsed = Chess::parsePgn('1.e4 e5 2.Nf3');
        $this->assertContains('e4', $parsed['moves']);
        $this->assertContains('e5', $parsed['moves']);
        $this->assertContains('Nf3', $parsed['moves']);
        
        
        $parsed = Chess::parsePgn(
            <<<EOD
[Event "Earl tourn"]
[Site "?"]
1.e4 e5 2.Nf3
EOD
        );
        $this->assertArraySubset(['Event' => 'Earl tourn'], $parsed['header']);
        $this->assertArraySubset(['Site' => '?'], $parsed['header']);
        $this->assertContains('e4', $parsed['moves']);
        $this->assertContains('e5', $parsed['moves']);
        $this->assertContains('Nf3', $parsed['moves']);
    }
    
    /**
     * @depends testParsePgn
     */
    public function testValidatePgn()
    {
        $chess = new ChessPublicator();
        
        
        $parsed = Chess::validatePgn('1.e4 e5some failed string 2.Nf3');
        $this->assertFalse($parsed);
        
        
        $parsed = $chess->validatePgn(
            <<<EOD
[Event "Earl tourn"]
[Site "?"]
1.e4 e5 2.Nf3 oke failed
EOD
        );
        $this->assertFalse($parsed);
        
        
        $parsed = Chess::validatePgn(
            <<<EOD
[Event "Earl tourn"]
oke failed here
[Site "?"]
1.e4 e5 2.Nf3
EOD
        );
        $this->assertFalse($parsed);
        
        
        $parsed = Chess::validatePgn(
            <<<EOD
[Event "Earl tourn"]
[Site "?"]
1.e4 e5 2.Nf3 1-0
EOD
        );
        $this->assertTrue($parsed);
        
        $parsed = Chess::validatePgn(
            <<<EOD
[Event "Earl tourn"]
[Site "?"]
1.e4 e5 2.Nf3 1/2-1/2
EOD
        );
        $this->assertTrue($parsed);
        
        
        $parsed = Chess::validatePgn('1.e4 e5 2.Nf3', ['verbose' => true]);
        $this->assertContains('e4', $parsed['moves']);
        $this->assertContains('e5', $parsed['moves']);
        $this->assertContains('Nf3', $parsed['moves']);
        $this->assertSame($parsed['game']->fen(), 'rnbqkbnr/pppp1ppp/8/4p3/4P3/5N2/PPPP1PPP/RNBQKB1R b KQkq - 1 2');
                
        
        $parsed = Chess::validatePgn(<<<EOD
[Event "Earl tourn"]
[Site "?"]
1.e4 e5 2.Nf3
EOD
        , ['verbose' => true]);
        $this->assertArraySubset(['Event' => 'Earl tourn'], $parsed['header']);
        $this->assertArraySubset(['Site' => '?'], $parsed['header']);
        $this->assertContains('e4', $parsed['moves']);
        $this->assertContains('e5', $parsed['moves']);
        $this->assertContains('Nf3', $parsed['moves']);
        $this->assertSame($parsed['game']->fen(), 'rnbqkbnr/pppp1ppp/8/4p3/4P3/5N2/PPPP1PPP/RNBQKB1R b KQkq - 1 2');
    }
    
    /**
     * @depends testParsePgn
     * @depends testValidatePgn
     */
    public function testLoadPgn()
    {
        $chess = new ChessPublicator();
        
        $return = $chess->loadPgn('1.e4 e5 2.Nf3');
        $this->assertSame($chess->fen(), 'rnbqkbnr/pppp1ppp/8/4p3/4P3/5N2/PPPP1PPP/RNBQKB1R b KQkq - 1 2');
        
        $return = $chess->loadPgn('1.e4 e5 2.e4');
        $this->assertFalse($return);
        
        $return = $chess->loadPgn('1.e4 e5 make it invalid 2.Nf3');
        $this->assertFalse($return);
    }
}
