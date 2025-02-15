<?php

namespace App\Chess;

class Board
{
    /**
     * Game's board.
     */
    private array $board;

    /**
     * Constructor method.
     */
    public function __construct(){
        //Filling board for game start.
        $this->board = array_fill(0,8,array_fill(0,8,''));
    }
}
