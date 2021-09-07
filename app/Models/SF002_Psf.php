<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SF002_Psf extends Model
{
    protected $table = 'SF002_Psf';
    public $timestamps = false;
    protected $fillable = [
      'SalesCode',
      'StockCode',
      'Qty',
      'UserID',
      'ModifyDate',
      'ModibyTime',
      'msrepl_tran_version',
      'ApplyDate',
      'ApplyTime',
    ];
}
