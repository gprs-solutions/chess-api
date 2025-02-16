<?php
namespace App\Chess\Pieces;

use App\Chess\Piece;
use App\Chess\Board;

class Bishop extends Piece{
    /**
     * Constructor method.
     * 
     * @param string $color Piece color.
     * @param int $row Piece's row.
     * @param int $col Piece's col.
     */
    public function __construct(string $color, int $row, int $col){
        $this->code = 'B';
        $this->color = $color;
        $this->setPosition($row, $col);
    }

    /**
     * Prints piece name when class is printed.
     */
    public function __toString(){
        return str_split($this->color)[0] . $this->code;
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
    
        // Diagonal directions: [rowDelta, colDelta]
        $directions = [
            [1, 1],   // Down-Right
            [1, -1],  // Down-Left
            [-1, 1],  // Up-Right
            [-1, -1]  // Up-Left
        ];
    
        // For each direction, move from the current position until out of board bounds
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
                
                // Continue moving in this diagonal direction
                $r += $dRow;
                $c += $dCol;
            }
        }
    
        return $moves;
    }    
}
