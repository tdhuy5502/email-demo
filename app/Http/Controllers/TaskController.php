<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::all();

        return view('task')->with(['tasks' => $tasks]);
    }

    public function store(Request $request)
    {   
        $task = new Task();
        $task->name = $request->name;
        $task->save();

        $user = User::all();
        $message = [
            'type' => 'Create task',
            'task' => $task->name,
            'content' => 'Task Created !'
        ];

        SendEmail::dispatch($message , $user)->delay(now()->addMinutes(0));

        return redirect()->route('index');
    }

    public function delete($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect()->route('index');
    }
}
