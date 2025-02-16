<?php

namespace App\Chess\Validators;

use App\Chess\Board;

trait CheckValidator
{
    /**
     * Returns true if the king of the specified color is in check.
     *
     * @param Board $board
     * @param string $color
     * @return bool
     */
    public function isKingInCheck(Board $board, string $color): bool
    {
        // Find the king's position on the board.
        $king = $board->getKingByColor($color);

        if (!$king) {
            return false;
        }

        // Generate all moves for the opponent.
        $opponentColor = ($color === 'White') ? 'Black' : 'White';
        $opponentMoves = $board->getAllMovesForColor($opponentColor);

        // Check if any opponent move attacks the king's square.
        foreach ($opponentMoves as $move) {
            if ($move->row === $king->position->row && $move->col === $king->position->col) {
                return true;
            }
        }
        return false;
    }
}
