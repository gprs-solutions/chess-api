<?php
namespace App\Contracts;

use App\Chess\Board;

interface PieceActionsContract{
    /**
     * Get the moves for the piece without filtering.
     * 
     * @param Board $board the chess board.
     * 
     * @return array
     */
    public function getMoves(Board $board): array;
}