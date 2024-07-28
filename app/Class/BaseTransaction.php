<?php

namespace App\Class;

use App\Exceptions\DBQueryException;
use Illuminate\Support\Facades\DB;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class BaseTransaction extends Eloquent {

    protected $session;

    public function beginTransaction() {
        $connection = DB::connection('mongodb')->getMongoClient();
        $this->session = $connection->startSession();
        $this->session->startTransaction();
    }

    public function commitTransaction() {
        if ($this->session) {
            try {
                $this->session->commitTransaction();
            } finally {
                $this->endSession();
            }
        }
    }

    public function rollbackTransaction() {
        if ($this->session) {
            try {
                $this->session->abortTransaction();
            } finally {
                $this->endSession();
            }
        }
    }

    public function throwNewQueryException($message) {
        throw new DBQueryException($message);
    }

    protected function endSession() {
        if ($this->session) {
            $this->session->endSession();
            $this->session = null;
        }
    }

    public function getSession() {
        return $this->session;
    }
}
