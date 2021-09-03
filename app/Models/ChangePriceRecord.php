<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangePriceRecord extends Model
{
    protected $table = '售價變價紀錄';
    public $timestamps = false;
    protected $fillable = [
       '料',
      '日',
      '時',
      '員',
      '前價',
      '後價',
      '前折扣',
      '後折扣',
      'msrepl_tran_version',
    ];
}
