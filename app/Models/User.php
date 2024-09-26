<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $table= 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
                            'name',
                            'last_name',
                            'phone',
                            'email',
                            'password',
                            'find_out',
                            'verified',
                            'verification_token',
                            'verification_sent_at',
                            'created_at',
                            'updated_at'
                        ];

    public function mapped()
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'first_name'            => $this->first_name,
            'last_name'             => $this->last_name,
            'phone'                 => $this->phone,
            'email'                 => $this->email,
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];


    public function getNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function getFirstNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function getLastNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }


    public function getCreatedAtAttribute($value)
    {
        return isset($value) ? date("Y-m-d H:i:s", strtotime($value)) : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return isset($value) ? date("Y-m-d H:i:s", strtotime($value)) : null;
    }
}
