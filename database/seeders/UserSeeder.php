<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['user_type_id' => 1,
            'name'=> 'admin',
            'last_name'=>'user',
            'email'=>'admin.user@flexbot.com',
            'password'=> bcrypt('flexbot2024'),],
            [
              'user_type_id' => 2,
              'name' =>'test',
              'last_name' => 'user',
              'email' => 'test.user@flexboot.com',
              'password' => bcrypt('flexbot2024')
            ],
        ];
      
    
         DB::table('users')->insert($users);
        
    }
}
