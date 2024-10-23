<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
                ['name'=> 'Home','icon'=> 'fas fa-tachometer-alt','link'=>'/home','prioridad'=> '1','active'=> 1,],
                ['name'=> 'Users','icon'=> 'fa fa-users','link'=>'/users','prioridad'=> '2','active'=> 1,],
                ['name'=> 'Bots','icon'=> 'fa fa-qrcode','link'=>'/bots','prioridad'=> '3','active'=> 1,],
        ];
      
        DB::table('menus')->insert($menus);
    }
}
