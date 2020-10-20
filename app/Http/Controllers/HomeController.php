<?php

namespace App\Http\Controllers;

use App\Traits\TaskStats;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use TaskStats;

    public function index()
    {
        if ($user = \Auth::user()) {
            // Tasks stats
            $user = $this->addTaskStats($user);
            // All tasks paginated
            $tasks = $user->tasks()->paginate(6);
            return view('index')->with(['user' => $user, 'tasks' => $tasks]);
        } else
            return view('index');
    }
}
