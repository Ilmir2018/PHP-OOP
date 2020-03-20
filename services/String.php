<?php


namespace app\services;


class String
{

    public function substr($string, $length = 100){
        return mb_substr($string, 0, $length);
    }

}