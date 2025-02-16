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
    public function getMoves(Board $board): array{
        return [];
    }
}
