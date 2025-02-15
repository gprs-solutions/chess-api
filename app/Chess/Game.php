<?php

namespace App\Chess;

class Game
{   
    /**
     * Game's board class.
     * 
     * @var Board $board.
     */
    private Board $board;

    /**
     * Constructor method.
     */
    public function __construct(Board $board){
        $this->board = $board;
    }
}
