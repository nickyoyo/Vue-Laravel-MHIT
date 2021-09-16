<?php

namespace App\Http\Controllers\api;

use App\Models\cm;
use App\Models\EM13;
use App\Models\CMCRFItems;
use App\Models\CM_接待自評;
use App\Models\CmMemo;
use App\Models\CTD;
use App\Models\chk;
use App\Models\sod;
use App\Models\SO;
use App\Models\arm1;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

date_default_timezone_set("Asia/Taipei");

class UpdateController extends Controller
{
    public function UpdateCM(Request $request)          //CM
    {
        $data = $request->all();
        //return $data;
        $DAY = $data['custT'];
        $data = $data['cust'];
        $CNO = trim($data['CustNo']);

        $LastModify = str_replace("-", "", $DAY['LastModify']);
        $Woodwork = str_replace("-", "", $DAY['Woodwork']);
        $FavColor = str_replace("-", "", $DAY['FavColor']);
        $FinishDate = str_replace("-", "", $DAY['FinishDate']);
        $CheckInDate = str_replace("-", "", $DAY['CheckInDate']);
        $HouseDate = str_replace("-", "", $DAY['HouseDate']);

        $CName = $data['CustName'];
        if ($CName != NULL || $CName = '') {
            $CustSname = mb_substr($CName, 0, 1, 'utf-8') . '@' . mb_substr($CName, 2, strlen($CName) - 2, 'utf-8');
        } else {
            $CustSname = '';
        }
        $CC = $DAY['CusAddressC'];
        $CS = $DAY['CusAddressS'];
        $CusAddress = $CC.$CS;

        $FC = $DAY['FittingAddC'];
        $FS = $DAY['FittingAddS'];
        $FittingAdd = $FC.$FS;
        
        cm::where('CustNo', $CNO)
            ->update([
                'LastModify' => ($LastModify == NULL) ? '' : $LastModify,
                'Woodwork' => ($Woodwork == NULL) ? '' : $Woodwork,
                'FavColor' => ($FavColor == NULL) ? '' : $FavColor,
                'FinishDate' => ($FinishDate == NULL) ? '' : $FinishDate,
                'CheckInDate' => ($CheckInDate == NULL) ? '' : $CheckInDate,
                'HouseDate' => ($HouseDate == NULL) ? '' : $HouseDate,
                'CustName' => ($CName == NULL) ? '' : $CName,
                'CustSname' => ($CustSname == NULL) ? '' : $CustSname,
                'TelDay' => ($data['TelDay'] == NULL) ? '' : $data['TelDay'],
                'Mobil' => ($data['Mobil'] == NULL) ? '' : $data['Mobil'],
                'Fax' => ($data['Fax'] == NULL) ? '' : $data['Fax'],
                'TelNight' => ($data['TelNight'] == NULL) ? '' : $data['TelNight'],
                'CustType' => ($data['CustType'] == NULL) ? '' : $data['CustType'],
                'Gender' => ($data['Gender'] == NULL) ? '' : $data['Gender'],
                'CusAddress' => $CusAddress,
                'FittingAdd' => $FittingAdd,
                //'Married',
                //'Kids',
                'HouseSize' => ($data['HouseSize'] == NULL) ? '' : $data['HouseSize'],
                'BuyReason' => ($data['BuyReason'] == NULL) ? '' : $data['BuyReason'],
                'FavColor' => ($FavColor == NULL) ? '' : $FavColor,
                'Budget' => ($data['Budget'] == NULL) ? '' : $data['Budget'],
                //'PorductType',
                'ZipCode' => ($data['ZipCode'] == NULL) ? '' : $data['ZipCode'],
                'LastUse' => ($data['LastUse'] == NULL) ? '' : $data['LastUse'],
                //'UserId',
                //'Designer',
                'LastModify' => ($LastModify == NULL) ? '' : $LastModify,
                //'DataCreate',
                //'Meno',
                'Birthday' => ($data['Birthday'] == NULL) ? '' : $data['Birthday'],
                //'門市別', 
                'email' => ($data['email'] == NULL) ? '' : $data['email'],
                'COMPANY' => ($data['COMPANY'] == NULL) ? '' : $data['COMPANY'],
                'identification' => ($data['identification'] == NULL) ? '' : $data['identification'],
                'principal' => ($data['principal'] == NULL) ? '' : $data['principal'],
                'dismantle' => ($data['dismantle'] == NULL) ? '' : $data['dismantle'],
                'HouseDate' => ($HouseDate == NULL) ? '' : $HouseDate,
                'MemberCount' => ($data['MemberCount'] == NULL) ? '' : $data['MemberCount'],
                'FinishDate' => ($FinishDate == NULL) ? '' : $FinishDate,
                'CheckInDate' => ($CheckInDate == NULL) ? '' : $CheckInDate,
                'budgetTot' => ($data['budgetTot'] == NULL) ? '' : $data['budgetTot'],
                'budgetCabinet' => ($data['budgetCabinet'] == NULL) ? '' : $data['budgetCabinet'],
                'budgetFloor' => ($data['budgetFloor'] == NULL) ? '' : $data['budgetFloor'],
                'budgetSofa' => ($data['budgetSofa'] == NULL) ? '' : $data['budgetSofa'],
                'BuildName' => ($data['BuildName'] == NULL) ? '' : $data['BuildName'],
                'Woodwork' => ($Woodwork == NULL) ? '' : $Woodwork,
                'needChk' => ($data['needChk'] == NULL) ? '' : $data['needChk'],
                'HouseType' => ($data['HouseType'] == NULL) ? '' : $data['HouseType'],
                'Family' => ($data['Family'] == NULL) ? '' : $data['Family'],
            ]);
        return response()->json($data, 200);
    }
    public function UpdateCmMemo(Request $request)        //CmMemo
    {
        $data = $request->all();
        //return $data;
        $CNO = trim($data['cust']['CustNo']);
        $Cmemo = $data['Cmemo'];
        $CH_ID = '21072176';
        $DATE = date('Ymd');

        CmMemo::where('CustNo', $CNO)->where('Type_', '00')->where('code_', '0')->where('Items',0)
            ->update([
                '備註' => $Cmemo[0]['memo'],
                'Date_' => $DATE,
                'UserId' => $CH_ID,
            ]);
        CmMemo::where('CustNo', $CNO)->where('Type_', '00')->where('code_', '1')->where('Items',0)
            ->update([
                '備註' => $Cmemo[1]['memo'],
                'Date_' => $DATE,
                'UserId' => $CH_ID,
            ]);
        CmMemo::where('CustNo', $CNO)->where('Type_', '00')->where('code_', '2')->where('Items',0)
            ->update([
                '備註' => $Cmemo[2]['memo'],
                'Date_' => $DATE,
                'UserId' => $CH_ID,
            ]);
        CmMemo::where('CustNo', $CNO)->where('Type_', '00')->where('code_', '3')->where('Items',0)
            ->update([
                '備註' => $Cmemo[3]['memo'],
                'Date_' => $DATE,
                'UserId' => $CH_ID,
            ]);
        CmMemo::where('CustNo', $CNO)->where('Type_', '00')->where('code_', '4')->where('Items',0)
            ->update([
                '備註' => $Cmemo[4]['memo'],
                'Date_' => $DATE,
                'UserId' => $CH_ID,
            ]);
        CmMemo::where('CustNo', $CNO)->where('Type_', '00')->where('code_', '5')->where('Items',0)
            ->update([
                '備註' => $Cmemo[5]['memo'],
                'Date_' => $DATE,
                'UserId' => $CH_ID,
            ]);
        
        return response()->json($data['Cmemo'], 200);
    }
    public function UpdateCMCRFItems(Request $request)        //CMCRFItems
    {

        $data = $request->all();
        // return $data['UDS'];
        $Cust = $data['cust'];
        $UDS = $data['UDS'];
        $UseExp = $data['UseExp'];
        $likeStyle = $data['likeStyle'];
        $space = $data['space'];
        $CNO = trim($Cust['CustNo']);
        $deleteold = CMCRFItems::where('CustNo', $CNO);
        $deleteold->delete();

        for($i=0; $i<4; $i++){
            if ($UseExp[$i]['value'] == 'true' || $UseExp[$i]['value'] == 1) {
                CMCRFItems::create([
                    'CustNo' => $CNO,
                    'Items' => $UseExp[$i]['data'].$UseExp[$i]['type'],
                ]);
            }
        }
        for($i=0; $i<5; $i++){
            if ($UDS[$i]['value'] == 'true' || $UDS[$i]['value'] == 1) {
                CMCRFItems::create([
                    'CustNo' => $CNO,
                    'Items' => $UDS[$i]['data'].$UDS[$i]['type'],
                ]);
            }
        }
        for($i=0; $i<6; $i++){
            if ($likeStyle[$i]['value'] == 'true' || $likeStyle[$i]['value'] == 1) {
                CMCRFItems::create([
                    'CustNo' => $CNO,
                    'Items' => $likeStyle[$i]['data'].$likeStyle[$i]['type'],
                ]);
            }
        }
        for($i=0; $i<9; $i++){
            if ($space[$i]['value'] == 'true' || $space[$i]['value'] == 1) {
                CMCRFItems::create([
                    'CustNo' => $CNO,
                    'Items' => $space[$i]['data'].$space[$i]['type'],
                ]);
            }
        }
  
        return response()->json([789789], 200);
    }
    public function UpdateMeasurestate(request $request){
        $data = $request->all();
        $state = $data['state'];
        $type = $data['type'];
        if($type=="J"){
            if($state==0){
                $state = 0;
               }
            else if($state==1){
                $state = 1;
               }
            else if($state==2){
                $state = 2;
            }
           $type='01';
        }
        else{
            if($state==0){
                $state = 3;
               }
            else if($state==1){
                $state = 4;
               }
            else if($state==2){
                $state = 5;
            }
            $type='84';
        }
        $data = $data['Data'][0];
        $Memo = $data['result'];
        $OrderNo = trim($data['OrderNo']);
        
        chk::where('單號', $OrderNo)
            ->update([
                '狀態' => $state,
                'Memo' =>  $data['Memo'],
                'Date_modi' => date('Ymd'),
                '預計成交日' => ($data['EstimateDealDate'] == NULL) ? '' :  str_replace("-", "", $data['EstimateDealDate']),
                '預計成交率' => ($data['EstimateDealRate'] == NULL) ? 0 : $data['EstimateDealRate'],
            ]);
        CmMemo::where('OrderNo', $OrderNo)
        ->where('Type_', $type)
        ->update([
            'code_' => $state,
            '備註' => ($Memo == NULL) ? '' : $Memo,
            'Date_' => date('Ymd'),
            'Time_' => date('His'),
        ]);
        return response()->json($OrderNo, 200);
    }
    public function UpdateDeleteMeasureJK(request $request){
        $data = $request->all();
       // return response()->json($data, 200);
        $type = $data['type'];
        $OrderNo = $data['OrderNo'];
        if($type=="J"){
            $state = 6;
            $type='01';
         }
         else{
            $state = 7;
            $type='84';
         }
         chk::where('單號', $OrderNo)
         ->update([
             '狀態' => $state,
         ]);
        CmMemo::where('OrderNo', $OrderNo)
        ->where('Type_', $type)
        ->update([
            'code_' => $state,
            'Date_' => date('Ymd'),
            'Time_' => date('His'),
        ]);
        return response()->json($OrderNo, 200);
    }
    public function UpdateMeasureEnd(request $request){
        $data = $request->all();
        $Data = $data['Data'][0];

        CmMemo::where('CustNo', $data['CustNo'])
        ->where('Type_', 85)
        ->update([
            'Type_' => 101,
            'Date_' => date('Ymd'),
            'code_' => $Data['code_'],
            'Time_' => date('His'),
        ]);
         return response()->json($data['CustNo'], 200);
    }

