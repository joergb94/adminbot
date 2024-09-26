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
            ['name'=> 'Categories','icon'=> 'fa fa-qrcode','link'=>'/categories','prioridad'=> '5','active'=> 1,],
            ['name'=> 'Providers','icon'=> 'fa fa-dollar','link'=>'/providers','prioridad'=> '5','active'=> 1,],
            ['name'=> 'Inventory','icon'=> 'fa fa-barcode','link'=>'/inventories','prioridad'=> '5','active'=> 1,],
            ['name'=> 'Employees','icon'=> 'fa fa-user','link'=>'/clients','prioridad'=> '4','active'=> 1,],
            ['name'=> 'Clients', 'icon' => 'fa fa-address-book', 'link'=>'/type_client', 'prioridad' => '4', 'active' => 1],
            ['name'=> 'Purchases','icon'=> 'fa fa-book','link'=>'/purchases','prioridad'=> '6','active'=> 1,],
            ['name'=> 'Deliveries','icon'=> 'fa fa-truck','link'=>'/sales','prioridad'=> '6','active'=> 1,],
            ['name'=> 'Reports Of Places ','icon'=> 'fa fa-table','link'=>'/ubications','prioridad'=> '7','active'=> 1,],
            ['name'=> 'Reports Of Devices','icon'=> 'fa fa-table','link'=>'/reports','prioridad'=> '7','active'=> 1,],
            ['name' => 'AuditsReports', 'icon' => 'fa fa-address-book', 'link'=>'/auditsreports', 'prioridad' => '8', 'active' => '1'],
            ['name' => 'Reminders', 'icon' => 'fas fa-sticky-note', 'link'=>'/reminders', 'prioridad' => '8', 'active' => '1'],
            ['name' => 'Type of Employee', 'icon' => 'fa fa-id-badge', 'link'=>'/work_type', 'prioridad' => '4', 'active' => 1],
            ['name' => 'Cost Center Administration', 'icon' => 'fa fa-usd', 'link'=>'/cost-center', 'prioridad' => '7', 'active' => 1],
      ];
      
     
        DB::table('menus')->insert($menus);
    }
}
