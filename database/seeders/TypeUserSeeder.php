<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TypeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
  
      Schema::disableForeignKeyConstraints(); 
      DB::table('user_type_details')->truncate();
      DB::table('user_types')->truncate();
      Schema::enableForeignKeyConstraints();
      


        $types =  [
                    ['name'=> 'Administrator','active'=> 1,],
                    ['name'=> 'Cliente','active'=> 1,],

                  ];
        $details = [
                //Administrator
                  ['user_type_id'=> 1,'menu_id'=> 1,'active'=> 1,],

                //client
                  ['user_type_id'=> 2,'menu_id'=> 1,'active'=> 1,],
      
                ];
      

          DB::table('user_types')->insert($types);
          DB::table('user_type_details')->insert($details);
      
    }
}
