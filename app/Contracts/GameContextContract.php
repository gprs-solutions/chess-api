<?php
namespace App\Contracts;

interface GameContextContract
{
    /**
     * Returns the move history.
     *
     * @return array
     */
    public function getMoveHistory(): array;
}