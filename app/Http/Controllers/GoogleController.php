<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Session;
use Auth;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\User;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
      
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    { 
            $user = Socialite::driver('google')->user();
            //return response()->json(['message' => $user], 200);
            $doc = DB::table('EM13')->where('E_MAIL',$user->email)->where('OFDT','00000000')->first();
            if(strpos($user->email,'@home33.com.tw')){            //是公司信箱                 
                $finduser = User::where('google_id', $user->id)->first();
                // Session::put('EMID', $doc->EMID); 
                if(!$finduser){ 
                    $finduser = User::create([
                        'EMID' =>  $doc->EMID,
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        'password' => "NULL"
                    ]);
                }
                Auth::login($finduser);
                return redirect('/');
            }
            else{                                                   //不是公司信箱
                 return redirect('/')->with('msg', 'This email is vaild');
                } 
          
    }
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