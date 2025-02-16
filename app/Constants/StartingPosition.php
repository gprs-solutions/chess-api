<?php
namespace App\Chess\Constants;

use App\Chess\Pieces\Bishop;
use App\Chess\Pieces\Knight;
use App\Chess\Pieces\Rook;
use App\Chess\Pieces\Queen;
use App\Chess\Pieces\Pawn;
use App\Chess\Pieces\King;

return [
    [new Rook('Black',0,0),new Knight('Black',0,1),new Bishop('Black',0,2),new Queen('Black',0,3),new King('Black',0,4),new Bishop('Black',0,5),new Knight('Black',0,6),new Rook('Black',0,7),],
    [new Pawn('Black',1,0), new Pawn('Black',1,1), new Pawn('Black',1,2), new Pawn('Black',1,3), new Pawn('Black',1,4), new Pawn('Black',1,5), new Pawn('Black',1,6), new Pawn('Black',1,7),],
    [null,null,null,null,null,null,null,null,],
    [null,null,null,null,null,null,null,null,],
    [null,null,null,null,null,null,null,null,],
    [null,null,null,null,null,null,null,null,],
    [new Pawn('White',6,0), new Pawn('White',6,1), new Pawn('White',6,2), new Pawn('White',6,3), new Pawn('White',6,4), new Pawn('White',6,5), new Pawn('White',6,6), new Pawn('White',6,7),],
    [new Rook('White',7,0),new Knight('White',7,1),new Bishop('White',7,2),new Queen('White',7,3),new King('Black',7,4),new Bishop('White',7,5),new Knight('White',7,6),new Rook('White',7,7),],
];