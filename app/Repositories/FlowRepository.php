<?php

namespace App\Repositories;

use App\Models\Flow;


final class FlowRepository extends BaseRepository
{
    public function __construct(Flow $model){
        parent::__construct($model);
    }

    public function findAll() {
        return $this->model::orderBy('id', 'desc')->get();
    }

    public function findById(int $id) : Flow {
        return $this->model::find($id);
    }

    public function store(object $params){
      
        return $this->model::create([
                 'boot_id' => $params->boot_id,
                 'sort' => $params->sort,
                 'addAnswerBefore' => $params->addAnswerBefore,
                 'addKeyword' => $params->addKeyword,
                 'addAnswer' => $params->addAnswer,
                 'addAnswerNext'=>$params->addAnswerNext 
             ]);
     }
 
     public function update(Flow $Flow, array $params){
         return $Flow->update($params);
     }
}