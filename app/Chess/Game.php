<?php
namespace App\Chess;

use App\Chess\Validators\CheckmateValidator;
use App\Contracts\GameContextContract;
use App\Chess\Validators\CheckValidator;
use App\Contracts\BoardContextContract;
use App\Events\CheckmateOccurred;

class Game implements GameContextContract
{   
    use CheckValidator;
    use CheckmateValidator;

    /**
     * Game's board class.
     * 
     * @var Board $board.
     */
    public Board $board;

    /**
     * Game moves.
     * 
     * @var array $moves
     */
    public array $moves;

    /**
     * Current user color.
     * 
     * @var string $currentUser.
     */
    public string $currentUser;

    /**
     * Constructor method.
     * 
     * @param BoardContextContract $board Chess board contract.
     */
    public function __construct(BoardContextContract $board){
        $this->board = $board;
        $this->moves = [];
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
            $this->currentUser = 'White';
            return;
        }

        $this->currentUser = 'Black';
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

        if($this->isCheck($oldPosition, $newPosition)){
            return false;
        }
        
        foreach($legalMoves as $move){
            if(!($move->row === $newPosition->row && $move->col === $newPosition->col)){
                continue;
            }

            $board = $this->board->pushToBoard($board, $oldPosition, $newPosition);

            $this->board->setBoard($board);
            $this->addMove($newPosition);
            $this->switchUser();

            if($this->isCheckmate($this->board, $this->currentUser)){
                CheckmateOccurred::dispatch($this->currentUser);
            }

            return true;
        }

        return false;
    }

    /**
     * Converts move to standard notation and pushes it to the moves array.
     * 
     * @param object $newPosition New position.
     * 
     * @return bool
     */
    private function addMove(object $newPosition): bool
    {
        $boardState = $this->board->getBoard();

        $piece = $boardState[$newPosition->row][$newPosition->col] ?? null;
        
        if ($piece === null) {
            return false;
        }

        // Determine the piece's identifying letter.
        $pieceLetter = $piece->code ?? '';
        if (strtoupper($pieceLetter) === 'P') {
            $pieceLetter = '';
        }

        // Convert positions to algebraic notation.
        $to   = $this->convertToAlgebraic($newPosition->row, $newPosition->col);

        // e.g. "c4" or "e4".
        $moveString = $pieceLetter . $to;

        $this->moves[] = $moveString;

        return true;
    }

    /**
     * Converts board coordinates (row, col) to algebraic notation.
     *
     * @param int $row
     * @param int $col
     * 
     * @return string
     */
    private function convertToAlgebraic(int $row, int $col): string
    {
        $file = chr(ord('a') + $row);
        return $file . $col;
    }

    /**
     * Tests if position is a check.
     * 
     * @param object $oldPosition Old piece position.
     * @param object $newPosition New position
     * 
     * @return bool
     */
    private function isCheck($oldPosition, $newPosition): bool{
        //Creating a new fictious board with new pos to simulate new position.
        $board = clone $this->board;
        $simulatedBoard = $this->board->pushToBoard($board->getBoard(),$oldPosition,$newPosition);
        $board->setBoard($simulatedBoard);

        return $this->isKingInCheck($board, $this->currentUser);
    }

    /**
     * Returns the move history.
     *
     * @return array
     */
    public function getMoveHistory(): array
    {
        return $this->moves;
    }
}
