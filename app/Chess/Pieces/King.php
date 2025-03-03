<?php
namespace App\Chess\Pieces;

use App\Chess\Piece;
use App\Chess\Board;

class King extends Piece{
    /**
     * Constructor method.
     * 
     * @param string $color Piece color.
     * @param int $row Piece's row.
     * @param int $col Piece's col.
     */
    public function __construct(string $color, int $row, int $col){
        $this->code = 'K';
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
        
        // The king can move one square in any direction.
        for ($dr = -1; $dr <= 1; $dr++) {
            for ($dc = -1; $dc <= 1; $dc++) {
                // Skip the case where there's no movement.
                if ($dr === 0 && $dc === 0) {
                    continue;
                }
                
                $newRow = $row + $dr;
                $newCol = $col + $dc;
                
                // Check if the new position is within board bounds (0 to 7).
                if ($newRow >= 0 && $newRow < 8 && $newCol >= 0 && $newCol < 8) {
                    $move = new \stdClass();
                    $move->row = $newRow;
                    $move->col = $newCol;
                    $moves[] = $move;
                }
            }
        }
        
        return $moves;
    }
}
