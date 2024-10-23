<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bot extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
                            'user_id',
                            'language_id',
                            'name',
                            'role',
                            'content',
                            'telegram_bot',
                            'whatsapp_number',
                            'start_message',
                            'created_at',
                            'updated_at',
                            'deleted_at'
                        ];

    public function mapped()
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'role'                  => $this->role,
            'active'                => $this->active,
            'telegram_bot'          => $this->telegram_bot,
            'whatsapp_number'       => $this->whatsapp_number,
            'content'               => $this->content,
            'start_message'         => $this->start_message,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
            'deleted_at'            => $this->deleted_at,
            'language'              => $this->language,
            'user'                  => $this->user,
            'flows'                 =>isset($this->flows)?$this->flows:[]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function flows()
    {
        return $this->hasMany(Flow::class,'bot_id','id');
    }

}
