<?php
namespace App\Repositories;

use App\Models\User;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    private $model;
  
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all($criterion,$search,$status,$profile): LengthAwarePaginator
    {              

                    $rg = (strlen($criterion) > 0 &&  strlen($search) > 0) 
                    ? $this->model->where('id','>',1)->where('id','!=',Auth::user()->id)->where($criterion, 'like', '%'. $search . '%')
                    : $this->model->where('id','>',1)->where('id','!=',Auth::user()->id);

            
                    if($profile !='all'){
                        $rg->where('type_user_id',$profile);
                    }

                    switch ($status) {
                        case 1:
                            $rg;
                        break;
                        case 'D':
                            $rg->onlyTrashed();
                        break;
                } 

                    $Users = $rg->orderBy('id', 'desc')->paginate(10);

            return $Users;
    }

    public function find(int $user_id): User
    {
        return $this->model::withTrashed()->find($user_id)->trashed();
    }


    public function create(array $data): User
    {
        return $this->model::create([
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                        'phone' => $data['phone'],
                        'email' => $data['email'],
                        'message' => $data['message'],
                        'reference' => $data['reference'],
                        'password' => Hash::make($data['password']),
                    ]);
    }

    public function update(User $user, array $data): Bool
    {
           return $user->update([
                            'first_name' => $data['first_name'],
                            'last_name' => $data['last_name'],
                            'phone' => $data['phone'],
                            'email' => $data['email'],
                        ]);
    }

    public function updatePassword(User $user, array $data): Bool
    {
           return $user->update(['password' => Hash::make($data['password'])]);
    }


    public function delete(int $User_id)
    {    
        return User::find($User_id)->delete();
    }

    public function restore(int $User_id)
    {    
        return User::withTrashed()->find($User_id)->restore();
    }

}