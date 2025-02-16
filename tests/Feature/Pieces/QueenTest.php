<?php

namespace Tests\Feature\Pieces;

use App\Chess\Game;
use App\Chess\Pieces\Queen;
use stdClass;
use Tests\TestCase;

class QueenTest extends TestCase
{
    /**
     * Tests if a legal move is executed as requested.
     * 
     * @return void
     */
    public function testLegalMove(): void
    {
        $game = new Game();
        $game->startGame();

        $oldPos = new stdClass();
        $oldPos->row = 0;
        $oldPos->col = 3;

        $newPos = new stdClass();
        $newPos->row = 7;
        $newPos->col = 3;

        //Making sure the movePiece method is returning info correctly.
        $movedPiece = $game->movePiece($oldPos, $newPos);
        $this->assertTrue($movedPiece);

        $board = $game->board->getBoard();

        //Making sure piece was moved correctly.
        $this->assertNull($board[$oldPos->row][$oldPos->col]);
        $this->assertInstanceOf(Queen::class, $board[$newPos->row][$newPos->col]);
    }
}
