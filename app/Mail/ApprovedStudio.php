<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class ApprovedStudio extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $studio;


    public function __construct(User $studio)
    {
        $this->studio = $studio;
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
                'name' => $this->studio['name'],
                'email' => $this->studio['email'],

            ];
            return $this->view('email.approvedStudio', compact('data'))
                        ->from('admin@ohlordit.com')
                        ->to($data['email'])
                        ->subject('TTS-Your Account Has been Approved.');
        }
        catch(\Exception $e) {
            return $e;
        }
    }
}
