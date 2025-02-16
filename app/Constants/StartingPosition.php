<?php
namespace App\Chess\Constants;

use App\Chess\Game;
use App\Chess\Pieces\Bishop;
use App\Chess\Pieces\Knight;
use App\Chess\Pieces\Rook;
use App\Chess\Pieces\Queen;
use App\Chess\Pieces\Pawn;
use App\Chess\Pieces\King;
use App\Contracts\GameContextContract;

app()->bind(GameContextContract::class, Game::class);

// Create an 8x8 board array.
$board = [];

// Row 0: Black major pieces.
$board[0] = [
    app()->make(Rook::class, ['color' => 'Black', 'row' => 0, 'col' => 0]),
    app()->make(Knight::class, ['color' => 'Black', 'row' => 0, 'col' => 1]),
    app()->make(Bishop::class, ['color' => 'Black', 'row' => 0, 'col' => 2]),
    app()->make(Queen::class, ['color' => 'Black', 'row' => 0, 'col' => 3]),
    app()->make(King::class, ['color' => 'Black', 'row' => 0, 'col' => 4]),
    app()->make(Bishop::class, ['color' => 'Black', 'row' => 0, 'col' => 5]),
    app()->make(Knight::class, ['color' => 'Black', 'row' => 0, 'col' => 6]),
    app()->make(Rook::class, ['color' => 'Black', 'row' => 0, 'col' => 7]),
];

// Row 1: Black pawns.
$blackPawns = [];
for ($col = 0; $col < 8; $col++) {
    $blackPawns[] = app()->make(Pawn::class, ['color' => 'Black', 'row' => 1, 'col' => $col]);
}
$board[1] = $blackPawns;

// Rows 2 to 5: Empty.
for ($row = 2; $row <= 5; $row++) {
    $board[$row] = array_fill(0, 8, null);
}

// Row 6: White pawns.
$whitePawns = [];
for ($col = 0; $col < 8; $col++) {
    $whitePawns[] = app()->make(Pawn::class, ['color' => 'White', 'row' => 6, 'col' => $col]);
}
$board[6] = $whitePawns;

// Row 7: White major pieces.
$board[7] = [
    app()->make(Rook::class, ['color' => 'White', 'row' => 7, 'col' => 0]),
    app()->make(Knight::class, ['color' => 'White', 'row' => 7, 'col' => 1]),
    app()->make(Bishop::class, ['color' => 'White', 'row' => 7, 'col' => 2]),
    app()->make(Queen::class, ['color' => 'White', 'row' => 7, 'col' => 3]),
    app()->make(King::class, ['color' => 'White', 'row' => 7, 'col' => 4]),
    app()->make(Bishop::class, ['color' => 'White', 'row' => 7, 'col' => 5]),
    app()->make(Knight::class, ['color' => 'White', 'row' => 7, 'col' => 6]),
    app()->make(Rook::class, ['color' => 'White', 'row' => 7, 'col' => 7]),
];

return $board;
