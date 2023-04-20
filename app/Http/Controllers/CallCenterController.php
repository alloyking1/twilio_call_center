<?php

namespace App\Http\Controllers;

use Twilio\TwiML\VoiceResponse;
use Twilio\Rest\Client;

use App\Http\Livewire\CallFromQueue;

class CallCenterController extends Controller
{
    public function handleIncomingCall()
    {
        $connect = $this->connect();
        $response = new VoiceResponse();
        $response->say('I got here');


        // if (!app(CallFromQueue::class)->agentAvailable) {
        //     $response->say('I\'m sorry, our agent is currently unavailable. Please try again later.');
        //     return $response;
        // }

        // $dial = $response->dial();
        // $dial->conference('Call Center Conference');

        // return $response;
    }

    public function connect()
    {
        $sid = getenv("TWILIO_ACCOUNT_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio = new Client($sid, $token);
        return $twilio;
    }
}
