<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CM_TOT_Check extends Model
{
    protected $table = 'CM_TOT_Check';
    public $timestamps = false;
    protected $fillable = [
      'CustNo',
      'Item',
      'checked',
      'vmpic',
      'vmvr',
      'pcpic',
      'pcvr',
      'date_',
      'UserId',
      'Noneed',
    ];
}
