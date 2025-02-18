<?php

namespace App\Chess\Validators;

use App\Chess\Board;
use App\Chess\Piece;

trait CheckmateValidator
{
    /**
     * Returns true if the king of the given color is checkmated.
     *
     * @param Board $board The current board state.
     * @param string $color The color to check
     * 
     * @return bool
     */
    public function isCheckmate(Board $board, string $color): bool
    {
        if (!$this->isKingInCheck($board, $color)) {
            return false;
        }

        $state = $board->getBoard();

        // Iterate board and try all possibilities.
        for ($row = 0; $row < 8; $row++) {
            for ($col = 0; $col < 8; $col++) {
                $piece = $state[$row][$col] ?? null;
                if ($piece !== null && $piece->color === $color) {
                    $moves = $piece->getMoves($board);
                    foreach ($moves as $move) {
                        $simulatedBoard = clone $board;
                        $simulatedBoard = $this->simulateMove($simulatedBoard, $piece, $move);
                        if (!$this->isKingInCheck($simulatedBoard, $color)) {
                            return false;
                        }
                    }
                }
            }
        }

        //No move left.
        return true;
    }

    /**
     * Simulates a move on the board by moving the piece from its current position
     * to the new position. Assumes that the board can be cloned properly.
     *
     * @param Board  $board The cloned board.
     * @param Piece  $piece The piece to move.
     * @param object $move  An object with numeric properties "row" and "col".
     * 
     * @return Board The board after the move is simulated.
     */
    private function simulateMove(Board $board, Piece $piece, object $move): Board
    {
        $state = $board->getBoard();

        $oldPos = $piece->position;

        $state[$move->row][$move->col] = $piece;
        $state[$oldPos->row][$oldPos->col] = null;

        $piece->position->row = $move->row;
        $piece->position->col = $move->col;

        $board->setBoard($state);

        return $board;
    }
}
