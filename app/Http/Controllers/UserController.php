<?php

namespace App\Http\Controllers;

use JWTToken;
use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    
    public function userRegistration(Request $request){
        try {
             User::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'User Registration Succesfull!', 
            ]);
        } catch (Exception $exception) {
           return response()->json([
                'status' => 'Failed',
                'message' => $exception->getMessage(),
            ]);
        }

       

    }

    public function userLogin(Request $request){
        try {
            $user = User::where('email', '=', $request->email)
                ->where('password', '=', $request->password)
                ->select('id')->first();

            if ($user !== null) {
                $token = JWTToken::createToken($request->email,$request->id);
                return response()->json([
                    'status' => 'success',
                    'message' => 'User Login Succesfull!',
                ])->cookie('token', $token, time() + 60 * 60 * 24);

            }else{
                return response()->json([
                'status' => 'Failed',
                'message' => 'No user found',
            ]);
            }
           
        } catch (Exception $exception) {
             return response()->json([
                'status' => 'Unauthorize',
                'message' =>$exception->getMessage(),
            ]);
        }
    }

    public function sendOtp(Request $request){
        try {
            $email = $request->email;
            $otp = rand(1000, 9999);
            $user = User::where('email', '=', $email)->count();

            if ($user == 1) {
                Mail::to($email)->send(new OTPMail($otp));
                User::where('email', '=', $email)->update(['otp'=> $otp]);
                    return response()->json([
                        'status' => 'success',
                         'message' => '4 disit OTP code send Succesfull!',
                ]);
            }else{
                return response()->json([
                'status' => 'Failed',
                'message' => 'Unauthorize',
                ]);
            }
        } catch (Exception $exception) {
            return response()->json([
                'status' => 'Unauthorize',
                'message' =>$exception->getMessage(),
            ]);
        }
        
    }

    public function verifyOtp(Request $request){
        try {
            $email = $request->email;
            $otp = $request->otp;
            $user = User::where('email', '=', $email)
            ->where('otp', '=', $otp)->count();

            if ($user == 1) {
                 User::where('email', '=', $email)->update(['otp' => '0']);
                 $token = JWTToken::createTokenForPass($email);

            return response()->json([
                    'status' => 'success',
                    'message' => 'OTP verification Succesfull!',
                    'token' => $token,
                ])->cookie('token', $token, time() + 60 * 60 * 24);
            }else{
                return response()->json([
                     'status' => 'Failed',
                    'message' => 'No user found',
                ]);
             }
        } catch (Exception $exception) {
            return response()->json([
                'status' => 'Unauthorize',
                'message' =>$exception->getMessage(),
            ]);
        }
        
    }

    
    public function resetPass(Request $request){
        try {
            $email= $request->header('email');
            $password = $request->password;
            User::where('email', '=', $email)->update(['password'=> $password]);
            return response()->json([
                'status' => 'success',
                'message' => 'Password change Succesfull!',
            ]);
        } catch (Exception $exception) {
             return response()->json([
                'status' => 'Unauthorize',
                'message' =>$exception->getMessage(),
            ]);
        }
    }

     public function logout(Request $request){
        return redirect("/login")->cookie('token', '', -1);
      }

      public function userprofile(Request $request){
        $email = $request->header('email');
        $user = User::where('email', '=', $email)->first();
        return response()->json([
             'status'=>'success',
            'message'=> 'request successfull',
            'data'=>$user
        ]);
    }

    public function updateprofile(Request $request){
        try {
            $email = $request->header('email');
            $firstName= $request->input('firstName');
            $lastName= $request->input('lastName');
            $mobile=$request->input('mobile');
            $password= $request->input('password');
            User::where('email','=', $email)->update([
                'firstName'=> $firstName,
                'lastName'=> $lastName,
                'mobile'=> $mobile,
                'password'=> $password,
            ]);
       
        return response()->json([
             'status'=>'success',
            'message'=> 'request successfull',
        ]);
        } catch  (Exception $e) {
                 return response()->json([
                'status'=>'failed',
                'message'=> 'something is wrong'
            ]);
        }
        
    }

}