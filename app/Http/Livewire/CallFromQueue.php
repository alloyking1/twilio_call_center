<?php

namespace App\Http\Livewire;

use Twilio\TwiML\VoiceResponse;
use Twilio\Rest\Client;

use Livewire\Component;

class CallFromQueue extends Component
{
    public $agentAvailable = true;

    public function toggleAgentAvailability()
    {
        $this->agentAvailable = !$this->agentAvailable;
    }

    public function handleIncomingCall()
    {

        try {

            if (!$this->agentAvailable) {
                $response->say('I\'m sorry, our agent is currently unavailable. Please try again later.');
                return $response;
            }

            $response = new VoiceResponse();
            $response->say('Thanks for reaching out. You have been added to a queue. An agent will get to you shortly');
            $response->enqueue('support', ['url' => 'about_to_connect.xml']);

            return response($response)->header('Content-Type', 'text/xml');
        } catch (TwimlException $e) {
            return $e->getCode();
        }
    }

    public function agentCallForward()
    {
        // make the call to your agent
        $client = new Client(getenv("TWILIO_ACCOUNT_SID"), getenv("TWILIO_AUTH_TOKEN"));

        //agent phone rings
        $call = $client->calls->create(
            +2348063146940,
            +16206440753,
            ['url' => 'https://26bd-102-91-4-161.ngrok-free.app/call-forward'] //
        );

        $this->notifyAgent = false;
    }

    public function agentEndCall()
    {
        $response = new VoiceResponse();
        $response->say('I\'m sorry, our agent is currently unavailable. Please try again later.');
        $response->hangup();
        return $response;
    }

    public function callFromQueue()
    {
        try {
            // $token = csrf_token();
            $response = new VoiceResponse();
            $dial = $response->dial();
            $dial->queue('support');
            return $response;
        } catch (TwimlException $e) {
            return $e->getCode();
        }
    }

    public function render()
    {
        return view('livewire.call-from-queue');
    }
}
