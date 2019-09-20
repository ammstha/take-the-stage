<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Http\Request;

class RegisterStudio extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,

            ];

            return $this->view('email.registerStudio', compact('data'))
                        ->from($request->email)
                        ->to('amrittestapplication@gmail.com')
                        ->subject('New Studio Registeration - TTS');
        } catch (\Exception $e) {
            return $e;
        }

    }
}
