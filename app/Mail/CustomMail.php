<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;




class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;
    protected $title;


    /**
     * Create a new message instance.
     */
    public function __construct(string $token, String $title)
    {
        $this->token = $token;
        $this->title = (string) $title;
    }

    public function build(){
        return $this->from(config('mail.mailers.smtp.username'), 'no-replay@daytech.com.mx')
                ->subject($this->title)     
                ->view('mail.verificationEmail')
                ->with(['token'=>$this->token]);
    }
    
}
