<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SF002_Cost_Price extends Model
{
    protected $table = 'SF002_Cost_Price';
    public $timestamps = false;
    protected $fillable = [
      '色號',
      '板類',
      '日期',
      '成本',
      '售價',
      'UserID',
      'ModifyDate',
      'ModifyTime',
      '成本率',
      'msrepl_tran_version',
    ];
}
