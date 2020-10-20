<?php


namespace App\Helpers;


use Carbon\CarbonInterval;

class CarbonHelper
{

    public static function secondsToTime($seconds)
    {
        return CarbonInterval::seconds($seconds)->cascade()->format('%H:%I:%S');
    }
}
