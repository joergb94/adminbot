<?php

namespace App\Traits;

trait StringTrait {

    function createSlug($str){
        $out = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $out = substr(preg_replace("/[^-\/+|\w ]/", '', $out), 0, strlen($str));
        $out = strtolower(trim($out, '-'));
        return preg_replace("/[\/_| -]+/", '-', $out);
    }

}