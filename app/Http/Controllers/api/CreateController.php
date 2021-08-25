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

class CreateController extends Controller
{
    
    public function CreateCM(Request $request)          //CM
    {
         $data = $request->all();
        // return $data['cust'][0];
        $data = $data['cust'][0];

        $EMID='21072177';
        $doc = DB::table('EM13')->where('EMID',$EMID)->where('OFDT','00000000')->first();
        $days = date('z')+1;
        $days = sprintf("%03d", $days);
        $datanumber = DB::table('cm')->where('DataCreate',date('Ymd'))->where('門市別',$doc->DVID)->get();
        $datanumber = count($datanumber)+1;
        $datanumber = sprintf("%02d", $datanumber);
         //dd($datanumber,date('Ymd'));
        $CNO = 'C'.substr($doc->DVID, 2, 2).substr(date('Ym'), 2, 2).$days.$datanumber;  //C.部門後兩碼.年2碼.今年第幾天.當天流水號(2碼)

       // $CNO = trim($CNO);
        $DATE = date('Ymd');
        $CH_ID ='21072177';
        $EMData = DB::table('EM13')->where('EMID',$CH_ID)->where('OFDT','00000000')->first();

        $LastModify = str_replace("-", "", $data['LastModify']);
        $Woodwork = str_replace("-", "", $data['Woodwork']);
        $FavColor = str_replace("-", "", $data['FavColor']);
        $FinishDate = str_replace("-", "", $data['FinishDate']);
        $CheckInDate = str_replace("-", "", $data['CheckInDate']);
        $HouseDate = str_replace("-", "", $data['HouseDate']);

        $CName = $data['CustName'];
        if ($CName != NULL || $CName = '') {
            $CustSname = mb_substr($CName, 0, 1, 'utf-8') . '@' . mb_substr($CName, 2, strlen($CName) - 2, 'utf-8');
        } else {
            $CustSname = '';
        }

        cm::create([
                'LastModify' => ($LastModify == NULL) ? '' : $LastModify,
                'Woodwork' => ($Woodwork == NULL) ? '' : $Woodwork,
                'FavColor' => ($FavColor == NULL) ? '' : $FavColor,
                'FinishDate' => ($FinishDate == NULL) ? '' : $FinishDate,
                'CheckInDate' => ($CheckInDate == NULL) ? '' : $CheckInDate,
                'HouseDate' => ($HouseDate == NULL) ? '' : $HouseDate,
                'CustNo' => $CNO,
                'CustName' => ($CName == NULL) ? '' : $CName,
                'CustSname' => ($CustSname == NULL) ? '' : $CustSname,
                'TelDay' => ($data['TelDay'] == NULL) ? '' : $data['TelDay'],
                'Mobil' => ($data['Mobil'] == NULL) ? '' : $data['Mobil'],
                'Fax' => ($data['Fax'] == NULL) ? '' : $data['Fax'],
                'TelNight' => ($data['TelNight'] == NULL) ? '' : $data['TelNight'],
                'CusAddress' => ($data['CusAddress'] == NULL) ? '' : $data['CusAddress'],
                'FittingAdd' => ($data['FittingAdd'] == NULL) ? '' : $data['FittingAdd'],
                'CustType' => ($data['CustType'] == NULL) ? '' : $data['CustType'],
                'Gender' => ($data['Gender'] == NULL) ? '' : $data['Gender'],
                'Married' => 0,
                'Kids' => 0,
                'HouseSize' => ($data['HouseSize'] == NULL) ? '' : $data['HouseSize'],
                'BuyReason' => ($data['BuyReason'] == NULL) ? '' : $data['BuyReason'],
                'FavColor' => ($FavColor == NULL) ? '' : $FavColor,
                'Budget' => ($data['Budget'] == NULL) ? '' : $data['Budget'],
                'PorductType' => '',
                'ZipCode' => ($data['ZipCode'] == NULL) ? '' : $data['ZipCode'],
                'LastUse' => ($data['LastUse'] == NULL) ? '' : $data['LastUse'],
                'UserId' => $CH_ID,
                'Designer' => $CH_ID,
                'LastModify' => ($HouseDate == NULL) ? '' : $LastModify,
                'DataCreate' => $DATE,
                'Meno' => '',
                'Birthday' => ($data['Birthday'] == NULL) ? '' : $data['Birthday'],
                '門市別' => $EMData->DVID,
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
                'needChk'=> $data['needChk'],
                'HouseType' => ($data['HouseType'] == NULL) ? '' : $data['HouseType'],
                'Family' => ($data['Family'] == NULL) ? '' : $data['Family'],
            ]);
        return response()->json($CNO, 200);
    }
    public function CreateCmMemo(Request $request)        //CmMemo
    {
        $data = $request->all();
        //return $data['Cmemo'];
        $Cmemo = $data['Cmemo'];
        $DATE = date('Ymd');

        $CH_ID ='21072177';
        $EMData = DB::table('EM13')->where('EMID',$CH_ID)->where('OFDT','00000000')->first();
            $days = date('z')+1;
            $days = sprintf("%03d", $days);
            $datanumber = DB::table('cm')->where('DataCreate',date('Ymd'))->where('門市別',$EMData->DVID)->get();
            $datanumber = count($datanumber)+1;
            $datanumber = sprintf("%02d", $datanumber);
             //dd($datanumber,date('Ymd'));
            $CNO = 'C'.substr($EMData->DVID, 2, 2).substr(date('Ym'), 2, 2).$days.$datanumber;  //C.部門後兩碼.年2碼.今年第幾天.當天流水號(2碼)

        CmMemo::create([
                'CustNo' => $CNO,
                'Type_' => '00',
                'code_' => '0',
                '備註' => ($Cmemo[0]['memo'] == NULL) ? '' : $Cmemo[0]['memo'],
                'Date_' => $DATE,
                'UserId' => $CH_ID,
            ]);
        CmMemo::create([
                'CustNo' => $CNO,
                'Type_' => '00',
                'code_' => '1',
                '備註' => ($Cmemo[1]['memo'] == NULL) ? '' : $Cmemo[1]['memo'],
                'Date_' => $DATE,
                'UserId' => $CH_ID,
            ]);
        CmMemo::create([
                'CustNo' => $CNO,
                'Type_' => '00',
                'code_' => '2',
                '備註' => ($Cmemo[2]['memo'] == NULL) ? '' : $Cmemo[2]['memo'],
                'Date_' => $DATE,
                'UserId' => $CH_ID,
            ]);
        CmMemo::create([
            'CustNo' => $CNO,
            'Type_' => '00',
                'code_' => '3',
                '備註' => ($Cmemo[3]['memo'] == NULL) ? '' : $Cmemo[3]['memo'],
                'Date_' => $DATE,
                'UserId' => $CH_ID,
            ]);
        CmMemo::create([
                'CustNo' => $CNO,
                'Type_' => '00',
                'code_' => '4',
                '備註' => ($Cmemo[4]['memo'] == NULL) ? '' : $Cmemo[4]['memo'],
                'Date_' => $DATE,
                'UserId' => $CH_ID,
            ]);
        CmMemo::create([
            'CustNo' => $CNO,
            'Type_' => '00',
                'code_' => '5',
                '備註' => ($Cmemo[5]['memo'] == NULL) ? '' : $Cmemo[5]['memo'],
                'Date_' => $DATE,
                'UserId' => $CH_ID,
            ]);
        
        return response()->json(['message' => '456456'], 200);
    }
    public function CreateCMCRFItems(Request $request)        //CMCRFItems
    {

        $data = $request->all();
        $UDS = $data['UDS'];
        $UseExp = $data['UseExp'];
        $likeStyle = $data['likeStyle'];
        $space = $data['space'];

        $CH_ID ='21072177';
        $EMData = DB::table('EM13')->where('EMID',$CH_ID)->where('OFDT','00000000')->first();
            $days = date('z')+1;
            $days = sprintf("%03d", $days);
            $datanumber = DB::table('cm')->where('DataCreate',date('Ymd'))->where('門市別',$EMData->DVID)->get();
            $datanumber = count($datanumber)+1;
            $datanumber = sprintf("%02d", $datanumber);
             //dd($datanumber,date('Ymd'));
            $CNO = 'C'.substr($EMData->DVID, 2, 2).substr(date('Ym'), 2, 2).$days.$datanumber;  //C.部門後兩碼.年2碼.今年第幾天.當天流水號(2碼)
            $deleteold = CMCRFItems::where('CustNo', $CNO);
            $deleteold->delete();
        if ($UseExp[0]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UseExp[0]['data'].$UseExp[0]['type'],
            ]);
        }
        if ($UseExp[1]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UseExp[1]['data'].$UseExp[1]['type'],
            ]);
        }
        if ($UseExp[2]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UseExp[2]['data'].$UseExp[2]['type'],
            ]);
        }
        if ($UseExp[3]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UseExp[3]['data'].$UseExp[3]['type'],
            ]);
        }
        if ($UDS[0]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UDS[0]['data'].$UDS[0]['type'],
            ]);
        }
        if ($UDS[1]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UDS[1]['data'].$UDS[1]['type'],
            ]);
        }
        if ($UDS[2]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UDS[2]['data'].$UDS[2]['type'],
            ]);
        }
        if ($UDS[3]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UDS[3]['data'].$UDS[3]['type'],
            ]);
        }
        if ($UDS[4]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $UDS[4]['data'].$UDS[4]['type'],
            ]);
        }
        if ($likeStyle[0]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $likeStyle[0]['data'].$likeStyle[0]['type'],
            ]);
        }
        if ($likeStyle[1]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $likeStyle[1]['data'].$likeStyle[1]['type'],
            ]);
        }
        if ($likeStyle[2]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $likeStyle[2]['data'].$likeStyle[2]['type'],
            ]);
        }
        if ($likeStyle[3]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $likeStyle[3]['data'].$likeStyle[3]['type'],
            ]);
        }
        if ($likeStyle[4]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $likeStyle[4]['data'].$likeStyle[4]['type'],
            ]);
        }
        if ($likeStyle[5]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $likeStyle[5]['data'].$likeStyle[5]['type'],
            ]);
        }
        if ($space[0]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[0]['data'].$space[0]['type'],
            ]);
        }
        if ($space[1]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[1]['data'].$space[1]['type'],
            ]);
        }
        if ($space[2]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[2]['data'].$space[2]['type'],
            ]);
        }
        if ($space[3]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[3]['data'].$space[3]['type'],
            ]);
        }
        if ($space[4]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[4]['data'].$space[4]['type'],
            ]);
        }
        if ($space[5]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[5]['data'].$space[5]['type'],
            ]);
        }
        if ($space[6]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[6]['data'].$space[6]['type'],
            ]);
        }
        if ($space[7]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[7]['data'].$space[7]['type'],
            ]);
        }
        if ($space[8]['value'] == 'true') {
            CMCRFItems::create([
                'CustNo' => $CNO,
                'Items' => $space[8]['data'].$space[8]['type'],
            ]);
        }
        return response()->json([789789], 200);
    }
    public function CreateCMself(request $request)
    {
        $data = $request->all();
        //return $data['AF1'];
        $EMID='21072177';
        $doc = DB::table('EM13')->where('EMID',$EMID)->where('OFDT','00000000')->first();
        $AF=array(0,0,0,0,0,0,0);
        for($i=1;$i<=6;$i++){
            $num = 'AF'.$i;
            for($j=0;$j<3;$j++){
                if($data[$num][$j]['state']==true)
                    $AF[$i]+=$data[$num][$j]['value'];
            }
        }
        
        if($data['AF10'][0]['value']==true){
            $days = date('z')+1;
            $days = sprintf("%03d", $days);
            $datanumber = DB::table('cm')->where('DataCreate',date('Ymd'))->where('門市別',$doc->DVID)->get();
            $datanumber = count($datanumber);
            $datanumber = sprintf("%02d", $datanumber);
             //dd($datanumber,date('Ymd'));
            $CNO = 'C'.substr($doc->DVID, 2, 2).substr(date('Ym'), 2, 2).$days.$datanumber;  //C.部門後兩碼.年2碼.今年第幾天.當天流水號(2碼)
            CM_接待自評::create([
                'Store'=> $doc->DVID,
                'Date_'=> date('Ymd'),
                'UserId'=> $doc->EMID,
                'CustNo'=> $CNO,
                '品牌力'=> $AF[1],
                '迎賓加分點'=> $data['AF1'][3]['value'],
                '商品力'=> $AF[2],
                '門市展演加分點'=> $data['AF2'][3]['value'],
                '經驗力'=> $AF[3],
                '案例對焦加分點'=> $data['AF3'][3]['value'],
                '預算對焦'=> $AF[4],
                '服務流程對焦點'=> $data['AF4'][3]['value'],
                '促銷活動'=> $AF[5],
                '促銷活動對焦點'=> $data['AF5'][3]['value'],
                '異議排除'=> $AF[6],
                '異議排除對焦點'=> $data['AF6'][3]['value'],
                '店長協助'=> $data['AF7'][0]['value'],
                'LINE'=> $data['AF8'][0]['value'],
                'Google'=> $data['AF9'][0]['value'],
                'datetime_'=> date('Y-m-d H:i:s'),
            ]); 
            CmMemo::create([
                'CustNo' => $CNO,
                'Type_' => '100',
                    'code_' => '',
                    '備註' => ($data['AF7'][0]['memo'] == NULL) ? '' : $data['AF7'][0]['memo'],
                    'Date_' => date('Ymd'),
                    'UserId' => $doc->EMID,
                ]); 
            return response()->json([$CNO], 200);
        }
        else{
            $datanumber = DB::table('CM_接待自評')->where('UserId',$EMID)->where('Date_','LIKE','20'.substr(date('Ym'), 2, 4).'%')->get();
            $datanumber = count($datanumber)+1;
            $datanumber = sprintf("%03d", $datanumber);
            $CNO = 'C'.substr($doc->EMID, 4, 4).substr(date('Ym'), 2, 4).$datanumber;  //C.員編4碼.年月4碼.流水號
            CM_接待自評::create([
                'Store'=> $doc->DVID,
                'Date_'=> date('Ymd'),
                'UserId'=> $doc->EMID,
                'CustNo'=> $CNO,
                '品牌力'=> $AF[1],
                '迎賓加分點'=> $data['AF1'][3]['value'],
                '商品力'=> $AF[2],
                '門市展演加分點'=> $data['AF2'][3]['value'],
                '經驗力'=> $AF[3],
                '案例對焦加分點'=> $data['AF3'][3]['value'],
                '預算對焦'=> $AF[4],
                '服務流程對焦點'=> $data['AF4'][3]['value'],
                '促銷活動'=> $AF[5],
                '促銷活動對焦點'=> $data['AF5'][3]['value'],
                '異議排除'=> $AF[6],
                '異議排除對焦點'=> $data['AF6'][3]['value'],
                '店長協助'=> $data['AF7'][0]['value'],
                'LINE'=> $data['AF8'][0]['value'],
                'Google'=> $data['AF9'][0]['value'],
                'datetime_'=> date('Y-m-d H:i:s'),
            ]);
            CmMemo::create([
                'CustNo' => $CNO,
                'Type_' => '100',
                    'code_' => '',
                    '備註' => ($data['AF7'][0]['memo'] == NULL) ? '' : $data['AF7'][0]['memo'],
                    'Date_' => date('Ymd'),
                    'UserId' => $doc->EMID,
                ]); 
            return response()->json("", 200);
        }      
      }

    public function CreateMeasure(request $request)
    {
        $data = $request->all();
        if($data['type']=="J"){
            $data = $data['Data'][0];
            //return response()->json($data, 200);
            $days = date('z')+1;
            $days = sprintf("%03d", $days);
            $datanumber = DB::table('chk')->where('單號','LIKE', 'J'.'%')->where('Date_add',date('Ymd'))->where('門市別_StoreNo',$data['Dept'])->get();
            $datanumber = count($datanumber)+1;
            $datanumber = sprintf("%02d", $datanumber);
                //dd($datanumber,date('Ymd'));
                $CNO = 'J'.substr($data['Dept'], 2, 2).substr(date('Ym'), 2, 2).$days.$datanumber;  //C.部門後兩碼.年2碼.今年第幾天.當天流水號(2碼)
             //   return response()->json($data , 200);
            chk::create([
                '單號' => $CNO,
                '客戶號' => ($data['CustNo'] == NULL) ? '' : $data['CustNo'],
                '預定日期' => ($data['ReserveDate'] == NULL) ? '' :  str_replace("-", "", $data['ReserveDate']),
                '時間' => ($data['Time'] == NULL) ? '' : str_replace(":", "", $data['Time'].'00'),
                '完工日期' => '000000',
                '處理碼' => '',
                '丈量人員' => ($data['MeasureMember'] == NULL) ? '' : $data['MeasureMember'],
                '丈量地址' => '',
                'Memo' => ($data['Memo'] == NULL) ? '' : $data['Memo'],
                'Date_add' => date('Ymd'),
                'UserID' => ($data['MeasureMember'] == NULL) ? '' : $data['MeasureMember'],
                '門市別_StoreNo' => ($data['Dept'] == NULL) ? '' : $data['Dept'],
                'Date_modi' => date('Ymd'),
                '臥室數' => 0,
                '廚房數' => 0,
                'bathroom' => 0,
                '狀態' => 0,
                'time_add' => date('His'),
                '預計成交日' => ($data['EstimateDealDate'] == NULL) ? '' : $data['EstimateDealDate'],
                '預計成交率' => ($data['EstimateDealRate'] == NULL) ? '' : $data['EstimateDealRate'],
                ]); 
                CmMemo::create([
                   'CustNo' => ($data['CustNo'] == NULL) ? '' : $data['CustNo'],
                   'Type_' => '01',
                   'OrderNo' => $CNO,
                   'code_' => 0,
                   '備註' => '',
                   'Date_' => date('Ymd'),
                   'UserId' => ($data['MeasureMember'] == NULL) ? '' : $data['MeasureMember'],
                ]); 
                $newData = DB::table('chk')->where('單號',$CNO)->where('Date_add',date('Ymd'))->where('門市別_StoreNo',$data['Dept'])->first();
                return response()->json($newData , 200); 
        }     
        else if($data['type']=="K"){
                $S = $data['S']==1;
                $data = $data['Data'][0];
                $CountK=DB::table('chk')->where('單號','LIKE', 'K'.'%')->where('客戶號',$data['CustNo'])->where('狀態',3)->where('門市別_StoreNo',$data['Dept'])->first();

                if($CountK==NULL||$S==1){          //無看圖未完成
                    $days = date('z')+1;
                    $days = sprintf("%03d", $days);
                    $datanumber = DB::table('chk')->where('單號','LIKE', 'K'.'%')->where('Date_add',date('Ymd'))->where('門市別_StoreNo',$data['Dept'])->get();
                    $datanumber = count($datanumber)+1;
                    $datanumber = sprintf("%02d", $datanumber);
                        //dd($datanumber,date('Ymd'));
                    $CNO = 'K'.substr($data['Dept'], 2, 2).substr(date('Ym'), 2, 2).$days.$datanumber;  //C.部門後兩碼.年2碼.今年第幾天.當天流水號(2碼)
                    //   return response()->json($data , 200);
                    chk::create([
                        '單號' => $CNO,
                        '客戶號' => ($data['CustNo'] == NULL) ? '' : $data['CustNo'],
                        '預定日期' => ($data['ReserveDate'] == NULL) ? '' :  str_replace("-", "", $data['ReserveDate']),
                        '時間' => ($data['Time'] == NULL) ? '' : str_replace(":", "", $data['Time'].'00'),
                        '完工日期' => '000000',
                        '處理碼' => '',
                        '丈量人員' => ($data['MeasureMember'] == NULL) ? '' : $data['MeasureMember'],
                        '丈量地址' => '',
                        'Memo' => ($data['Memo'] == NULL) ? '' : $data['Memo'],
                        'Date_add' => date('Ymd'),
                        'UserID' => ($data['MeasureMember'] == NULL) ? '' : $data['MeasureMember'],
                        '門市別_StoreNo' => ($data['Dept'] == NULL) ? '' : $data['Dept'],
                        'Date_modi' => date('Ymd'),
                        '臥室數' => 0,
                        '廚房數' => 0,
                        'bathroom' => 0,
                        '狀態' => 3,
                        'time_add' => date('His'),
                        '預計成交日' => ($data['EstimateDealDate'] == NULL) ? '' :  str_replace("-", "", $data['EstimateDealDate']),
                        '預計成交率' => ($data['EstimateDealRate'] == NULL) ? 0 : $data['EstimateDealRate'],
                        ]); 
                    CmMemo::create([
                        'CustNo' => ($data['CustNo'] == NULL) ? '' : $data['CustNo'],
                        'Type_' => '84',
                        'OrderNo' => $CNO,
                        'code_' => 3,
                        '備註' => '',
                        'Date_' => date('Ymd'),
                        'UserId' => ($data['MeasureMember'] == NULL) ? '' : $data['MeasureMember'],
                        ]); 
                }
                else{               //有看圖未完成，更新
                    $CNO =  trim($CountK->單號);
                    chk::where('單號', $CNO)
                    ->update([
                        '預定日期' => ($data['ReserveDate'] == NULL) ? '' :  str_replace("-", "", $data['ReserveDate']),
                        '時間' => ($data['Time'] == NULL) ? '' : str_replace(":", "", $data['Time'].'00'),
                        'Memo' => ($data['Memo'] == NULL) ? '' : $data['Memo'],
                        'Date_modi' => date('Ymd'),
                        '丈量人員' => ($data['MeasureMember'] == NULL) ? '' : $data['MeasureMember'],
                        'UserID' => ($data['MeasureMember'] == NULL) ? '' : $data['MeasureMember'],
                        'time_add' => date('His'),
                        '預計成交日' => ($data['EstimateDealDate'] == NULL) ? '' :  str_replace("-", "", $data['EstimateDealDate']),
                        '預計成交率' => ($data['EstimateDealRate'] == NULL) ? 0 : $data['EstimateDealRate'],
                    ]);
                    CmMemo::where('OrderNo', $CNO)
                    ->where('Type_', '84')
                    ->update([
                        'UserId' => ($data['MeasureMember'] == NULL) ? '' : $data['MeasureMember'],
                        'Date_' => date('Ymd'),
                        'Time_' => date('His'),
                    ]);
                }
               
        }    
        return response()->json($CNO , 200); 
    }
    public function CreateMeasureEnd(request $request)
    {
        $data = $request->all();
        $Data = $data['Data'][0];
        //return response()->json($data, 200);
        CmMemo::create([
            'CustNo' => ($data['CustNo'] == NULL) ? '' : $data['CustNo'],
            'Type_' => '85',
            'code_' => $Data['code_'],
            '備註' => $Data['memo'],
            'Date_' => date('Ymd'),
            'UserId' => '21072177',
         ]); 

         return response()->json($data['CustNo'], 200);
    }
}
