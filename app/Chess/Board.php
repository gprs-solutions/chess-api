<?php

namespace App\Chess;

class Board
{
    /**
     * Game's board.
     */
    private array $board;

    /**
     * Board getter.
     * 
     * @return array
     */
    public function getBoard(): array{
        return $this->board;
    }

    /**
     * Board setter.
     * 
     * @return void
     */
    public function setBoard(array $board): void{
        $this->board = $board;
    }

    /**
     * Fills board in the starting position.
     * 
     * @return void
     */
    public function fillStartingBoard(): void{
        $this->board = require __DIR__ . '/../Constants/StartingPosition.php';
    }

    /**
     * Filters the available moves for a piece based on blocking pieces.
     *
     * @param Piece $piece The piece to filter moves for.
     * @return array An array of move objects (each with row and col properties).
     */
    public function filterAvailableMoves(?Piece $piece): array
    {
        //If is not a piece no squares available.
        if(!($piece instanceof Piece)){
            return [];
        }

        $possibleMoves = $piece->getMoves($this);
        $filteredMoves = [];

        // Current position of the piece
        $startRow = $piece->position->row;
        $startCol = $piece->position->col;

        // Keep track of directions that are already blocked.
        $directionsBlocked = [];

        foreach ($possibleMoves as $move) {
            // Determine the direction vector for this move.
            $dRow = $move->row - $startRow;
            $dCol = $move->col - $startCol;
            $dirRow = $dRow === 0 ? 0 : ($dRow > 0 ? 1 : -1);
            $dirCol = $dCol === 0 ? 0 : ($dCol > 0 ? 1 : -1);
            $direction = $dirRow . ',' . $dirCol;

            // If this direction is already blocked, skip this move.
            if (isset($directionsBlocked[$direction])) {
                continue;
            }

            // Check if there's a piece at the target square.
            $target = $this->board[$move->row][$move->col] ?? null;
            if ($target !== null) {
                // There's a piece. If it's the same color, block without adding.
                if ($target->getColor() === $piece->color) {
                    $directionsBlocked[$direction] = true;
                    continue;
                } else {
                    // Opponent piece: allow capture, then block further moves in this direction.
                    $filteredMoves[] = $move;
                    $directionsBlocked[$direction] = true;
                }
            } else {
                // No piece here; add the move.
                $filteredMoves[] = $move;
            }
        }

        return $filteredMoves;
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
