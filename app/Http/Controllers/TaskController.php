<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {

    }

    public function create(TaskRequest $request)
    {
        $user = \Auth::user();
        $data = $request->only('name', 'description');
        $user->tasks()->create($data);

        return redirect()->back();
    }

    public function update(TaskRequest $request, $task)
    {

    }

    public function done(Request $request, $task)
    {
        $done = $request->only('done');
        $task = Task::findOrFail($task);
        if ($done) $task->setDone();
        else $task->unsetDone();
    }
}
