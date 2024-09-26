<?php

namespace App\UseCases\Mail;

use App\Mail\CustomFileMail;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\Auth;

final class SendMailFileUseCase {
    public function __invoke(string $base64, String $fileUrl,$invoice) {
        $user = Auth::user();
        try {
            Mail::to($user->email)->send(new CustomFileMail($base64, $fileUrl,$user, $invoice));
            return true;
        } catch (\Exception $e) {
            throw new GeneralException($e->getMessage(), 0, $e);
        }
    }
}
