<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource as UserResource;
use Illuminate\Spport\Facades\Carbon;
class AuthController extends Controller
{
    

    public function users(){

        return UserResource::collection(\App\User::all());
        
    }
public function login(Request $request){

    $validator = \Validator::make($request->all(), [
    'email'=>'required|email',
    'password'=>'required'
    ]);

    if($validator->fails()){

     return response(['errors'=>$validator->errors()]);

    }
    try{

        if(\Auth::attempt($request->only('email', 'password'))){

        /** @var User $user*/ 
        $user = \Auth::user();

        $token = $user->createToken('authToken')->accessToken;
        
        // return $user;

        return response()->json([
        'message'=>'success',
        "success" => true,
        'user'=>$user,
        "token" => $token,
        "token_type" => "bearer",
        ],200);

        }
        }catch(\Exception $exception){

        return response([
        'message'=>$exception->getMessage()
        ],400);
        }

        return response([
        'message'=> 'invalid User Credentials',],401);
    }

    public function user(){

        try {

            return \Auth::user();
        } catch (\Exception $exception) {
            //throw $th;
            return response([
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function register (Request $request) {
        
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

       try {

        $request['password']= \Hash::make($request['password']);
        $user = \App\User::create($request->toArray());
        // $token = $user->createToken('authToken')->accessToken;
        // $response = ['token' => $token];
        return response([
            'message'=>'User Registered'
        ], 200);

       } catch (\Exception $exception) {
        return response(['message'=>$exception->getMessage()]) ;
       }
    }


    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
