<?php

namespace App\Repositories;

use App\Models\Bot;


final class BotRepository extends BaseRepository
{
    public function __construct(Bot $model){
        parent::__construct($model);
    }

    public function findAll() {
        return $this->model::orderBy('id', 'desc')->get();
    }

    public function findById(int $id) : Bot {
        return $this->model::find($id);
    }

    public function store(object $params){
      
        return $this->model::create([
                 'user_id' => $params->name,
                 'language_id' => $params->name,
                 'name' => $params->name,
                 'description' => $params->name,
                 'start_message'=>$params->start_message 
             ]);
     }
 
     public function update(Bot $Bot, array $params){
         return $Bot->update($params);
     }
}