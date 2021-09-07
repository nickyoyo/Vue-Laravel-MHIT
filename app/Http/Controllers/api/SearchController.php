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
use App\Models\SO;
use App\Models\sod;
use App\Models\im;
use App\Models\vm;
use App\Models\po;
use App\Models\FINST;
use App\Models\arm1;
use App\Models\ChangePriceRecord;
use App\Models\SD_Cost_Price;
use App\Models\psf;
use App\Models\SF002_Cost_Price;
use App\Models\SF002_Psf;
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
    public function searchCMAll(){
        $data = cm::where('CustNo','LIKE', 'C'.'%')->where('門市別','1000')->get();
        foreach($data as $list){
            $EM = EM13::where('EMID','=', $list->UserId)->first();
            $list->UserId = $EM;
            $list->DataCreate = substr($list->DataCreate, 0, 4)."/".substr($list->DataCreate, 4, 2)."/".substr($list->DataCreate, 6, 2);  
        }
        return response()->json($data,200);
    }
    public function searchCM($CNO)          //CM-Data、月曆格式轉換、CTD
    {
        $useCM = cm::where('CustNo',trim($CNO))->first();
       
        $FinishDate='';$CheckInDate='';$HouseDate='';$FavColor='';$Woodwork='';$LastModify='';
        $CusAddressC='';$CusAddressS='';$FittingAddC='';$FittingAddS='';$msg ='';
        if($useCM == NULL){
            $useCM = new cm;
            return response()->json(['msg' => '此客編號不存在'],200);
        }  
        else{
            if($useCM->needChk == '1')$useCM->needChk=true;
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
            'CusAddressC' => $CusAddressC,'CusAddressS'=>$CusAddressS,'FittingAddC'=>$FittingAddC,'FittingAddS'=>$FittingAddS,'msg' => ''],200);
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
        if($codename=="色號"){
            $data  = CTD::where('codename','門板色')->orderby('codeindex','asc')->take(100)->get();
        }    
      
        foreach($data as $CTD){
            $CTD->codeindex=trim($CTD->codeindex);
        }

        return response()->json($data,200);
    }
    
    public function searchColorNoAll() {
        $data  = CTD::where('codename','門板色')->where('codetype',11)->orderby('Reserve4','asc')->take(100)->get();
        return response()->json($data,200);
    }
    
    public function searchColorNo($Colorselect,$PartNo)       
    {
        $VMcode = substr($PartNo,0,2);
        if($Colorselect=='X'){
            $data  = CTD::where('Reserve4','LIKE', $VMcode.'%')->orderby('codeindex','asc')->get();
        }
        else{ 
            $data  = CTD::where('Reserve4','LIKE', $VMcode.'%')->where('codeindex','LIKE',$Colorselect.'%')->orderby('codeindex','asc')->take(100)->get();
        }      
        return response()->json($data,200);
    }

    public function searchColorNoType($Colorselect,$PartNo)        
    {
        $VMcode = substr($PartNo,0,2);
        $data  = CTD::where('codeindex',$Colorselect)->where('Reserve4','LIKE', $VMcode.'%')->orderby('codeindex','asc')->first();
        
        if($data!=NULL){
            $data->codeindex = trim($data->codeindex);
            $data->Reserve4 = trim($data->Reserve4);
            return response()->json([$data,1],200);  
        }
        return response()->json([$data,0],200);  
    }

    public function searchPartNo($SKU)        
    {
        if($SKU=='XXXXX'){
            $data  = im::where('SKU','LIKE', 'H%')->take(200)->get();
        }
        else{
        $data  = im::where('SKU','LIKE', $SKU.'%')->take(200)->get();
         
            foreach($data as $PartNo){
                $PartNo->FullPrice=(int)$PartNo->FullPrice;
                $PartNo->SKU = trim($PartNo->SKU);

                $vm  = vm::where('SuppNo',$PartNo->SupplierNo)->first();
                $vm->SuppNo = trim($vm->SuppNo);
                $vm->LastTrans = trim($vm->LastTrans);
                $PartNo->SupplierNo = $vm;
            }
        }
            return response()->json($data,200);        
    }
    public function searchTypePartNo($SKU)        
    {
        $data  = im::where('SKU',$SKU)->first();
        
        if($data!=NULL){
            $data->FullPrice=(int)$data->FullPrice;
            $data->SKU = trim($data->SKU);

            $vm  = vm::where('SuppNo',$data->SupplierNo)->first();
            $vm->SuppNo = trim($vm->SuppNo);
            $vm->LastTrans = trim($vm->LastTrans);
            $data->SupplierNo = $vm;

            return response()->json([$data,1],200);  
        }
        return response()->json([$data,0],200);  
             
    }


    public function searchCTDDesc($codename,$codeindex)        //CTD
    {
        if($codename == "訂單類"){
            $data = CTD::where('codename','訂單類')->where('codeindex',$codeindex)->first();  
            $data->codeindex=trim($data->codeindex); 
        }      
        return response()->json($data,200);
    }

    public function searchCmMemo($CNO,$MemoType)        //CmMemo
    {
        if($MemoType=='85'){
            $data = CmMemo::where('CustNo',trim($CNO))->where('Type_',$MemoType)->first(['CmMemo.*','備註 as memo']);
            if($data != NULL){
                $data->code_ = trim($data->code_);
                $data->Type_ = trim($data->Type_);
            }         
            return response()->json($data,200);
        }
        if($MemoType=='02'){
            $data = CmMemo::where('OrderNo',trim($CNO))->where('Type_',$MemoType)->first(['CmMemo.*','備註 as memo']);
            if($data != NULL){
                $data->code_ = trim($data->code_);
                $data->Type_ = trim($data->Type_);
            }         
            return response()->json($data,200);
        }

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
                    $UseExp[0] = true;
                }
                if($Items->Items == '曾有裝修經驗|使用經驗'){
                    $UseExp[1] = true;
                }
                if($Items->Items == '使用過木地板|使用經驗'){
                    $UseExp[2] = true;
                }
                if($Items->Items == '購買過沙發|使用經驗'){
                    $UseExp[3] = true;
                }
                if($Items->Items == '歐德|同業了解'){
                    $UDS[0] = true;
                }
                if($Items->Items == '綠的傢俱|同業了解'){
                    $UDS[1] = true;
                }
                if($Items->Items == '艾菲爾|同業了解'){
                    $UDS[2] = true;
                }
                if($Items->Items == '室內設計師|同業了解'){
                    $UDS[3] = true;
                }
                if($Items->Items == '其他|同業了解'){
                    $UDS[4] = true;
                }
                if($Items->Items == '鄉村風|喜好風格'){
                    $likeStyle[0] = true;
                }
                if($Items->Items == '現代風|喜好風格'){
                    $likeStyle[1] = true;
                }
                if($Items->Items == '工業風|喜好風格'){
                    $likeStyle[2] = true;
                }
                if($Items->Items == '北歐風|喜好風格'){
                    $likeStyle[3] = true;
                }
                if($Items->Items == '古典風|喜好風格'){
                    $likeStyle[4] = true;
                }
                if($Items->Items == '其他|喜好風格'){
                    $likeStyle[5] = true;
                }
                if($Items->Items == '全室|規劃空間'){
                    $space[0] = true;
                }
                if($Items->Items == '客廳|規劃空間'){
                    $space[1] = true;
                }
                if($Items->Items == '更衣室|規劃空間'){
                    $space[2] = true;
                }
                if($Items->Items == '廚房|規劃空間'){
                    $space[3] = true;
                }
                if($Items->Items == '餐廳|規劃空間'){
                    $space[4] = true;
                }
                if($Items->Items == '書房|規劃空間'){
                    $space[5] = true;
                }
                if($Items->Items == '玄關|規劃空間'){
                    $space[6] = true;
                }
                if($Items->Items == '臥室|規劃空間'){
                    $space[7] = true;
                }
                if($Items->Items == '其他|規劃空間'){
                    $space[8] = true;
                }
            }
        }
        return response()->json([$UseExp,$UDS,$likeStyle,$space],200);
    }
    public function searchPD($EMID)
    {

        $data = EM13::where('EMID','=', $EMID)->where('OFDT','=','00000000')->first();
        return response()->json($data,200);
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

    public function searchOrder($CNO)       
    {
        $data = SO::where('CusNo',trim($CNO))->where('QuotNo','LIKE', 'S'.'%')->where('OrderDate','>','00000000')->orderby('QuotNo','asc')->get();
        if(count($data) == 0){
            return response()->json(['msg' => '此客編號不存在'],200);
        }  
        foreach($data as $list){
            $list->TotalValue=(int)$list->TotalValue;
        }
      
        return response()->json([$data,'msg' => ''],200);
    }

    public function searchOrderdata($QNO)       
    {
        $data = SO::where('QuotNo',trim($QNO))->where('OrderDate','>','00000000')->orderby('QuotNo','asc')->get();
        foreach($data as $list){
            $list->TotalValue=(int)$list->TotalValue;
            $list->exwork = (int)$list->exwork;  
            $list->OrderDate = ($list->OrderDate > '00000000') ? substr($list->OrderDate, 0, 4)."/".substr($list->OrderDate, 4, 2)."/".substr($list->OrderDate, 6, 2) : '';  
            $list->QuotDate = ($list->QuotDate > '00000000') ? substr($list->QuotDate, 0, 4)."/".substr($list->QuotDate, 4, 2)."/".substr($list->QuotDate, 6, 2) : '';  
            $list->RequireDate = ($list->RequireDate > '00000000') ? substr($list->RequireDate, 0, 4)."/".substr($list->RequireDate, 4, 2)."/".substr($list->RequireDate, 6, 2) : '';  
            $list->PromotionPeriod = ($list->PromotionPeriod > '00000000') ? substr($list->PromotionPeriod, 0, 4)."/".substr($list->PromotionPeriod, 4, 2)."/".substr($list->PromotionPeriod, 6, 2) : '';  
            $list->ExpireDate  = ($list->ExpireDate  > '00000000') ? substr($list->ExpireDate , 0, 4)."/".substr($list->ExpireDate , 4, 2)."/".substr($list->ExpireDate , 6, 2) : '';  
            $list->DispatchDate = ($list->DispatchDate > '00000000') ? substr($list->DispatchDate, 0, 4)."/".substr($list->DispatchDate, 4, 2)."/".substr($list->DispatchDate, 6, 2) : '';  
            $list->ClearDate = ($list->ClearDate > '00000000') ? substr($list->ClearDate, 0, 4)."/".substr($list->ClearDate, 4, 2)."/".substr($list->ClearDate, 6, 2) : '';  
            $list->PickingDate = ($list->PickingDate > '00000000') ? substr($list->PickingDate, 0, 4)."/".substr($list->PickingDate, 4, 2)."/".substr($list->PickingDate, 6, 2) : '';  
            $list->AppDate = ( $list->AppDate > '00000000') ? substr( $list->AppDate, 0, 4)."/".substr( $list->AppDate, 4, 2)."/".substr( $list->AppDate, 6, 2) : '';  
            $list->ProfitDate = ($list->ProfitDate > '00000000') ? substr($list->ProfitDate, 0, 4)."/".substr($list->ProfitDate, 4, 2)."/".substr($list->ProfitDate, 6, 2) : '';  
            
        }
      
        return response()->json($data,200);
    }

    public function searchOrderDetailitem($QNO)        
    {
        $data = sod::where('QuotNo',trim($QNO))->get(['sod.*','UserID as Ordermember','SalesCode as SalesCodeData','temp as poCheck','Ragne as RangeName']);

        foreach($data as $list){
            $list->UnitPrice = (int)$list->UnitPrice;
            $list->OrderValue = (int)$list->OrderValue; 
            $member = EM13::where('EMID','=', $list->UserID)->first();
            $list->Ordermember= $member->EMME;

            $SalesCodeData = im::where('SKU','=', $list->SalesCode)->first();
            $list->SalesCodeData = $SalesCodeData;
            $list->OrderDate = substr($list->OrderDate, 0, 4)."/".substr($list->OrderDate, 4, 2)."/".substr($list->OrderDate, 6, 2);  
            $list->DispatchDate = substr($list->DispatchDate, 0, 4)."/".substr($list->DispatchDate, 4, 2)."/".substr($list->DispatchDate, 6, 2);  

            $SupplierNo = vm::where('SuppNo','=', $list->SalesCodeData->SupplierNo)->first();
            $SupplierNo->LastTrans = trim($SupplierNo->LastTrans);
            $SupplierNo->SuppNo = trim($SupplierNo->SuppNo);
            $list->SalesCodeData->SupplierNo = $SupplierNo;

            $doorcolor = CTD::where('codename','門板色')->where('codeindex',$list->Ragne)->first();  
            if($doorcolor==NULL){
                $list->RangeName="";
            }
            else{
                $list->RangeName = $doorcolor->codeDesc;
            }    

            $list->poCheck=0;
            $poCh = po::where('QuotNo',trim($QNO))->get();
            if(count($poCh)>0){
                $list->poCheck=1;
            }
        }

        return response()->json($data,200);
    }

    public function searchOrderitemPO($QNO)        
    {
        $getorder=0;
        $data = po::where('QuotNo',trim($QNO))->get();
        if(count($data)>0){
            $getorder=1;
        }

        return response()->json($getorder,200);
    }

    public function searchOrderFINST($QNO)
    {
        $data = FINST::where('訂單編號',trim($QNO))->first(['FINST.*','確定出貨日 as SuresendDate','檢核日 as CheckDate','安裝日 as SetDate','拆除日 as RemoveDate','運送日 as TransDate']);
       
        if($data->SuresendDate > '00000000'){
            $data->SuresendDate = substr($data->SuresendDate, 0, 4)."/".substr($data->SuresendDate, 4, 2)."/".substr($data->SuresendDate, 6, 2);  
        }
        else{
            $data->SuresendDate='';
        }
        if($data->CheckDate > '00000000'){
            $data->CheckDate = substr($data->CheckDate, 0, 4)."/".substr($data->CheckDate, 4, 2)."/".substr($data->CheckDate, 6, 2);  
        }
        else{
            $data->CheckDate='';
        }
        if($data->SetDate > '00000000'){
            $data->SetDate = substr($data->SetDate, 0, 4)."/".substr($data->SetDate, 4, 2)."/".substr($data->SetDate, 6, 2);  
        }
        else{
            $data->SetDate='';
        }
        if($data->RemoveDate > '00000000'){
            $data->RemoveDate = substr($data->RemoveDate, 0, 4)."/".substr($data->RemoveDate, 4, 2)."/".substr($data->RemoveDate, 6, 2);  
        }
        else{
            $data->RemoveDate='';
        }
        if($data->TransDate > '00000000'){
            $data->TransDate = substr($data->TransDate, 0, 4)."/".substr($data->TransDate, 4, 2)."/".substr($data->TransDate, 6, 2);  
        }
        else{
            $data->TransDate='';
        }
        if($data->CloseDate > '00000000'){
            $data->CloseDate = substr($data->CloseDate, 0, 4)."/".substr($data->CloseDate, 4, 2)."/".substr($data->CloseDate, 6, 2);  
        }
        else{
            $data->CloseDate='';
        }
        if($data->InspectDate > '00000000'){
            $data->InspectDate = substr($data->InspectDate, 0, 4)."/".substr($data->InspectDate, 4, 2)."/".substr($data->InspectDate, 6, 2);  
        }
        else{
            $data->InspectDate='';
        }

        return response()->json($data,200);
    }

    public function searchOrderARM1($QNO)
    {
        $data = arm1::where('OrderNo',trim($QNO))->first(['arm1.*','帳款金額 as OrderValue1','額外施工費用 as exwork','墊款餘額 as HelpPayValue','退折讓 as Rebate','實收金額 as TrueValue',
        '應收餘額 as ShouldValue','溢收金額 as MorePayValue','店折扣額 as StoreRebate','代墊餘額 as HelpPayValue1','應收還款 as ShouldBackValue','保固費用 as WarrantyValue','Rebat as RebateValue']);
        $data->RebateValue = $data->Rebat - $data->退折讓;

        return response()->json($data,200);
    }

    public function searchOrderDetailitemCheckPC($SuppNo,$colornum){
        $SuppNo = trim($SuppNo);
        $data = CTD::where('codeindex',$colornum)->where('Reserve4',$SuppNo)->first();
        if($data==NULL){
            return response()->json(0,200);
        }
        else{
            return response()->json(1,200);
        }
    }

    public function searchIMChangePriceRecord($PartNo,$QNO){
        
        $data = ChangePriceRecord::where('料',$PartNo)->first();    

        if($data!=NULL){
            $dataSO  = SO::where('QuotNo',$QNO)->first();
    
            $data = ChangePriceRecord::where('料',$PartNo)->where('日','<=',$dataSO->PromotionPeriod)->orderby('日','desc')->first();    

            return response()->json([$data,1],200);  
        }
        else{
            $data = im::where('SKU',$PartNo)->first();  
            return response()->json([$data,0],200);  
        }
        
    }

    
    public function searchColorPrice($PartNo,$Color,$QNO){

        function IMChangePriceRecord($PartNo,$QNO){
        
            $data = ChangePriceRecord::where('料',$PartNo)->first();    
    
            if($data!=NULL){
                $dataSO  = SO::where('QuotNo',$QNO)->first();
        
                $data = ChangePriceRecord::where('料',$PartNo)->where('日','<=',$dataSO->PromotionPeriod)->orderby('日','desc')->first();    
    
                return $data->後價;  
            }
            else{
                $data = im::where('SKU',$PartNo)->first();  
                return $data->FullPrice;  
            }
            
        }

        $Color=trim($Color);
        $PartNo=trim($PartNo);
        $QNO=trim($QNO);
        $TotalPrice = 0;  
        
        $Partim  = im::where('SKU',$PartNo)->first(); 
        if(substr($Partim->SupplierNo,0,2)=='SD'){
            $dataSO = SO::where('QuotNo',$QNO)->first();
            $data = psf::where('Salescode',$PartNo)->get();    
        
            if(count($data)==0){   
                $dataColor = SD_Cost_Price::where('Range_',$Color)->where('Date_','<=',$dataSO->PromotionPeriod)->orderby('Date_','desc')->first();   
                $TotalPrice += $dataColor->Price_ * $Partim->m3;           
            }
            else{
                foreach($data as $PartGroup){  
                    $Partim  = im::where('SKU',trim($PartGroup->Stockcode))->first();      
                    $Colorcheck  = vm::where('SuppNo',$Partim->SupplierNo)->first();
                   
                    if(trim($Colorcheck->LastTrans)=='A'){
                        $dataColor = SD_Cost_Price::where('Range_',$Color)->where('Date_','<=',$dataSO->PromotionPeriod)->orderby('Date_','desc')->first();   
                        if($dataColor==null){
                            $price = IMChangePriceRecord($Partim->SKU,$QNO);
                            $TotalPrice += $price*$PartGroup->Qty;   
                        }
                        else{
                            $TotalPrice += $dataColor->Price_ * $Partim->m3;
                        }
                    }
                    else{
                        $price = IMChangePriceRecord($Partim->SKU,$QNO);
                        $TotalPrice += $price*$PartGroup->Qty;   
                    }
                }
            }
        }
        else if(substr($Partim->SupplierNo,0,2)=='SF'){
            $dataSO = SO::where('QuotNo',$QNO)->first();
            $data = SF002_Psf::where('Salescode',$PartNo)->get();    
          
            if(count($data)==0){   
                $dataColor = SF002_Cost_Price::where('色號',$Color)->where('日期','<=',$dataSO->PromotionPeriod)->orderby('日期','desc')->first();   
                $TotalPrice += $dataColor->Price_ * $Partim->m3;   
                //return response()->json(0 ,200);        
            }
            else{
                foreach($data as $PartGroup){  
                    $Partim  = im::where('SKU',trim($PartGroup->StockCode))->first(); 
                    $Colorcheck  = vm::where('SuppNo',$Partim->SupplierNo)->first();
                    if(trim($Colorcheck->LastTrans)=='A'){
                        $dataColor = SF002_Cost_Price::where('色號',$Color)->where('板類',$Partim->Type2)->where('日期','<=',$dataSO->PromotionPeriod)->orderby('日期','desc')->first();   
                        if($dataColor==null){
                            $price = IMChangePriceRecord($Partim->SKU,$QNO);
                            $TotalPrice += $price*$PartGroup->Qty;   
                        }
                        else{
                            $TotalPrice += $dataColor->售價 * $PartGroup->Qty;
                        }    
                    }
                    else{
                        $price = IMChangePriceRecord($Partim->SKU,$QNO);
                        $TotalPrice += $price*$PartGroup->Qty;    
                    }
                }
            }
        }     
        return response()->json((int)$TotalPrice ,200);
           
    }

}
