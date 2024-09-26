<?php
use App\Models\UserTypeDetail;


if (!function_exists('validateAccess')) {
 
   
    function validateAccess($user,$menu_id,$location)
    {

        if($user && $menu_id){
            //validate access of user     
            $access=UserTypeDetail::where('user_type_id',$user->user_type_id)
                                    ->where('menu_id',$menu_id)
                                    ->where('active',1)
                                    ->exists();

        }else{

            $access=false;
        }

      return $access;
    }
}

if (!function_exists('Answer')) {

    function validate_title($type){
        switch ($type) {
            case "success":
                $res='Success!';
            break;
            case "danger":
                $res='Error!';
            break;
            case "warning":
                $res='Warning!';
            break;
            case "info":
                $res='Information!';
            break;
            default:
                $res='Success';
          }
          return $res;
    }
    function validate_text($type){
        switch ($type) {
            case "success":
                $res='Action completed';
            break;
            case "danger":
                $res='Error in action';
            break;
            case "warning":
                $res='Caution with this action';
            break;
            case "info":
                $res='Check the following information';
            break;
            default:
                $res='Action completed';
          }
          return $res;
    }

    
    function validate_color($color){
        switch ($color) {
            case "green":
                $res='#c3e6cb';
            break;
            case "red":
                $res='#ed969e';
            break;
            case "yellow":
                $res='#ffdf7e';
            break;
            case "cyan":
                $res='#d1ecf1';
            break;
            default:
                $res='#c3e6cb';
          }
          return $res;
    }



    function Answer($id,$nameIn ="",$textIn ="",$typeIn ="",$colorIn="",$statusIn="",$titleIn ="",$data=""){

            $cleanType = trim($typeIn);
            $type = (strlen($cleanType) > 0)? $typeIn:'success';

            $cleanTitle = trim($titleIn);
            $title = (strlen($cleanTitle) > 0)? $titleIn:validate_title($type);
    
            $cleanText = trim($textIn);
            $text = (strlen($cleanText) > 0)? $textIn:validate_text($type);
    
            $cleanName = trim($nameIn);
            $name = (strlen($cleanName) > 0)? $nameIn:'Item';
            
            $cleancolor = trim($colorIn);
            $color = validate_color($cleancolor);

            $cleanData = isset($data)?$data:[];
            $cleanStatus = trim($statusIn);
            $status = (strlen($cleanType) > 0)? $statusIn:'all';
            $answer = [
                        'title'=>$title.': ',
                        'text'=>$name.' '.$text.'!',
                        'name'=>$name.$id,
                        'type'=>$type,
                        'order'=>'desc',
                        'status'=> $status,
                        'color'=>$color,
                        'id'=>$id,
                        'data'=>$cleanData,
                    ];
                    
        return $answer;
    }
}
