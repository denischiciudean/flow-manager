<?php


namespace App\Twilio;


use Twilio\Rest\Client;

class TwilioWrapper
{
    public function __construct(private string $sid, private string $token, private string $messaging_sid, private ?Client $client = null)
    {
        $this->client = new Client($sid, $token);
    }

    public function sendSms(string $to, $sms)
    {
        $this->client->messages->create($to, [
            'messagingServiceSid' => $this->messaging_sid,
            'body' => $sms
        ]);
    }

}
