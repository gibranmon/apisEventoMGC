<?php 

namespace App\Utils;

class GenerateCode
{
    public static function getCode() {
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i=0; $i < 3; $i++) {
            if($i == 2)
                $code .= substr(str_shuffle($permitted_chars), 0, 4);
            else
                $code .= substr(str_shuffle($permitted_chars), 0, 4).'-';
        }
        return $code;
    }
}