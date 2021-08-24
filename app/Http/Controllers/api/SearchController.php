<?php

namespace App\Http\Controllers\api;

use App\Models\cm;
use App\Models\EM13;
use App\Models\CMCRFItems;
use App\Models\CM_接待自評;
use App\Models\CmMemo;
use App\Models\CTD;
use App\Models\zip;
use App\Models\chk;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use PDO;
use Session;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CMCRFItems = CMCRFItems::all();
        return response()->json(['CMCRFItems' => $CMCRFItems],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchCMname($CName){
        $searchname = mb_substr($CName,0,1,"utf-8");
        $data = cm::where('CustName','LIKE', $searchname.'%')->get();
        return response()->json(['CM' => $data],200);
    }
    public function searchCM($CNO)          //CM-Data、月曆格式轉換、CTD
    {
        $useCM = cm::where('CustNo',trim($CNO))->first();
        $FinishDate='';$CheckInDate='';$HouseDate='';$FavColor='';$Woodwork='';$LastModify='';
        $CusAddressC='';$CusAddressS='';$FittingAddC='';$FittingAddS='';
        if($useCM == NULL){
            $useCM = new cm;
        }  
        else{
            if($useCM->CusAddress != NULL){
                $length = mb_strlen($useCM->CusAddress,"utf-8");
                $CusAddressC= mb_substr($useCM->CusAddress,0,6,"utf-8");
                $CusAddressS= mb_substr($useCM->CusAddress,6,$length-6,"utf-8");
            }
            if($useCM->FittingAdd != NULL){
                $length = mb_strlen($useCM->FittingAdd,"utf-8");
                $FittingAddC= mb_substr($useCM->FittingAdd,0,6,"utf-8");
                $FittingAddS= mb_substr($useCM->FittingAdd,6,$length-6,"utf-8");
            }
            if($useCM->FinishDate != NULL){
                $FinishDate= substr($useCM->FinishDate, 0, 4)."-".substr($useCM->FinishDate, 4, 2)."-".substr($useCM->FinishDate, 6, 2);  
            }
            if($useCM->CheckInDate != NULL){
                $CheckInDate= substr($useCM->CheckInDate, 0, 4)."-".substr($useCM->CheckInDate, 4, 2)."-".substr($useCM->CheckInDate, 6, 2);  
            }
            if($useCM->HouseDate != NULL){
                $HouseDate= substr($useCM->HouseDate, 0, 4)."-".substr($useCM->HouseDate, 4, 2)."-".substr($useCM->HouseDate, 6, 2);  
            }
            if($useCM->FavColor != NULL){
                $FavColor= substr($useCM->FavColor, 0, 4)."-".substr($useCM->FavColor, 4, 2)."-".substr($useCM->FavColor, 6, 2);  
            }
            if($useCM->Woodwork != NULL){
                $Woodwork= substr($useCM->Woodwork, 0, 4)."-".substr($useCM->Woodwork, 4, 2)."-".substr($useCM->Woodwork, 6, 2);  
            }
            if($useCM->LastModify != NULL){
                $LastModify= substr($useCM->LastModify, 0, 4)."-".substr($useCM->LastModify, 4, 2)."-".substr($useCM->LastModify, 6, 2);  
            }
        }
        // return response()->json([
        // 'cm' => $useCM,
        // 'LastModify' => $LastModify , 'Woodwork' => $Woodwork , 'FavColor' => $FavColor ,'FinishDate' => $FinishDate , 'CheckInDate'=> $CheckInDate ,'HouseDate' =>$HouseDate,
        // 'CustType' => $CustType,'BuyReason' => $BuyReason,'Family' => $Family,'HouseType' => $HouseType,
        // 'CustTypeN' => $CustTypeN,'BuyReasonN' => $BuyReasonN,'FamilyN' => $FamilyN,'HouseTypeN' => $HouseTypeN],200);
        return response()->json([
             $useCM,
            'LastModify' => $LastModify , 'Woodwork' => $Woodwork , 'FavColor' => $FavColor ,'FinishDate' => $FinishDate , 'CheckInDate'=> $CheckInDate ,'HouseDate' =>$HouseDate,
            'CusAddressC' => $CusAddressC,'CusAddressS'=>$CusAddressS,'FittingAddC'=>$FittingAddC,'FittingAddS'=>$FittingAddS],200);
    }
    public function searchCTD($codename)        //CTD
    {
        if($codename=="客來源"){
            $data  = CTD::where('codename','客來源')->where('Reserve1',1)->get();   
        }    
        if($codename=="買原因"){
            $data  = CTD::where('codename','買原因')->get();
        }    
        if($codename=="成員組合"){
            $data  = CTD::where('codename','成員組合')->get();
        }    
        if($codename=="屋型"){
            $data  = CTD::where('codename','屋型')->get();
        }    

        foreach($data as $CTD){
            $CTD->codeindex=trim($CTD->codeindex);
        }

        return response()->json($data,200);
    }
    public function searchCmMemo($CNO,$MemoType)        //CmMemo
    {
        $MemoType = $MemoType." ";
        $memonum =array('0','0','0','0','0','0');
        $useCM = cm::where('CustNo',trim($CNO))->first();
        $data = CmMemo::where('CustNo',trim($CNO))->where('Type_',$MemoType)->get(['CmMemo.*','備註 as memo']);

        foreach($data as $CmMemo){
                $memonum[trim($CmMemo->code_)]=1;
        } 
       
        for($i=0;$i<6;$i++){
            if($memonum[$i]==0){
                CmMemo::create([
                    'CustNo' => $useCM->CustNo,
                    'Type_' => '00',
                    'code_' => $i,
                    '備註' => '',
                    'Date_' =>  date('Ymd'),
                    'UserId' => $useCM->UserId,
                    'Items' => 0,
                ]);
            }
        }
        $data = CmMemo::where('CustNo',trim($CNO))->where('Type_',$MemoType)->where('Items',0)->get(['CmMemo.*','備註 as memo']);

        foreach($data as $CmMemo){
            if($CmMemo->備註 ==  NULL)$CmMemo->備註 =  '';
        }
        return response()->json($data,200);
    }
    public function searchCMCRFItems($CNO)        //CMCRFItems
    {
        $CItems = CMCRFItems::where('CustNo',trim($CNO))->get();
        $UseExp=array('','','','');
        $UDS=array('','','','','');
        $likeStyle=array('','','','','','');
        $space=array('','','','','','','','','');

        foreach($CItems as $Items){
            if($Items->Items!=NULL){
                if($Items->Items == '使用過系統家具|使用經驗'){
                    $UseExp[0] = 1;
                }
                if($Items->Items == '曾有裝修經驗|使用經驗'){
                    $UseExp[1] = 1;
                }
                if($Items->Items == '使用過木地板|使用經驗'){
                    $UseExp[2] = 1;
                }
                if($Items->Items == '購買過沙發|使用經驗'){
                    $UseExp[3] = 1;
                }
                if($Items->Items == '歐德|同業了解'){
                    $UDS[0] = 1;
                }
                if($Items->Items == '綠的傢俱|同業了解'){
                    $UDS[1] = 1;
                }
                if($Items->Items == '艾菲爾|同業了解'){
                    $UDS[2] = 1;
                }
                if($Items->Items == '室內設計師|同業了解'){
                    $UDS[3] = 1;
                }
                if($Items->Items == '其他|同業了解'){
                    $UDS[4] = 1;
                }
                if($Items->Items == '鄉村風|喜好風格'){
                    $likeStyle[0] = 1;
                }
                if($Items->Items == '現代風|喜好風格'){
                    $likeStyle[1] = 1;
                }
                if($Items->Items == '工業風|喜好風格'){
                    $likeStyle[2] = 1;
                }
                if($Items->Items == '北歐風|喜好風格'){
                    $likeStyle[3] = 1;
                }
                if($Items->Items == '古典風|喜好風格'){
                    $likeStyle[4] = 1;
                }
                if($Items->Items == '其他|喜好風格'){
                    $likeStyle[5] = 1;
                }
                if($Items->Items == '全室|規劃空間'){
                    $space[0] = 1;
                }
                if($Items->Items == '客廳|規劃空間'){
                    $space[1] = 1;
                }
                if($Items->Items == '更衣室|規劃空間'){
                    $space[2] = 1;
                }
                if($Items->Items == '廚房|規劃空間'){
                    $space[3] = 1;
                }
                if($Items->Items == '餐廳|規劃空間'){
                    $space[4] = 1;
                }
                if($Items->Items == '書房|規劃空間'){
                    $space[5] = 1;
                }
                if($Items->Items == '玄關|規劃空間'){
                    $space[6] = 1;
                }
                if($Items->Items == '臥室|規劃空間'){
                    $space[7] = 1;
                }
                if($Items->Items == '其他|規劃空間'){
                    $space[8] = 1;
                }
            }
        }
        return response()->json([$UseExp,$UDS,$likeStyle,$space],200);
    }
    public function searchPD()
    {
        //$EMID = Session::get('EMID');
       // $EM13 = EM13::where('EMID','=', $EMID)->where('OFDT','=','00000000')->first();
        return response()->json(['YA' => Auth::user()],200);
    }
    public function searchaddress($street)
    {
        //找Zip
        $length = mb_strlen($street, "utf-8");
        if($length>=6){          
            $city= mb_substr($street,0,3,"utf-8");
            $area= mb_substr($street,3,3,"utf-8");
            $address = zip::where('縣市',$city)->where('區鄉鎮市',$area)->first();
            $zip = substr($address->區號,0,3);
            return response()->json($zip,200);
        }
        else{
        //傳資料
            if($street=="empty"){
                $address  = DB::select('SELECT DISTINCT 縣市,區鄉鎮市,街路 FROM zip'); 
                foreach($address as $data){
                    $data->街路=trim($data->街路);
                }
            }
            else{
                $str='%'.$street.'%';
                $address = DB::select("SELECT DISTINCT 縣市,區鄉鎮市,街路 FROM zip WHERE 街路 LIKE '".$str."'");
                if($address==NULL){
                    $address  = DB::select('SELECT DISTINCT 縣市,區鄉鎮市,街路 FROM zip'); 
                }
                foreach($address as $data){
                    $data->街路=trim($data->街路);
                }
            }
            return response()->json($address,200);
        } 
    }
    public function searchCHK($CNO)
    {
        //$data = chk::where('客戶號',$CNO)->orderby('狀態','asc')->get();
        $dataJ = chk::where('客戶號',$CNO)->where('單號','LIKE', 'J'.'%')->where('狀態', '<', 3)->orderby('Date_add','asc')->get(['chk.*','Memo as result']);
        $Jstate = 0;
        foreach($dataJ as $data){
            $Memo = CmMemo::where('OrderNo',trim($data->單號))->where('Type_','01')->where('code_',$data->狀態)->first();     
            $data->result =  ($Memo == NULL) ? '' : $Memo['備註'];
            $YMD = $data->預定日期;
            $YMDE = $data->預計成交日;
            $HMS = $data->時間;
            $data->預定日期 = substr($YMD, 0, 4)."/".substr($YMD, 4, 2)."/".substr($YMD, 6, 2);
            $data->預計成交日 = substr($YMDE, 0, 4)."-".substr($YMDE, 4, 2)."-".substr($YMDE, 6, 2);
            $data->時間 = substr($HMS, 0, 2).":".substr($HMS, 2, 2);
            if($data->狀態==0)$Jstate=1;
        }
        $dataK = chk::where('客戶號',$CNO)->where('單號','LIKE', 'K'.'%')->where('狀態', '<', 7)->orderby('Date_add','asc')->get(['chk.*','Memo as result']);
        $Kstate = 0;
          foreach($dataK as $data){
            $Memo = CmMemo::where('OrderNo',trim($data->單號))->where('Type_','84')->where('code_',$data->狀態)->first();
            $data->result= ($Memo == NULL) ? '' : $Memo['備註'];
            $YMD = $data->預定日期;
            $YMDE = $data->預計成交日;
            $HMS = $data->時間;
            $data->預定日期 = substr($YMD, 0, 4)."/".substr($YMD, 4, 2)."/".substr($YMD, 6, 2);
            $data->預計成交日 = substr($YMDE, 0, 4)."-".substr($YMDE, 4, 2)."-".substr($YMDE, 6, 2);
            $data->時間 = substr($HMS, 0, 2).":".substr($HMS, 2, 2);
            if($data->狀態==3)$Kstate=1;
        } 
        return response()->json([$dataJ,$dataK,$Jstate,$Kstate],200);
    }

    public function searchUserDeptMember($DVID)
    {
        $UserDept = EM13::where('DVID','=', $DVID)->where('OFDT','=','00000000')->get();
        return response()->json($UserDept,200);
    }
}
