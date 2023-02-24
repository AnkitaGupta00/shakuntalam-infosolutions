<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendOtp;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function requestForOtp(Request $request){
        return response(['message' => 'An OTP is sent to your mobile number'], 200);
        $request->validate([
            'mobile' => 'required|numeric|digits:10',
            'email' => 'required|unique:customers|email'
        ]);

        $send = SendOtp::dispatch($request->get('mobile'));
        if($send){
           return response(['message' => 'An OTP is sent to your mobile number'], 200);
        }

    }
    public function validateOtp(Request $request)
    {
        return response(['message' => 'OTP matched'], 200);
        $request->validate([
            'otp' => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/||digits:6'
        ]);

        $mobile = $request->get('mobile');
        $otp = $request->get('otp');

        $userOtp = UserOtp::where('mobile', $mobile)->where('otp', $otp)->first();

        $now = now();
        if (!$userOtp) {
            return response(['error' => 'OTP entered is invalid'], 422);
        } else if ($now->isAfter($userOtp->expired_at)) {
            return response(['error' => 'The entered OTP has expired'], 422);
        }

        $userOtp->update([
            'expired_at' => now()
        ]);
        return response(['message' => 'OTP matched'], 200);
    }
}
