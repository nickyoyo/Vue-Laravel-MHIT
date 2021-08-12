<?php

namespace App\Http\Controllers\api;

use App\Models\cm;
use App\Models\EM13;
use App\Models\CMCRFItems;
use App\Models\CM_接待自評;
use App\Models\CmMemo;
use App\Models\CTD;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use PDO;
use Session;

class testController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Session::put('EMID', '21072176');
        if(Session::has('EMID') ==NULL){
            $EMID = 'This email is vaild';
        }
        else{
            $EMID = Session::get('EMID');
        }
        return response()->json(['EMID' => $EMID],200);
    }
}
