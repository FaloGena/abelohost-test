<?php


namespace App\Traits;


use App\Helpers\CarbonHelper;
use App\Models\User;

trait TaskStats
{

    /**
     * Gets and adds statistic values to User instance
     *
     * @param User $user
     * @return User
     */
    public function addTaskStats(User $user)
    {
        // Total tasks count
        $user->loadCount('tasks');

        // Total tasks done count
        $doneTasks = $user->tasks()->whereNotNull('done_at')->get();
        $user->done_tasks = $doneTasks->count();

        // Time stats
        if ($user->done_tasks > 0) {
            $totalTime = 0;
            foreach ($doneTasks as $task) {
                // Time in seconds for completion (done_at - created_at)
                $completionTime = $task->created_at->diffInSeconds($task->done_at);

                $minTime = (isset($minTime)) ? min($completionTime, $minTime) : $completionTime;
                $maxTime = (isset($maxTime)) ? max($completionTime, $maxTime) : $completionTime;
                $totalTime += $completionTime;
            }
            $minTime = CarbonHelper::secondsToTime($minTime);
            $maxTime = CarbonHelper::secondsToTime($maxTime);
            $avgTime = CarbonHelper::secondsToTime($totalTime / $user->done_tasks);
        } else { // If there are no completed tasks yet
            $minTime = $maxTime = $avgTime = '-';
        }

        $user->minTime = $minTime;
        $user->maxTime = $maxTime;
        $user->avgTime = $avgTime;

        return $user;
    }

}
