<?php

namespace App\Repositories;

use App\Models\Bot;
use App\Models\Flow;
use Illuminate\Support\Facades\Auth;


final class BotRepository extends BaseRepository
{
    protected $flow;
    public function __construct(Bot $model, Flow $flow){
        parent::__construct($model);
        $this->flow = $flow;
    }

    public function findAll() {
        return $this->model::orderBy('id', 'desc')->where('user_id',Auth::user()->id)->get();
    }

    public function findById(int $id) : Bot {
        return $this->model::find($id);
    }

    public function findByName(String $name) {
        return $this->model::where('name',$name)->where('user_id',Auth::user()->id)->first();
    }

    public function store(object $params){
      
        $bot =  $this->model::create([
                 'user_id' => Auth::user()->id,
                 'language_id' => $params->language_id,
                 'name' => $params->name,
                 'content' => $params->content,
                 'telegram_bot' => $params->telegram_bot,
                 'whatsapp_number' => $params->whatsapp_number,
                 'start_message'=>$params->start_message 
             ]);


             if (isset($params->flows)) {
                foreach ($params->flows as $flowData) {
                    $bot->flows()->create([
                            'bot_id' => $bot->id,
                            'sort' => $flowData['sort'],
                            'name' => $flowData['name'],
                            'description' => $flowData['description'],
                    ]);
                }
            }

            $bot->update(['service'=> $bot->name.$bot->id]);
     }
 
     public function update(Bot $Bot, array $params){

        $Bot->update($params);

        // Update flows
        if (isset($params['flows'])) {

            $flowIds = collect($params['flows'])->pluck('id')->filter()->all();
            $Bot->flows()->whereNotIn('id', $flowIds)->delete();

            foreach ($params['flows'] as $flowData) {
                if (isset($flowData['id'])) {
                    // Update existing flow
                    $flow =  $this->flow->find($flowData['id']);
                    if ($flow) {
                        $flow->update([
                            'bot_id' => $Bot->id,
                            'sort' => $flowData['sort'],
                            'name' => $flowData['name'],
                            'description' => $flowData['description'],
                        ]);
                    }
                } else {
                    // Create a new flow 
                    $Bot->flows()->create([
                            'bot_id' => $Bot->id,
                            'sort' => $flowData['sort'],
                            'name' => $flowData['name'],
                            'description' => $flowData['description'],
                    ]);
                }
            }
        }

        return $Bot;
     }

     public function activated(Bot $Bot, array $params){

        $Bot->update($params);

     }
}