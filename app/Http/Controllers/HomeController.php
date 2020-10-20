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
            $user = $this->addTaskStats($user);
            return view('index')->with(['user' => $user]);
        } else
            return view('index');
    }
}
