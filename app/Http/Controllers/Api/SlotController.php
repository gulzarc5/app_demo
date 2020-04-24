<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\SmsHelper\Sms;

class SlotController extends Controller
{
    public function images()
    {
        $slot_data = DB::table('image_data')->orderBy('id','desc')->get();
        $response = [
            'status' => true,
            'message' => 'Images List',
            'data' => $slot_data,
        ];
        return response()->json($response, 200);

        
    }

    public function sendOtp($mobile)
    {
        $user = DB::table('user')->where('mobile',$mobile)->count();
        if ($user > 0) {
            $otp = rand(111111,999999);
            DB::table('user')
                ->where('mobile',$mobile)
                ->update([
                    'otp' => $otp,
                ]);                
            $request_info = urldecode("Your OTP is $otp . Please Do Not Share This Otp To Any One. Thank you");
            Sms::SmsSend($mobile,$request_info);
            $data = [
                'mobile' => $mobile,
            ];
            $response = [
                'status' => true,
                'message' => 'OTP Send Successfully Please Verify',
                'data' => $data,
            ];
            return response()->json($response, 200);
        } else {
            $data = [
                'mobile' => $mobile,
            ];
            $response = [
                'status' => false,
                'message' => 'Please Enter Registered Mobile Number',
                'data' => $data,
            ];
            return response()->json($response, 200);
        }
        
    }

    public function varifyOtp($mobile,$otp)
    {
        $user = DB::table('user')->where('mobile',$mobile)->where('otp',$otp)->count();
        if ($user > 0) {
            $data = [
                'mobile' => $mobile,
                'otp' => $otp,
            ];
            $response = [
                'status' => true,
                'message' => 'OTP Send Successfully Please Verify',
                'data' => $data,
            ];
            return response()->json($response, 200);
        } else {
            $data = [
                'mobile' => $mobile,
            ];
            $response = [
                'status' => false,
                'message' => 'Please Enter Correct OTP',
                'data' => $data,
            ];
            return response()->json($response, 200);
        }
        
    }



}
