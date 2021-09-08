<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class im extends Model
{
    protected $table = 'im';
    public $timestamps = false;
    protected $fillable = [
      'SKU',
      'SupplierCode',
      '折扣啟用日',
      '折扣率',
      'ROP',
      '啟用折扣',
      'Discontinue',
      'DataDate',
      'ModifyDate',
      'Description',
      'Unit',
      'Volume',
      'SubClass',
      'Edescription',
      'im_Class',
      'SupplierNo',
      'im_UserID',
      'MinQty',
      'Memo',
      'm3',
      'UKcost',
      'FullPrice',
      'TWcost',
      'DiscountPrice',
      'Ptype',
      'PackQty',
      'local_im',
      'ROP_Type',
      'height_',
      'Type1',
      'Type2',
      'Type3',
      'Type4',
      'AgencyPrice',
      'StoreCost',
      'NoFittingPrice',
      'FixRop',
      'CreateDate',
      'CreateUser',
      '備註',
      'msrepl_tran_version',
      'vmMinQty',
      'sysLock',
      '高度',
      '重量',
      '外箱長',
      '外箱寬',
      '外箱高',
      '長度',
      '固定額外售價',
      '固定額外成本',
    ];
}
