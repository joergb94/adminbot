<?php

namespace App\Class;

use App\Exceptions\DBQueryException;
use Illuminate\Support\Facades\DB;

class BaseTransaction{

    public function beginTransaction() {
        DB::beginTransaction();
    }

    public function commitTransaction() {
        // DB::rollBack();
        DB::commit();
    }

    public function rollbackTransaction() {
        DB::rollBack();
    }

    public function throwNewQueryException($message){
        throw new DBQueryException($message);
    }

}