<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Twilio\Rest\Client;

class CallFromQueue extends Component
{
    public function Call()
    {
        $connect = $this->connect();
        $connect->calls->create(
            "+12762965123",
            "+2348063146940",
            ["url" => "https://handler.twilio.com/twiml/EH2ff0457fe3b6eb226e48a3091d00e8c5"]
        );

        // print $call->sid;
    }

    public function connect()
    {
        $sid = getenv("TWILIO_ACCOUNT_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio = new Client($sid, $token);
        return $twilio;
    }

    public function render()
    {
        return view('livewire.call-from-queue');
    }
}
