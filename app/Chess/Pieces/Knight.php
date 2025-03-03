<?php
namespace App\Chess\Pieces;

use App\Chess\Piece;
use App\Chess\Board;

class Knight extends Piece{
    /**
     * Constructor method.
     * 
     * @param string $color Piece color.
     * @param int $row Piece's row.
     * @param int $col Piece's col.
     */
    public function __construct(string $color, int $row, int $col){
        $this->code = 'N';
        $this->color = $color;
        $this->setPosition($row, $col);
    }

    /**
     * Get the moves for the Knight without filtering.
     *
     * @param Board $board the chess board.
     * @return array An array of move objects (each with row and col properties).
     */
    public function getMoves(Board $board): array
    {
        $moves = [];
        $row = $this->position->row;
        $col = $this->position->col;

        // L shape movement.
        $knightMoves = [
            [2, 1],
            [2, -1],
            [-2, 1],
            [-2, -1],
            [1, 2],
            [1, -2],
            [-1, 2],
            [-1, -2],
        ];

        foreach ($knightMoves as $move) {
            $newRow = $row + $move[0];
            $newCol = $col + $move[1];

            // Check if the new position is within board bounds (0-7 for both row and column)
            if ($newRow >= 0 && $newRow < 8 && $newCol >= 0 && $newCol < 8) {
                $moveObj = new \stdClass();
                $moveObj->row = $newRow;
                $moveObj->col = $newCol;
                $moves[] = $moveObj;
            }
        }

        return $moves;
    }   
}
