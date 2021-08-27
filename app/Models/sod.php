<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sod extends Model
{
    protected $table = 'sod';
    public $timestamps = false;
    protected $fillable = [
        'QuotNo',
        'ItemNo',
        'CustNo',
        'EasyCode',
        'Ragne',
        'UnitPrice',
        'Qty',
        'OrderValue',
        'temp',
        'memo',
        'OrderDate',
        'RequireDate',
        'WarehouseNo',
        'DispQty',
        'Status',
        'DiscountRate',
        'ReturnQty',
        'SalesCode',
        'UserID',
        '銷貨日期',
        '出貨日期',
        '保固代碼',
        '保固費用',
        '非保固',
        'msrepl_tran_version',
        'Memo2',
        'AddCode',
        'material',
        '固定額外售價',
    ];
}
