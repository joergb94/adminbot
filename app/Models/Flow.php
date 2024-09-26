<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flow extends Model
{
    use HasFactory,SoftDeletes;

    public function Boots()
    {
        return $this->belongsTo(Bot::class, 'bot_id');
    }
}
