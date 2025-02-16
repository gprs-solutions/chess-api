<?php

namespace Tests\Feature\Pieces;

use App\Chess\Game;
use App\Chess\Pieces\Bishop;
use stdClass;
use Tests\TestCase;

class BishopTest extends TestCase
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
        $oldPos->row = 7;
        $oldPos->col = 2;

        $newPos = new stdClass();
        $newPos->row = 5;
        $newPos->col = 4;

        //Making sure the movePiece method is returning info correctly.
        $movedPiece = $game->movePiece($oldPos, $newPos);
        $this->assertTrue($movedPiece);

        $board = $game->board->getBoard();

        //Making sure piece was moved correctly.
        $this->assertNull($board[$oldPos->row][$oldPos->col]);
        $this->assertInstanceOf(Bishop::class, $board[$newPos->row][$newPos->col]);
    }
}
