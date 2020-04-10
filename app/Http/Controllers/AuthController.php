<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Role;
use App\Instructor;

class AuthController extends Controller
{

    public function user(){
        if(Auth::check()){
            $first_name = Auth::user()->first_name;
            $last_name = Auth::user()->last_name;
            $user = $first_name.' '.$last_name;
            return response()->json(['req_status'=>'success','user'=>$user],200);
        }
        else{
            return response()->json('Unauthorized',401);
        }
    }

    public function register(Request $request){
        
        /*
        $validate = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6']
        ]);
        */
        
        $validate = Validator::make($request->all(),[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        //$student = User::create($validate);

        if($validate->fails()){
            return response()->json(['req_status'=>'error','message'=>$validate->errors()]);
        }
        else{
            $student_role = Role::where('name', 'student')->first();

            //Default student registration
            $student = new User;
            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->email = $request->email;
            $student->password = Hash::make($request->password);
            $student->is_active = 1;
            $student->save();
            $student->roles()->attach($student_role);
            return response()->json(['req_status'=>'success','message'=>'Account created Successfully'],200);
        }
    }

    public function login(Request $request){

        $credentials = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember_me = $request->has('remember') ? true : false;

        if($credentials->fails()){
            return response()->json(['req_status'=>'error','message'=>$credentials->errors()]);
        }
        else{
            $user = User::where('email',$request->email)->first();
        
            if($user){
                if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$remember_me)){
                    // Authentication passed...
                    $existed_user = Auth::user();
                    $access_token = $existed_user->createToken('Token Name')->accessToken;
                    $user =  $existed_user->first_name.' '.$existed_user->last_name;
                    return response()->json(['req_status'=>'success','access_token'=>$access_token]);
                }
                else{
                    return response()->json(['req_status'=>'error','message'=>'Unauthorized']);
                }
            }
            else{
                return response()->json(['req_status'=>'error','message'=>'User not found']);
            }

        }
    }

    public function logout(){
        $user_tokens = Auth::user()->tokens;
        foreach ($user_tokens as $token) {
            $token->revoke();
        }
        return response()->json(['req_status'=>'success','message'=>'Loggedout Successfully'],200);
    }
}
