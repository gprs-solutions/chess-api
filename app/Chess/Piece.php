<?php

namespace App\Chess;

use App\Contracts\PieceActionsContract;
use App\Chess\Board;
use Exception;

abstract class Piece implements PieceActionsContract
{
    /**
     * Piece color.
     * 
     * @var string $color.
     */
    public string $color;

    /**
     * Piece code for then class is printed.
     * 
     * @var string $code.
     */
    public string $code;

    /**
     * Piece position.
     * 
     * @var object $postion The piece's row and col.
     */
    public object $position;

    /**
     * Prints piece name when class is printed.
     */
    final public function __toString(){
        return str_split($this->color)[0] . $this->code;
    }

    /**
     * Get the moves for the piece without filtering.
     * 
     * @param Board $board the chess board.
     * 
     * @return array
     */
    abstract public function getMoves(Board $board): array;

    /**
     * Helper to clone the board and its pieces when it needs to be simulated.
     * 
     * @return void
     */
    public function __clone(){
        $this->position = clone $this->position;
    }

    /**
     * Set position for the piece.
     * 
     * @param int $row Piece's row.
     * @param int $col Piece's col.
     * 
     * @return void
     */
    protected function setPosition(int $row, int $col){
        $numberOfRowsAndColumns = 7; //From 0 to 7.
        if($row > $numberOfRowsAndColumns || $col > $numberOfRowsAndColumns){
            throw new Exception('Position given out of bounds!');
        }

        $this->position = new \stdClass();

        $this->position->row = $row;
        $this->position->col = $col;
    }
}
