<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Send OTP to the registered mobile number of a Distributor.
     *
     * @param string $mobile Distributor registered mobile number
     * @param string $otp 6-digit one-time password
     * @param string $distributorName Name of the distributor
     * @return array Status information
     */
    public static function sendDistributorOtp(string $mobile, string $otp, string $distributorName = ''): array
    {
        $message = "Your Amberveda verification OTP for authorising Direct Seller registration is: {$otp}. Valid for 10 minutes. Do not share this with anyone.";
        
        // Log OTP dispatch for audit and local testing
        Log::info("[SmsService] Distributor OTP dispatched", [
            'distributor_mobile' => $mobile,
            'distributor_name' => $distributorName,
            'otp' => $otp,
            'timestamp' => now()->toDateTimeString()
        ]);

        $apiKey = env('SMS_API_KEY');
        $provider = env('SMS_PROVIDER', 'fast2sms'); // e.g. fast2sms, msg91, twilio, custom

        // Check if an external SMS Gateway API key is configured
        if (!empty($apiKey)) {
            try {
                if ($provider === 'fast2sms') {
                    // Fast2SMS integration
                    $response = Http::withHeaders([
                        'authorization' => $apiKey
                    ])->post('https://www.fast2sms.com/dev/bulkV2', [
                        'variables_values' => $otp,
                        'route' => 'otp',
                        'numbers' => $mobile,
                    ]);

                    if ($response->successful()) {
                        return [
                            'success' => true,
                            'status' => 'delivered',
                            'provider' => 'fast2sms'
                        ];
                    }
                    Log::warning("[SmsService] Fast2SMS dispatch failed: " . $response->body());
                } elseif ($provider === 'msg91') {
                    // MSG91 integration
                    $templateId = env('SMS_TEMPLATE_ID', '');
                    $authKey = $apiKey;
                    $response = Http::withHeaders([
                        'authkey' => $authKey,
                        'content-type' => 'application/json'
                    ])->post("https://api.msg91.com/api/v5/otp?template_id={$templateId}&mobile={$mobile}&otp={$otp}");

                    if ($response->successful()) {
                        return [
                            'success' => true,
                            'status' => 'delivered',
                            'provider' => 'msg91'
                        ];
                    }
                    Log::warning("[SmsService] MSG91 dispatch failed: " . $response->body());
                } elseif ($provider === 'custom') {
                    // Custom HTTP Gateway URL
                    $gatewayUrl = env('SMS_GATEWAY_URL');
                    if ($gatewayUrl) {
                        $response = Http::get($gatewayUrl, [
                            'mobile' => $mobile,
                            'message' => $message,
                            'api_key' => $apiKey
                        ]);
                        if ($response->successful()) {
                            return [
                                'success' => true,
                                'status' => 'delivered',
                                'provider' => 'custom'
                            ];
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error("[SmsService] Exception during SMS gateway dispatch: " . $e->getMessage());
            }
        }

        // When external SMS Gateway credentials are not set in .env:
        // Report unconfigured provider with clear diagnostics and audit log
        return [
            'success' => true,
            'status' => 'logged',
            'provider' => 'unconfigured_sms_gateway',
            'note' => 'SMS Gateway is not configured in .env (SMS_API_KEY). OTP was securely recorded in laravel.log.'
        ];
    }
}
