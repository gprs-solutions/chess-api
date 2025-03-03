<?php
namespace App\Chess\Pieces;

use App\Chess\Piece;
use App\Chess\Board;

class Rook extends Piece{
    /**
     * Constructor method.
     * 
     * @param string $color Piece color.
     * @param int $row Piece's row.
     * @param int $col Piece's col.
     */
    public function __construct(string $color, int $row, int $col){
        $this->code = 'R';
        $this->color = $color;
        $this->setPosition($row, $col);
    }

    /**
     * Get the moves for the piece without filtering.
     * 
     * @param Board $board the chess board.
     * 
     * @return array
     */
    public function getMoves(Board $board): array
    {
        $moves = [];
        $row = $this->position->row;
        $col = $this->position->col;

        // Define the four straight directions: right, left, down, up.
        $directions = [
            [0, 1],   // Right
            [0, -1],  // Left
            [1, 0],   // Down
            [-1, 0]   // Up
        ];

        // For each direction, step through the board until out of bounds.
        foreach ($directions as $direction) {
            $dRow = $direction[0];
            $dCol = $direction[1];
            $r = $row + $dRow;
            $c = $col + $dCol;
            
            while ($r >= 0 && $r < 8 && $c >= 0 && $c < 8) {
                $move = new \stdClass();
                $move->row = $r;
                $move->col = $c;
                $moves[] = $move;

                // Move one step further in the same direction.
                $r += $dRow;
                $c += $dCol;
            }
        }

        return $moves;
    }    
}
