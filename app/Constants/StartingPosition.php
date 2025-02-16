<?php
namespace App\Chess\Constants;

use App\Chess\Pieces\Bishop;
use App\Chess\Pieces\Knight;
use App\Chess\Pieces\Rook;
use App\Chess\Pieces\Queen;

return [
    [new Rook('Black',0,0),new Knight('Black',0,1),new Bishop('Black',0,2),new Queen('Black',0,3),null,new Bishop('Black',0,5),new Knight('Black',0,6),new Rook('Black',0,7),],
    [null,null,null,null,null,null,null,null,],
    [null,null,null,null,null,null,null,null,],
    [null,null,null,null,null,null,null,null,],
    [null,null,null,null,null,null,null,null,],
    [null,null,null,null,null,null,null,null,],
    [null,null,null,null,null,null,null,null,],
    [new Rook('White',7,0),new Knight('Black',7,1),new Bishop('White',7,2),new Queen('White',7,3),null,new Bishop('White',7,5),new Knight('White',7,6),new Rook('White',7,7),],
];