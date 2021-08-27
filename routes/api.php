<?php
use App\Models\CMCRFItems;
use App\Models\cm;
use Illuminate\Http\Request;
use App\Http\Controllers\api\SearchController;
use App\Http\Controllers\api\UpdateController;
use App\Http\Controllers\api\CreateController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/EMID',[GoogleController::class,'index']);

Route::get('/search/CM/name/{CNO}',[SearchController::class,'searchCMname']);
Route::get('/search/CM/{CNO}',[SearchController::class,'searchCM']);
Route::get('/search/CTD/{codename}',[SearchController::class,'searchCTD']);
Route::get('/search/CmMemo/{CNO}&&{MemoType}',[SearchController::class,'searchCmMemo']);
Route::get('/search/CMCRFItems/{CNO}',[SearchController::class,'searchCMCRFItems']);
Route::get('/search/PD',[SearchController::class,'searchPD']);
Route::get('/search/zip/{street}',[SearchController::class,'searchaddress']);
Route::get('/search/chk/{CNO}',[SearchController::class,'searchCHK']);
Route::get('/search/UserDept/{DVID}',[SearchController::class,'searchUserDeptMember']);//搜尋方式待修改

Route::post('/Update/CM',[UpdateController::class,'UpdateCM']);
Route::post('/Update/CmMemo',[UpdateController::class,'UpdateCmMemo']);
Route::post('/Update/CMCRFItems',[UpdateController::class,'UpdateCMCRFItems']);
Route::post('/Update/Measurestate',[UpdateController::class,'UpdateMeasurestate']);
Route::post('/Update/DeleteMeasureJK',[UpdateController::class,'UpdateDeleteMeasureJK']);
Route::post('/Update/MeasureEnd',[UpdateController::class,'UpdateMeasureEnd']);

Route::post('/Create/CM',[CreateController::class,'CreateCM']);
Route::post('/Create/CmMemo',[CreateController::class,'CreateCmMemo']);
Route::post('/Create/CMCRFItems',[CreateController::class,'CreateCMCRFItems']);
Route::post('/Create/self-evaluation',[CreateController::class,'CreateCMself']);
Route::post('/Create/Measure',[CreateController::class,'CreateMeasure']);
Route::post('/Create/MeasureEnd',[CreateController::class,'CreateMeasureEnd']);
Route::post('/Create/MeasureCheckJ',[CreateController::class,'CreateMeasureCheckJ']);
Route::post('/Create/MeasureCheckK',[CreateController::class,'CreateMeasureCheckK']);