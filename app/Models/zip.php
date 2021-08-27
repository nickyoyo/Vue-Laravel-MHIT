<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zip extends Model
{
    protected $table = 'zip';
    public $timestamps = false;
    protected $fillable = [
        '區號',
        '縣市',
        '區鄉鎮市',
        '街路',
    ];
}
