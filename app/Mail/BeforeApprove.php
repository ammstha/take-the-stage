<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class BeforeApprove extends Mailable
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
//        dd($request->all());
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
            ];
            return $this->view('email.beforeApprove', compact('data'))
                ->from('admin@ohlordit.com')
                ->to($request->email)
                ->subject('Take the Stage Entertainment-Action Required');
        }
        catch(\Exception $e) {
            return $e;
        }
    }

}
