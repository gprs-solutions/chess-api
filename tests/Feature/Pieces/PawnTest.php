<?php

namespace Tests\Feature\Pieces;

use App\Chess\Game;
use App\Chess\Pieces\Pawn;
use stdClass;
use Tests\TestCase;

class PawnTest extends TestCase
{
    /**
     * Tests if a legal move is executed as requested.
     * 
     * @return void
     */
    public function testLegalMove(): void
    {
       $game = app()->make(Game::class);
        $game->startGame();

        $oldPos = new stdClass();
        $oldPos->row = 1;
        $oldPos->col = 0;

        $newPos = new stdClass();
        $newPos->row = 3;
        $newPos->col = 0;

        //Making sure the movePiece method is returning info correctly.
        $movedPiece = $game->movePiece($oldPos, $newPos);
        $this->assertTrue($movedPiece);

        $board = $game->board->getBoard();

        //Making sure piece was moved correctly.
        $this->assertNull($board[$oldPos->row][$oldPos->col]);
        $this->assertInstanceOf(Pawn::class, $board[$newPos->row][$newPos->col]);
    }
}
