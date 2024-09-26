<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseRepository{

    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function beginTransaction() {
        DB::beginTransaction();
    }

    public function commitTransaction() {
        DB::commit();
    }

    public function rollbackTransaction() {
        DB::rollBack();
    }

}