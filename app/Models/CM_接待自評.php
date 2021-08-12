<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CM_接待自評 extends Model
{
    protected $table = 'CM_接待自評';
    public $timestamps = false;
    protected $fillable = [
        'Store',
        'Date_',
        'UserId',
        'CustNo',
        '品牌力',
        '迎賓加分點',
        '商品力',
        '門市展演加分點',
        '經驗力',
        '案例對焦加分點',
        '預算對焦',
        '服務流程對焦點',
        '促銷活動',
        '促銷活動對焦點',
        '異議排除',
        '異議排除對焦點',
        '店長協助',
        'LINE',
        'Google',
        'datetime_',
    ];
}
