<?php

namespace App\Jobs;

use App\Models\UserOtp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendOtp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $mobile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mobile)
    {
        $this->mobile = $mobile;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $apiKey = env('SMS_KEY');
            $url = "https://2factor.in/API/V1/$apiKey/SMS/+91$this->mobile/AUTOGEN2/OTP1";
            $result = Http::get($url);
            if ($result->status() === 200) {
                $otp = data_get($result->json(),'OTP');
                $userOtp = new UserOtp();
                $userOtp->mobile = $this->mobile;
                $userOtp->otp = $otp;
                $userOtp->expired_at = now()->addMinutes(10);
                $userOtp->save();
            }
            return $result->json();
        } catch (\Exception $exception) {
            report($exception);
        }
    }
}
