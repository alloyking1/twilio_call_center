<?php

namespace App\Http\Controllers;

use Twilio\TwiML\VoiceResponse;
use Twilio\Rest\Client;
use Twilio\Twiml;

use App\Http\Livewire\CallFromQueue;

class CallCenterController extends Controller
{
    public function handleIncomingCall()
    {

        try {

            $response = new VoiceResponse();
            if (!app(CallFromQueue::class)->agentAvailable) {
                $response->say('I\'m sorry, our agent is currently unavailable. Please try again later.');
                return $response;
            }

            $dial = $response->dial();
            $dial->conference('Call Center Conference');

            return $response;
        } catch (TwimlException $e) {
            return $e->getCode();
        }
    }
}
