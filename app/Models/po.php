<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class po extends Model
{
    protected $table = 'po';
    public $timestamps = false;
    protected $fillable = [
        'PoNo',
      'SuppNo',
      'PoDate',
      'QuotNo',
      'UserId',
      'PoValue',
      'LastNo',
      'CancelDate',
      'Status',
      'Memo',
      'Description',
      'LocalValue',
      'PortCharge',
      'Check_Po',
      'OrderDate',
      'DeliverDate',
      'ExRate',
      'DelAdd',
      'LastUpdateTime',
      'pdaid',
      'ReceiveDate',
      'msrepl_tran_version',
      'Despatched',
      'AmendNo',
      'RelativeNo',
      'PlanNo',
      'Addendum',
      'Sample',
      'ToStore',
      'StoreNo',
    ];
}
