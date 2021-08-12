<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cm extends Model
{
    protected $table = 'cm';
    public $timestamps = false;
    protected $fillable = [
        'CustNo',
        'CustName',
        'CustSname',
        'CustID',
        'TelDay',
        'Mobil',
        'Fax',
        'TelNight',
        'CusAddress',
        'FittingAdd',
        'CustType',
        'Gender',
        'Married',
        'Kids',
        'HouseSize',
        'BuyReason',
        'FavColor',
        'Budget',
        'PorductType',
        'ZipCode',
        'LastUse',
        'UserId',
        'Designer',
        'LastModify',
        'DataCreate',
        'Meno',
        'Birthday',
        '門市別',
        'email',
        'msrepl_tran_version',
        'COMPANY',
        'identification',
        'principal',
        'dismantle',
        'HouseDate',
        'MemberCount',
        'FinishDate',
        'CheckInDate',
        'budgetTot',
        'budgetCabinet',
        'budgetFloor',
        'budgetSofa',
        'BuildName',
        'Woodwork',
        'needChk',
        'HouseType',
        'Family',
    ];
}
