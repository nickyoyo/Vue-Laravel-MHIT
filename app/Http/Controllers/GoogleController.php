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
                Session::put('EMID', $doc->EMID);    
                if($finduser){ 
                    return redirect('/');
                }else{
                    $newUser = User::create([
                        'EMID' =>  $doc->EMID,
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        'password' => "NULL"
                    ]);
                   
                    return redirect('/456');
                }
            }
            else{                                                   //不是公司信箱
                 return redirect('/123')->with('msg', 'This email is vaild');
                } 
          
    }
}