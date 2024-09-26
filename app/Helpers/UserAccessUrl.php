<?php

use App\Models\UserTypeDetail;
use Illuminate\Support\Facades\Auth;

if (!function_exists('accesUrl')) {
 
   
    function accesUrl($user,$menu_id,$location)
    {
   
        //validate access of user     
        $access= UserTypeDetail::where('user_type_id',$user->user_type_id)
                                ->where('menu_id',$menu_id)
                                ->where('active',1)
                                ->exists();
        if($access == true){
          //get all data for user menu
          $menuU = UserTypeDetail::select('menu.id as id','menu.name as name','menu.icon as icon','menu.link as link')
                                    ->join('menus as menu', 'user_type_details.menu_id', '=', 'menu.id')
                                    ->where('user_type_details.user_type_id',$user->user_type_id)
                                    ->orderBy('menu.prioridad')->get();
              
        
          $menu=$menuU;
          $type_user = $user->user_type_id;
        
        }else{
          
           $menu=[];
           $type_user =0;
           $location_use = [];
        }
       

        $menu=[
          'menu'=>$menu,
          'access'=>$access,
          'type_user'=>$type_user,
          'user'=>Auth::user(),
        ];  
        
      return $menu;
    }
}
