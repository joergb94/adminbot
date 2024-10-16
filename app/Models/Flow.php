<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flow extends Model
{
    use HasFactory,SoftDeletes;

  protected $fillable = [
                            'bot_id',
                            'sort',
                            'add_answer_before',
                            'add_keyword',
                            'add_answer_next',
                            'created_at',
                            'updated_at',
                            'deleted_at'
                        ];

    public function mapped()
    {
        return [
            'id'                => $this->id,
            'bot_id'            => $this->bot_id,
            'sort'              => $this->sort,
            'add_answer_before' => $this->add_answer_before,
            'add_keyword'       => $this->add_keyword,
            'add_answer_next'   => $this->add_answer_next,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'deleted_at'        => $this->deleted_at,
           
        ];
    }

    public function Boots()
    {
        return $this->belongsTo(Bot::class, 'bot_id');
    }
}
