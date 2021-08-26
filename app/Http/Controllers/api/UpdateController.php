<?php

namespace App\Http\Controllers\api;

use App\Models\cm;
use App\Models\EM13;
use App\Models\CMCRFItems;
use App\Models\CM_接待自評;
use App\Models\CmMemo;
use App\Models\CTD;
use App\Models\chk;
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
                //'needChk',
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

        if ($UseExp[0]['value'] == 'true' || $UseExp[0]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UseExp[0]['data'].$UseExp[0]['type'],
            ]);
        }
        if ($UseExp[1]['value'] == 'true' || $UseExp[1]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UseExp[1]['data'].$UseExp[1]['type'],
            ]);
        }
        if ($UseExp[2]['value'] == 'true' || $UseExp[2]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UseExp[2]['data'].$UseExp[2]['type'],
            ]);
        }
        if ($UseExp[3]['value'] == 'true' || $UseExp[3]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UseExp[3]['data'].$UseExp[3]['type'],
            ]);
        }
        if ($UDS[0]['value'] == 'true' || $UDS[0]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UDS[0]['data'].$UDS[0]['type'],
            ]);
        }
        if ($UDS[1]['value'] == 'true' || $UDS[1]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UDS[1]['data'].$UDS[1]['type'],
            ]);
        }
        if ($UDS[2]['value'] == 'true' || $UDS[2]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UDS[2]['data'].$UDS[2]['type'],
            ]);
        }
        if ($UDS[3]['value'] == 'true' || $UDS[3]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UDS[3]['data'].$UDS[3]['type'],
            ]);
        }
        if ($UDS[4]['value'] == 'true' || $UDS[4]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UDS[4]['data'].$UDS[4]['type'],
            ]);
        }
        if ($likeStyle[0]['value'] == 'true' || $likeStyle[0]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $likeStyle[0]['data'].$likeStyle[0]['type'],
            ]);
        }
        if ($likeStyle[1]['value'] == 'true' || $likeStyle[1]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $likeStyle[1]['data'].$likeStyle[1]['type'],
            ]);
        }
        if ($likeStyle[2]['value'] == 'true' || $likeStyle[2]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $likeStyle[2]['data'].$likeStyle[2]['type'],
            ]);
        }
        if ($likeStyle[3]['value'] == 'true' || $likeStyle[3]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $likeStyle[3]['data'].$likeStyle[3]['type'],
            ]);
        }
        if ($likeStyle[4]['value'] == 'true' || $likeStyle[4]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $likeStyle[4]['data'].$likeStyle[4]['type'],
            ]);
        }
        if ($likeStyle[5]['value'] == 'true' || $likeStyle[5]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $likeStyle[5]['data'].$likeStyle[5]['type'],
            ]);
        }
        if ($space[0]['value'] == 'true' || $space[0]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[0]['data'].$space[0]['type'],
            ]);
        }
        if ($space[1]['value'] == 'true' || $space[1]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[1]['data'].$space[1]['type'],
            ]);
        }
        if ($space[2]['value'] == 'true' || $space[2]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[2]['data'].$space[2]['type'],
            ]);
        }
        if ($space[3]['value'] == 'true' || $space[3]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[3]['data'].$space[3]['type'],
            ]);
        }
        if ($space[4]['value'] == 'true' || $space[4]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[4]['data'].$space[4]['type'],
            ]);
        }
        if ($space[5]['value'] == 'true' || $space[5]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[5]['data'].$space[5]['type'],
            ]);
        }
        if ($space[6]['value'] == 'true' || $space[6]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[6]['data'].$space[6]['type'],
            ]);
        }
        if ($space[7]['value'] == 'true' || $space[7]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[7]['data'].$space[7]['type'],
            ]);
        }
        if ($space[8]['value'] == 'true' || $space[8]['value'] == 1) {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[8]['data'].$space[8]['type'],
            ]);
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

}
