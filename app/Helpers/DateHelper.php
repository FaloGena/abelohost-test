<?php


namespace App\Helpers;


use Carbon\CarbonInterval;

class DateHelper
{

    public static function secondsToTime($seconds)
    {
        return CarbonInterval::seconds($seconds)->cascade()->format('%H:%I:%S');
    }

    /**
     * Return array of short days of week starting with given day
     *
     * @param $day
     * @return array
     */
    public static function daysOfWeekStartingWith($day)
    {
        $daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $day = array_search($day, $daysOfWeek);
        $after = array_slice($daysOfWeek, $day);
        $before = array_slice($daysOfWeek, 0, $day);

        return array_merge($after, $before);
    }
}
