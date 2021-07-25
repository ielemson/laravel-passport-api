<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordReset;
use DB;
use Hash;
// use Mail;
class ForgotController extends Controller
{
    
public function forgot(Request $request){

    $validator = \Validator::make($request->all(), [
    'email' => 'required|string|email|max:255'
    ]);

    if ($validator->fails())
    {
    return response(['errors'=>$validator->errors()->all()], 422);
    }

    if(\App\User::where('email',$request->email)){

    $token = Str::random(10);

    $email = $request->email;

    try {

            DB::table('password_resets')->insert([
            'token'=>$token,
            'email'=>$request->email
            ]);

    // Send Email
    // Mail::send('mails.forgot',['token'=>$token],function(Message $message) use($email){

    //     $message->to($email);
    //     $message->subject('Reset Password');

    // });

    Mail::to($request->email)->send(new PasswordReset($token));

            return response(['message'=>'Plese Check your email for reset token']);

    } catch (\Exception $exception) {

            return response([
            'message'=>$exception->getMessage()
            ],400);
            } 

            }

         return response(['message'=>'User Does Not Exist'],400);

}


public function reset(Request $request ){

    $validator = \Validator::make($request->all(), [
    'token' => 'required',
    'password' => 'required|string|min:6|confirmed',
    'password_confirmation' => 'required',
    ]);

    if ($validator->fails())
    {
          return response(['errors'=>$validator->errors()->all()], 422);
    }

    if (!$passwordReset = DB::table('password_resets')->where('token',$request->token)->first()) {
    # code...
            return response([
            'message'=>'Invalid token'
            ],400);
    }

    /** @var User $user*/ 
    if (!$user = \App\User::whereEmail($passwordReset->email)->first()) {
    # code...
            return response([
            'message'=>'User does not exist'
            ],404);
            }

    $user->password = Hash::make($request->password);

    if($user->save()){

            return response([
            'message'=>'password reset successfully'
            ],200); 
            }

}
}
