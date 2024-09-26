<?php

namespace Tests\Unit\auth;

use Tests\TestCase;
use App\UseCases\Mail\SendMailUseCase;
use App\Mail\CustomMail;
use Illuminate\Support\Facades\Mail;

class VerificationMailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSendMail()
    {
        
        $result = Mail::to('test.email@email.com')->send(new CustomMail('test','test'));
        $this->assertIsBool(true);
        

    }
}
