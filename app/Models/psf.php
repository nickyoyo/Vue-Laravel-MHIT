<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class psf extends Model
{
    protected $table = 'psf';
    public $timestamps = false;
    protected $fillable = [
       'Salescode',
      'Stockcode',
      'Qty',
      'ApplyDate',
      'DisconDate',
      '備註_Meno',
      'ModifyDate',
      'msrepl_tran_version',
      'OriginalQty',
    ];
}
