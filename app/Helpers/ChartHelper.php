<?php


namespace App\Helpers;


use App\Repositories\TaskRepository;
use Carbon\Carbon;

class ChartHelper
{

    /**
     * Return associated array (day of week short name => tasks done this day amount)
     * For last 7 days in order so today is the last
     * (if today is Wednesday it starts with last Thursday)
     *
     * @return array
     */
    public static function getChartLastWeek()
    {
        $weekAgo = now()->subDays(6)->startOfDay();
        $daysOfWeek = DateHelper::daysOfWeekStartingWith($weekAgo->shortEnglishDayOfWeek);
        $dates = (new TaskRepository())->getDoneEveryDaySince($weekAgo);

        foreach ($dates as $date) {// Convert collection to associated array: day of week => total tasks done this day
            $dayOfWeek = Carbon::parse($date->date)->shortEnglishDayOfWeek;
            $weekTasks[$dayOfWeek] = $date->count;
        }

        foreach($daysOfWeek as $day) {// Fill data in right order (so we end up on today) and set 0 count for no-task days
            $chartTasks[$day] = $weekTasks[$day] ?? 0;
        }

        return $chartTasks;
    }
}
