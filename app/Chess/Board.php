<?php

namespace App\Chess;

class Board
{
    /**
     * Game's board.
     */
    private array $board;

    /**
     * Fills board in the starting position.
     * 
     * @return void
     */
    public function fillStartingBoard(): void{
        $this->board = require __DIR__ . '/../Constants/StartingPosition.php';
    }

    /**
     * Prints board for testing purposes.
     * 
     * @return string
     */
    public function printBoard(){
        $finalBoard = [];

        //Transforming pieces into names.
        foreach($this->board as $idx => $row){
            $finalBoard[] = [];
            foreach($row as $slot){
                //Forcing magic method __toString to be called via catching output buffering.
                ob_start();
                echo $slot !== null ? $slot : null;
                $output = ob_get_clean();

                $finalBoard[$idx][] = $output;
            }
        }

        return print_r($finalBoard);
    }
}
