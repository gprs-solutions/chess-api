<?php

namespace Tests\Feature;

use App\Chess\Game;
use stdClass;
use Tests\TestCase;

class MovesTest extends TestCase
{
    /**
     * Tests if moves are being correctly inserted to moves array.
     * 
     * @return void
     */
    public function testMovesCreation(): void
    {
        $game = app()->make(Game::class);
        $game->startGame();

        $oldPos = new stdClass();
        $oldPos->row = 7;
        $oldPos->col = 2;

        $newPos = new stdClass();
        $newPos->row = 5;
        $newPos->col = 4;

        //Removing the pawns so the pieces can move.
        $board = $game->board->getBoard();
        $board[1] = array_fill(0,8,null);
        $board[6] = array_fill(0,8,null);
        $game->board->setBoard($board);

        //Moving piece to add it moves array.
        $game->movePiece($oldPos, $newPos);
        $this->assertSame('Bf4', $game->moves[0]);
    }
}
