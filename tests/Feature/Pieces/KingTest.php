<?php

namespace Tests\Feature\Pieces;

use App\Chess\Game;
use App\Chess\Pieces\King;
use stdClass;
use Tests\TestCase;

class KingTest extends TestCase
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
        $game->currentUser = 'Black';

        $oldPos = new stdClass();
        $oldPos->row = 0;
        $oldPos->col = 4;

        $newPos = new stdClass();
        $newPos->row = 1;
        $newPos->col = 5;

        //Removing the pawns so the pieces can move.
        $board = $game->board->getBoard();
        $board[1] = array_fill(0,8,null);
        $board[6] = array_fill(0,8,null);
        $game->board->setBoard($board);

        //Making sure the movePiece method is returning info correctly.
        $movedPiece = $game->movePiece($oldPos, $newPos);
        $board = $game->board->getBoard();
        $this->assertTrue($movedPiece);

        //Making sure piece was moved correctly.
        $this->assertNull($board[$oldPos->row][$oldPos->col]);
        $this->assertInstanceOf(King::class, $board[$newPos->row][$newPos->col]);
    }
}
