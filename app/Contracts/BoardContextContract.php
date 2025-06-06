<?php
namespace App\Contracts;

use App\Chess\Piece;

interface BoardContextContract
{
    /**
     * Fills board in the starting position.
     * 
     * @return void
     */
    public function fillStartingBoard(): void;

    /**
     * Board getter.
     * 
     * @return array
     */
    public function getBoard(): array;

    /**
     * Board setter.
     * 
     * @return void
     */
    public function setBoard(array $board): void;

    /**
     * Receives a board and positions, pushing to this board.
     * 
     * @param array $board The board with the pieces.
     * @param object $oldPosition Old piece position.
     * @param object $newPosition New position.
     * 
     * @return array
     */
    public function pushToBoard(array $board,object $oldPosition,object $newPosition) :array;

    /**
     * Filters the available moves for a piece based on blocking pieces.
     *
     * @param Piece $piece The piece to filter moves for.
     * @return array An array of move objects (each with row and col properties).
     */
    public function filterAvailableMoves(?Piece $piece): array;
}