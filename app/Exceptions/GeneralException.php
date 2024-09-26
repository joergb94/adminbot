<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class GeneralException extends Exception
{
    public $message;

    public function __construct($message = '', $code = 0, Throwable $previus = null)
    {
        parent::__construct($message, $code,$previus);
    }

    public function report(){
        //
    }

    public function render($request){
        return response()->json(['errors'=>['error'=>$this->message]],422);
    }
}
