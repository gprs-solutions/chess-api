<?php

namespace Tests\Feature\Events;

use App\Chess\Game;
use App\Chess\Pieces\King;
use App\Chess\Pieces\Queen;
use App\Events\CheckmateOccurred;
use Illuminate\Support\Facades\Event;
use stdClass;
use Tests\TestCase;

class CheckmateTest extends TestCase
{
    /**
     * Tests that a move leading to checkmate dispatches the CheckmateOccurred event.
     *
     * @return void
     */
    public function testCheckmateOccursAndEventIsDispatched(): void
    {
        Event::fake();

        $game = app()->make(Game::class);
        $game->startGame();
        
        $emptyBoard = array_fill(0, 8, array_fill(0, 8, null));
        
        $game->board->setBoard($emptyBoard);

        // Set up a minimal checkmate scenario.
        // For example, we'll use a simple mate: White queen and king vs. Black king.
        //
        // Place the Black king at h8 (row 0, col 7).
        $blackKing = new King('Black', 0, 7);
        $emptyBoard[0][7] = $blackKing;
        
        // Place the White queen at g7 (row 1, col 6).
        $whiteQueen = new Queen('White', 1, 5);
        $emptyBoard[1][5] = $whiteQueen;
        
        // Place the White king at f6 (row 2, col 5).
        $whiteKing = new King('White', 2, 5);
        $emptyBoard[2][5] = $whiteKing;
        
        $game->board->setBoard($emptyBoard);

        $newPosition = new stdClass();

        $newPosition->row = 1;
        $newPosition->col = 6; // Move queen closer to trap the king.

        $game->movePiece(clone $whiteQueen->position, $newPosition);

        Event::assertDispatched(CheckmateOccurred::class);
    }
}
