<?php

namespace App\Http\Requests;

class DataRequestAdapter
{
    public static function transformToUpper($array){
        return collect($array)->map(function($item){
            if(is_array($item)){
                return self::transformToUpper($item);
            }
            if(is_string($item)){
                return trim(strtoupper($item));
            }
            return $item;
        })->toArray();
    }
}