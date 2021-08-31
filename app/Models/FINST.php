<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FINST extends Model
{
    protected $table = 'FINST';
    public $timestamps = false;
    protected $fillable = [
       '訂單編號',
      '安裝組號',
      '施工天數',
      '確定出貨日',
      '檢核日',
      '處理員',
      '確定出貨時',
      '安裝日',
      '安裝迄日',
      '安裝日時',
      '拆除日',
      '拆除日時',
      '拆除組號',
      '維修日',
      '維修日時',
      '維修迄日',
      '維修組號',
      '檢核',
      '完工',
      '檢核log',
      '完工log',
      '監工',
      '客戶號',
      '確認',
      '確認log',
      '運送組號',
      '運送日',
      '運送時',
      'CloseDate',
      'msrepl_tran_version',
      'InspectDate',
    ];
}
