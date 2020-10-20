<?php


namespace App\Repositories;

use App\Models\Task as Model;
use Illuminate\Support\Facades\DB;

class TaskRepository extends BaseRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Get collection grouped by date (day) with amount of tasks done this day
     * Starting with date given till now
     *
     * @param $date
     * @return mixed
     */
    public function getDoneEveryDaySince($date)
    {
        $dates = $this->startConditions()
            ->where('done_at', '>=', $date)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                DB::raw('Date(done_at) as date'),
                DB::raw('COUNT(*) as "count"')
            ));

        return $dates;
    }
}
