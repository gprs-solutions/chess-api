<?php

namespace App\Chess;

class Game
{   
    /**
     * Game's board class.
     * 
     * @var Board $board.
     */
    public Board $board;

    /**
     * Current user color.
     * 
     * @var string $currentUser.
     */
    private string $currentUser;

    /**
     * Constructor method.
     * 
     * @param Board $board Chess board.
     */
    public function __construct(){
        $this->board = new Board();
    }

    /**
     * Starts Game.
     * 
     * @return void
     */
    public function startGame(): void{
        $this->board->fillStartingBoard();
        $this->currentUser = 'White';
    }

    /**
     * Switches the current user.
     * 
     * @return void
     */
    public function switchUser(): void{
        if($this->currentUser === 'Black'){
            $this->currentUser === 'White';
            return;
        }

        $this->currentUser === 'Black';
    }
}
