<?php


namespace App\Traits\Models;


use App\Twilio\TwilioWrapper;

trait UserTwilioTrait
{

    public function sendVerifyPhoneSMS(string $phone_number): bool
    {
        $wrapper = resolve(TwilioWrapper::class);
        $code = rand(100_000, 999_999);
        $this->phone_code = $code;
        $this->phone_number = $phone_number;
        $this->save();
        return true;
        try {
            $wrapper->sendSms($phone_number, "Verifica nr de telefon pt departments. Codul dvs este : $code");
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    public function verifyPhoneCode(string $code): bool
    {
        $pass = $this->phone_code == $code;
        $this->phone_code = null;
        if ($pass) {
            $this->phone_verified_at = now();
            $this->save();
            return true;
        }
        $this->phone_number = null;
        $this->save();
        return false;
    }
}
