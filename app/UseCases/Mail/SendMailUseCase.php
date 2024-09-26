<?php

namespace App\UseCases\Mail;

use App\Mail\CustomMail;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\GeneralException;

final class SendMailUseCase {
    public function __invoke(string $email, string $subject, string $token ='') {
        try {
            Mail::to($email)->send(new CustomMail($token, $subject));
            return true;
        } catch (\Exception $e) {
            throw new GeneralException($e);
        }
    }
}
