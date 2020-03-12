<?php

namespace App\Helpers;

class Status
{
    public static function getStatus($type)
    {
        $set=[0=>'No Action',1=>'Yes',2=>'No',3=>'Maybe'];
        return $set[$type];
    }
}
