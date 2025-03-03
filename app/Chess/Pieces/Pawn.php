<?php
namespace App\Chess\Pieces;

use App\Chess\Piece;
use App\Chess\Board;
use App\Contracts\GameContextContract;
use App\Chess\Validators\EnPassantValidator;

class Pawn extends Piece{
    use EnPassantValidator;

    /**
     * Game context.
     * 
     * @var GameContextContract $gameContextContract
     */
    private GameContextContract $gameContextContract;

    /**
     * Constructor method.
     * 
     * @param GameContextContract $gameContextContract The contract with the game context.
     * @param string $color Piece color.
     * @param int $row Piece's row.
     * @param int $col Piece's col.
     */
    public function __construct(GameContextContract $gameContextContract, string $color, int $row, int $col){
        $this->gameContextContract = $gameContextContract;
        $this->code = 'P';
        $this->color = $color;
        $this->setPosition($row, $col);
    }
    
    /**
     * Get the moves for the Pawn without filtering for check, etc.
     *
     * This method considers:
     * - A single forward move if the square is empty.
     * - A double forward move if the pawn is on its starting rank and both squares are empty.
     * - Diagonal captures if an opposing piece is present.
     *
     * @param Board $board The chess board.
     * @return array An array of move objects (each with row and col properties).
     */
    public function getMoves(Board $board): array
    {
        $moves = [];
        $board = $board->getBoard();
        $row = $this->position->row;
        $col = $this->position->col;

        // Determine the forward direction based on the pawn's color.
        // For white pawns, forward means a decrease in row (i.e., direction = -1).
        // For black pawns, forward means an increase in row (i.e., direction = 1).
        $direction = ($this->color === 'white') ? -1 : 1;

        $forwardRow = $row + $direction;
        // Check bounds for the forward move
        if ($forwardRow >= 0 && $forwardRow < 8) {
            // Forward move: square must be empty.
            if ($board[$forwardRow][$col] === null) {
                $move = new \stdClass();
                $move->row = $forwardRow;
                $move->col = $col;
                $moves[] = $move;

                // Check for the two-step move if on the starting rank.
                $startingRank = ($this->color === 'white') ? 6 : 1;
                if ($row === $startingRank) {
                    $doubleForwardRow = $row + (2 * $direction);
                    // Check that both squares are empty.
                    if ($board[$doubleForwardRow][$col] === null) {
                        $move = new \stdClass();
                        $move->row = $doubleForwardRow;
                        $move->col = $col;
                        $moves[] = $move;
                    }
                }
            }

            // Diagonal capture moves:
            foreach ([-1, 1] as $deltaCol) {
                $captureCol = $col + $deltaCol;
                if ($captureCol >= 0 && $captureCol < 8) {
                    // For a capture move, check if there's an opposing piece in the diagonal square.
                    $target = $board[$forwardRow][$captureCol];
                    $movesHistory = $this->gameContextContract->getMoveHistory();
                    if (($target !== null && $target->color !== $this->color) || $this->canEnPassant($board,$movesHistory,$this)) {
                        $move = new \stdClass();
                        $move->row = $forwardRow;
                        $move->col = $captureCol;
                        $moves[] = $move;
                    }
                }
            }
        }

        return $moves;
    }    
}
