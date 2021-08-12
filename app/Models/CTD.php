<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTD extends Model
{
    protected $table = 'CTD';
    public $timestamps = false;
    protected $fillable = [
        'codename',
        'codeindex',
        'codeDesc',
        'codetype',
        'Memo',
        'Reserve1',
        'Reserve2',
        'Reserve3',
        'Reserve4',
    ];
}
