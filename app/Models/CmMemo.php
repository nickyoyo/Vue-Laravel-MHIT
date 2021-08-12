<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmMemo extends Model
{
    protected $table = 'CmMemo';
    public $timestamps = false;
    protected $fillable = [
        'CustNo',
        'Type_',
        'OrderNo',
        'Items',
        'code_',
        '備註',
        'Date_',
        'Time_',
        'UserId',
        'msrepl_tran_version',
    ];
}
