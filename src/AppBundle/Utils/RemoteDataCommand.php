<?php
namespace AppBundle\Utils;


class RemoteDataCommand
{
    public static function Run($URL){
        $commString = 'curl -X GET '.$URL;
        exec($commString, $output);
        return self::array_to_text($output);
    }
    public static function array_to_text($arr){
        $reData ="";
        foreach ($arr as $item){
            $reData.=$item;
        }
        return $reData;
    }
}