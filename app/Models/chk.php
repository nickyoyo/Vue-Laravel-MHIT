<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chk extends Model
{
    protected $table = 'chk';
    public $timestamps = false;
    protected $fillable = [
        '單號',
        '客戶號',
        '預定日期',
        '時間',
        '完工日期',
        '處理碼',
        '丈量人員',
        '丈量地址',
        'Memo',
        'Date_add',
        'UserID',
        '門市別_StoreNo',
        'Date_modi',
        '臥室數',
        '廚房數',
        'bathroom',
        'msrepl_tran_version',
        '狀態',
        'time_add',
        '預計成交日',
        '預計成交率',
    ];
}
