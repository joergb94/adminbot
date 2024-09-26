<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Carbon\Carbon;


final class UserRepository extends BaseRepository
{
    public function __construct(User $model){
        parent::__construct($model);
    }

    public function findAll() {
        return $this->model::orderBy('id', 'desc')->get();
    }

    public function findById(int $id) : User {
        return $this->model::find($id);
    }

    public function findByUserUnverified(String $token) : ?User {
        return $this->model::where('verification_token', $token)
                            ->where('verified',false)
                            ->whereRaw("client.created_at >= (CURRENT_TIMESTAMP - INTERVAL '3 days')::TIMESTAMP")->first();
    }

    public function findByEmail(String $email)  {
        $user = $this->model::whereRaw('LOWER(email) = ?', [$email])->first();
        return $user;
    }

    public function store(object $params){
      
       return  $this->model::create([
                'name' => $params->name,
                'first_name' => '',
                'last_name' => '',
                'phone' => $params->phone,
                'find_out'=>$params->find_out,
                'email' => strtolower($params->email),
                'verification_token' => Uuid::uuid4()->toString(),
                'verification_code' => Str::random(4),
                'verification_sent_at' => Carbon::now(),
                'password' => Hash::make($params->password),
            ]);
    }

    public function update(User $User, array $params){
        return $User->update($params);
    }

}