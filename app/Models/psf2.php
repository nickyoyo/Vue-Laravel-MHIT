<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class psf2 extends Model
{
    protected $table = 'psf2';
    public $timestamps = false;
    protected $fillable = [
       'Selescode',
      'Stockcode',
      'Qty',
      'ApplyDate',
      'CancelDate',
      'Memos',
      'ModifyDate',
      'msrepl_tran_version',
      'OriginalQty',
    ];
}
