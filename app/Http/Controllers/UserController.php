<?php
namespace App\Http\Controllers;
use App\Helper\JWTHelper;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{


    public function userRegistration(Request $request)
    {
        try{
            User::create($request->input());
            return response()->json(['status'=>'success', 'message'=>"User Registration Success"]);
        }catch(Exception $exception){
            return response()->json(['status'=>'failed', 'message'=>$exception->getMessage()]);

        }
    }




    function userLogin(Request $request){
        try {
            $user= User::where($request->input())->select('id')->first();
            $userID=$user->id;

            if($userID>0){
                $token=JWTHelper::CreateToken($request->input('email'),$userID);
                return response()->json(['status'=>'success', 'message'=>"Login Success"])
                    ->cookie('token',$token,time()+60*60);
            }else {
                return response()->json(['status' => 'fail', 'message' => "No user found"]);
            }
        }catch (Exception $exception){
            return response()->json(['status'=>'failed', 'message'=>$exception->getMessage()]);
        }
    }


    function userProfile(Request $request){
        $userID=$request->header('id');
        return User::where('id',$userID)->first();
    }


    function userLogout(){
        return redirect('/Login')->cookie('token','',time()-60*60);
    }

}
