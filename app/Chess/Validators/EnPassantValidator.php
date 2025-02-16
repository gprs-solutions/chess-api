<?php

namespace App\Chess\Validators;

use App\Chess\Pieces\Pawn;

//TODO: Needs improvement to catch corner case scenarios.
trait EnPassantValidator
{
    /**
     * Returns true if the given pawn can en-passant.
     *
     * @param array $board
     * @param array $moves
     * @param string $color
     * 
     * @return bool
     */
    public function canEnPassant(array $board, array $moves, Pawn $pawn): bool
    {

        if (!isset($pawn->code) || $pawn->code !== "P") {
            return false;
        }

        //testing if there's a opposite color pawn right to the side of the given pawn.
        $pawnPosition = $pawn->position;
        $directions = [1,-1]; //Right and left square.

        foreach($directions as $direction){
            $square = isset($board[$pawnPosition->row][$pawnPosition->col + $direction]) 
                ? $board[$pawnPosition->row][$pawnPosition->col + $direction] : null;
            if($square instanceof Pawn && $square->color !== $pawn->color){
                if($this->testLastMove($moves, $square->color)){
                    return true;
                }
            }
        }


        return false;
    }

    /**
     * Tests is the last move was from a opposite pawn to the square that allows en-passant.
     * 
     * @param array $moves The array of moves.
     * @param string $color The pawn's color.
     * 
     * @return bool
     */
    private function testLastMove(array $moves, string $color): bool{
        $lastMove = end($moves);

        //Test if it was a pawn move (only pawns have 2 letters).
        if(count(str_split($lastMove)) !== 2){
            return false; // Not a pawn move, can't en-passant.
        }

        //Checking if it is in the right row (4 or 3).
        $row = $this->letterToNumber(reset(str_split($lastMove)));

        if(($color === 'Black' && $row !== 4) || ($color === 'White' && $row !== 3)){
            //Can't be in an en passant square.
            return false;
        }

        //search if pawn from last move moved 2 squares.
        $col = intval(end(str_split($lastMove)));

        //Making sure pawn has not walked a single square each time.
        $moveThatCannotFind = reset(str_split($lastMove)) . ($color === 'White' ?  $col - 1 : $col + 1);
        if(!in_array($moveThatCannotFind, $moves)){
            return true;
        }

        return false;
    }

    /**
     * Converts letter from std notation to number.
     * 
     * @param string $letter Letter to be converted.
     * 
     * @return int|false 
     */
    private function letterToNumber(string $letter){
        $map = [
            'a' => 0,
            'b' => 1,
            'c' => 2,
            'd' => 3,
            'e' => 4,
            'f' => 5,
            'g' => 6,
            'h' => 7
        ];

        return !isset($map[$letter]) ? false : $map[$letter];
    }
}
