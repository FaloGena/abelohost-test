<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $dates = [
        'done_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function setDone()
    {
        $now = now();
        $this->done_at = $now;
        $this->save();

        return $now;
    }

    public function unsetDone()
    {
        $this->done_at = null;
        $this->save();
    }
}
