<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vm extends Model
{
    protected $table = 'vm';
    public $timestamps = false;
    protected $fillable = [
        'SuppNo',
        'SuppName',
        'ShortName',
        'IDno',
        'OfficeTel1',
        'officeTel2',
        'OfficeFax',
        'WHtel1',
        'WHtel2',
        'WHfax',
        'OfficeAdd',
        'WHadd',
        'Conn1Name',
        'Conn1Pos',
        'Conn2Name',
        'Conn2Pos',
        'ClosingDay',
        'PaymentType',
        'UserId',
        'LastTrans',
        'DateCreate',
        'SuppType',
        'Discontinue',
        'Meno',
        'TransitWay',
        'TransitDay',
        'RQDMenuClosing',
        '允許超交',
        'BankName',
        'BankNo',
        'AccName',
        'AccNo',
        'PaymentTerm',
        '報價單分配',
        'msrepl_tran_version',
        '不可追加',
        '採購週期',
        '到貨週期',
        'Email',
        'Email2',
    ];
}
