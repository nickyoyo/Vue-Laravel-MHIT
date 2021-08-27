<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SO extends Model
{
    protected $table = 'SO';
    public $timestamps = false;
    protected $fillable = [
        'QuotNo',
        'QuotDate',
        'OrderDate',
        'RequireDate',
        'DispatchDate',
        'CusNo',
        'Range',
        'Change',
        'Export',
        'exwork',
        'TotalValue',
        'OrderType',
        'SMcheck',
        'CadFile',
        'CadPath',
        'UserId',
        'IncentiveSC',
        'AllocatedDate',
        'StoreNo',
        'addr',
        'SMcheckDate',
        'ClearDate',
        'AppDate',
        'ClosingDate',
        'PickingDate',
        'Status',
        'QorS',
        'Picked',
        'DeliverDate',
        'ExpireDate',
        'WarehouseNo',
        'ZIP',
        'Memo',
        'FitFinish',
        'AreaCode',
        'SurveyNo',
        'PromotionPeriod',
        'FullAllocated',
        'BalanceAllocatedDate',
        'OrderSM',
        'OrderSM2',
        'CheckSM',
        'IncentiveSM',
        'BalanceAllocated',
        'pdaid',
        'Switch',
        'AddItem',
        'Markup',
        'Fee_',
        'ProfitDate',
        'msrepl_tran_version',
        'RoomType',
    ];
}
