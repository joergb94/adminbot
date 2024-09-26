<?php

namespace App\Repositories;

use App\Models\Language;


final class LanguageRepository extends BaseRepository
{
    public function __construct(Language $model){
        parent::__construct($model);
    }

    public function findAll() {
        return $this->model::orderBy('id', 'desc')->get();
    }

    public function findById(int $id) : Language {
        return $this->model::find($id);
    }

}