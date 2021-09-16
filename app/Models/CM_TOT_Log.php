<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CM_TOT_Log extends Model
{
    protected $table = 'CM_TOT_Log';
    public $timestamps = false;
    protected $fillable = [
      'custno',
      'Date_',
      'checkphoto',
      'schedule',
      'problem',
      'Countermeasure',
      'Violation',
      'Userid',
      'CreateDate',
      'Enable',
      'PE',
    ];
}
