<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMCRFItems extends Model
{
    protected $table = 'CMCRFItems';
    public $timestamps = false;
    protected $fillable = [
        'CustNo',
        'Items',
    ];
}
