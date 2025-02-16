<?php

namespace App\Chess;

use Exception;

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

    /**
     * Moves a piece to a new square.
     * 
     * @param object $oldPosition Old piece position.
     * @param object $newPosition New position.
     * 
     * @return bool
     */
    public function movePiece(object $oldPosition, object $newPosition): bool{
        $board = $this->board->getBoard();
        
        $legalMoves = $this->board->filterAvailableMoves($board[$oldPosition->row][$oldPosition->col]);

        foreach($legalMoves as $move){
            if(!($move->row === $newPosition->row && $move->col === $newPosition->col)){
                continue;
            }

            //Move required is legal, removing piece from old pos and adding to new.
            $board[$newPosition->row][$newPosition->col] = $board[$oldPosition->row][$oldPosition->col];
            $board[$oldPosition->row][$oldPosition->col] = null;
            $this->board->setBoard($board);

            return true;
        }

        return false;
    }
}
