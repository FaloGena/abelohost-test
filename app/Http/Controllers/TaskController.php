<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show(Task $task)
    {
        return view('task')->with(['task' => $task]);
    }

    public function create(TaskRequest $request)
    {
        $user = \Auth::user();
        $data = $request->only('name', 'description');
        $user->tasks()->create($data);

        return redirect()->back();
    }

    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->only('name', 'description');
        $task->update($data);

        // Completeness checkbox
        $done = $request->only('done');
        if ($done) $task->setDone();
        else $task->unsetDone();

        return redirect()->route('home');
    }

    public function done(Request $request, Task $task)
    {
        $done = $request->only('done');
        if ($done) $task->setDone();
        else $task->unsetDone();
    }

    public function delete(Request $request, Task $task)
    {
        try {
            $task->delete();
        } catch (\Exception $e) {
            //
        }

        return redirect()->route('home');
    }
}
