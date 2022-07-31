<?php

namespace App\Http\Controllers;

use App\Models\{
    Task,
    TaskStatus,
    User,
    Label
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    // public function __construct()
    // {
    //     $this->authorizeResource(Task::class);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate(10);
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('task.create', compact('taskStatuses', 'users', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|unique:tasks',
            'status_id' => 'required|exists:task_statuses,id',
            'description' => 'nullable|string',
            'assigned_to_id' => 'nullable|integer',
        ]);

        $currentUser = Auth::user();

        $task = $currentUser->createdTasks()->make($validated);
        $task->save();
        flash(__('flashes.tasks.store.success'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('task.edit', compact('task', 'taskStatuses', 'users', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validated = $this->validate($request, [
            'name' => 'required|unique:tasks,name,' . $task->id,
            'description' => 'nullable|string',
            'assigned_to_id' => 'nullable|integer',
            'status_id' => 'required|integer',
        ]);

        $labels = collect($request->input('labels'))
            ->filter(fn($label) => $label !== null);
        $task->labels()->sync($labels);

        $task->fill($validated);
        $task->save();
        flash(__('flashes.tasks.updated'))->success();

        return redirect()->route('tasks.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $id = $task->id;
        $task = Task::find($id);

        abort_unless($task, 404);

        $task->labels()->detach();
        $task->delete();
        flash(__('flashes.tasks.deleted'))->success();

        return redirect()->route('tasks.index');
    }
}
