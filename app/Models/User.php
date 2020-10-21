<?php

namespace App\Models;

use App\Helpers\DateHelper;
use App\Repositories\TaskRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function socialAccounts()
    {
        return $this->hasMany('App\Models\SocialAccount');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task')->orderByRaw('-done_at ASC');
    }

    /**
     * Return associated array (day of week short name => tasks done this day amount)
     * For last 7 days in order so today is the last
     * (if today is Wednesday it starts with last Thursday)
     *
     * @return array
     */
    public function getChartLastWeek()
    {
        $weekAgo = now()->subDays(6)->startOfDay();
        $daysOfWeek = DateHelper::daysOfWeekStartingWith($weekAgo->shortEnglishDayOfWeek);
        $dates = (new TaskRepository())->getDoneEveryDaySince($weekAgo, $this);

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
