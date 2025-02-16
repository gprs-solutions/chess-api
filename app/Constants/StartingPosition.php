<?php
namespace App\Chess\Constants;

use App\Chess\Pieces\Bishop;
use App\Chess\Pieces\Rook;

return [
    [new Rook('Black',0,0),null,new Bishop('Black',0,2),null,null,new Bishop('Black',0,5),null,new Rook('Black',0,7),],
    [null,null,null,null,null,null,null,null,],
    [null,null,null,null,null,null,null,null,],
    [null,null,null,null,null,null,null,null,],
    [null,null,null,null,null,null,null,null,],
    [null,null,null,null,null,null,null,null,],
    [null,null,null,null,null,null,null,null,],
    [new Rook('White',7,0),null,new Bishop('White',7,2),null,null,new Bishop('White',7,5),null,new Rook('White',7,7),],
];