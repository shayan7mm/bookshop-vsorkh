<?php
namespace App\Services;

use App\Models\Otp;

class OtpService
{
    public static function send(string $phone): string
    {
        $code = (string) random_int(10000, 99999);

        Otp::create([
            'phone'      => $phone,
            'code'       => $code,
            'expires_at' => now()->addMinutes(5),
        ]);

        return $code;
    }

    public static function verify(string $phone, string $code): bool
    {
        $otp = Otp::where('phone', $phone)
            ->where('code', $code)
            ->whereNull('used_at')
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$otp) return false;

        $otp->update(['used_at' => now()]);
        return true;
    }
}