    public function UpdateOrderDetail(request $request){
        $data = $request->all();
        $dataDetailitem = $data['OrderDetailitem'];
        $dataArm1 = $data['OrderDataARM1'];
        $TotalPrice = 0;

        for($i=0;$i<count($dataDetailitem);$i++){
            sod::where('ItemNo', $dataDetailitem[$i]['ItemNo'])
            ->update([
                'Ragne' => ($dataDetailitem[$i]['Ragne'] == NULL) ? '' :  $dataDetailitem[$i]['Ragne'],
                'UnitPrice' => $dataDetailitem[$i]['UnitPrice'],
                'OrderValue' => $dataDetailitem[$i]['OrderValue'],
                'SalesCode' => $dataDetailitem[$i]['SalesCode'],
                'Qty' => $dataDetailitem[$i]['Qty'],
            ]);
            $TotalPrice+=$dataDetailitem[$i]['OrderValue'];
        }
        SO::where('QuotNo', $dataDetailitem[0]['QuotNo'])
            ->update([
                'TotalValue' => $TotalPrice,
            ]);

        arm1::where('CustNo', $dataDetailitem[0]['CustNo'])
            ->where('OrderNo', $dataDetailitem[0]['QuotNo'])
            ->update([
                'OrderValue' => $TotalPrice,
                'Payment' => $TotalPrice,
                'MFI' => $TotalPrice,
                '帳款金額' => $TotalPrice,
                '實收金額' => $TotalPrice-$dataArm1['RebateValue'],  //RebateValue = Rebat - 退折讓
            ]);

        return response()->json($data, 200);
    }

}
