<?php

namespace Tests\Unit\mail;

use App\Mail\CustomFileMail;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\GeneralException;
use Tests\TestCase;
use Carbon\Carbon;
use App\UseCases\Mail\SendMailFileUseCase;


class filesMailTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testMail(): void
    {
        try {
            $currentDate = Carbon::now()->format('Y-m-d H:i:s');
            $sendMailUseCase = new SendMailFileUseCase();
                    $emailSent = $sendMailUseCase->__invoke(
                        email:'esponja_ray@hotmail.com',
                        token:'asd',
                        subject:'test',
                        files:[
                            storage_path('app/CpOrder30_CPINV_30_66638c11e5d99.xml')
                        ],
                    );
        } catch (\Exception $e) {
            throw new GeneralException($e);
        }
       
    }
}
