<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CM_TOT_Date extends Model
{
    protected $table = 'CM_TOT_Date';
    public $timestamps = false;
    protected $fillable = [
        'CustNo',
        'Type',
        'DateB',
        'DateE',
        'DateB_2',
        'DateE_2',
        'Cust',
        'Finish',
        'Manufacturer',
        'Contact',
        'Mobil',
        'holiday',
    ];
}
