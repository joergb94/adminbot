<?php
namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function all($criterion,$search,$status,$profile);
    public function find(int $id);
    public function create(array $data);
    public function update(User $user, array $data);
    public function delete(int $id);
    public function restore(int $id);
}