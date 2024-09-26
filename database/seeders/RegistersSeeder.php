<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name'=> 'users',],
            ['name'=> 'languages',],
            ['name'=> 'bots',],
            ['name'=> 'flows',],
        ];
      
    
        DB::table('registers')->insert($languages);
                        
    }
}
