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

            // if (!app(CallFromQueue::class)->agentAvailable) {
            //     $response->say('I\'m sorry, our agent is currently unavailable. Please try again later.');
            //     return $response;
            // }
            $response = new VoiceResponse();
            $response->say('Thanks for reaching out. You have been added to a queue. An agent will get to you shortly');
            $response->enqueue('support', ['url' => 'about_to_connect.xml']);

            //notify agent of call

            // make the call to your agent
            $client = new Client(getenv("TWILIO_ACCOUNT_SID"), getenv("TWILIO_AUTH_TOKEN"));

            $call = $client->calls->create(
                +234XXXXXXXXXXX,
                +16XXXXXXXXXXXX,
                ['url' => 'https://26bd-102-91-4-161.ngrok-free.app/call-forward'] //
            );

            return response($response)->header('Content-Type', 'text/xml');
        } catch (TwimlException $e) {
            return $e->getCode();
        }
    }

    public function agentConnectUser()
    {
        // $token = csrf_token();
        $response = new VoiceResponse();
        $dial = $response->dial();
        $dial->queue('support');

        echo $response;
    }
}
