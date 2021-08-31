<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class arm1 extends Model
{
    protected $table = 'arm1';
    public $timestamps = false;
    protected $fillable = [
      'CustNo',
      'OrderDate',
      'OrderValue',
      '額外施工費用',
      '墊款餘額',
      'Deposit',
      'Payment',
      'Rebat',
      'UserId',
      'StoreNo',
      'Status',
      'OrderNo',
      'Refund',
      '退折讓',
      '檔期',
      'MFI',
      'Local_',
      '帳款金額',
      '實收金額',
      '應收餘額',
      '溢收金額',
      '店折扣額',
      '代墊餘額',
      '應收還款',
      '保固費用',
      'msrepl_tran_version',
    ];
}
