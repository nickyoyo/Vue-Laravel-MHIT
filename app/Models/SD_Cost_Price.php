<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SD_Cost_Price extends Model
{
    protected $table = 'SD_Cost_Price';
    public $timestamps = false;
    protected $fillable = [
        'Date_',
        'Range_',
        'Cost_',
        'Price_',
        'CostRate',
        'UserID',
        'ModifyDate',
        'ModifyTime',
        'msrepl_tran_version',
    ];
}
