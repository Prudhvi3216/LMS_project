<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use App\User;
use App\Role;
use App\Instructor;

class AuthController extends Controller
{
    public function register(Request $request){
        
        $validate = Validator::make($request->all(),[
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
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
            
            return response()->json('Account created Successfully',200);
        }
       
    }

    public function login(Request $request){
        
        $client = new Client;

        try {
            $response = $client->post('http://127.0.0.1:8000/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => 2,
                    'client_Secret' => 'iJTABVFhow2ceAYJpwbfMryjzkkTBaBMXkB20dNC',
                    'username' => $request->email,
                    'password' => $request->password
                ]
            ]);

            return $response->getBody();

        } catch (GuzzleException $e) {
            if($e->getCode()==400){
                return response()->json('Invalid Request, please enter a username or password', $e->getCode());
            }
            else if ($e->getCode()==401) {
                return response()->json('Your credentials are incorrect, please try again', $e->getCode());
            }

            return response()->json('Something went wrong, please try again later', $e->getCode());
        }
    }

    public function logout(Request $request){

    }
}
