<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Twilio\Rest\Client;

class CallFromQueue extends Component
{
    public function Call()
    {
        $connect = $this->connect();

        $result = $connect->calls->create(
            "+16206440753", //twilio line from
            "+2348063146940", //my line to
            ["url" => "https://handler.twilio.com/twiml/EH42abf347600cb39843a71d572b4411eb"]
        );

        dd($result->sid);
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
