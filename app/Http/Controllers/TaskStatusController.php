<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskStatuses = TaskStatus::paginate(10);

        return view('task_status.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task_status.create');
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
            'name' => 'required|unique:task_statuses|max:255'
        ]);

        $taskStatus = new TaskStatus();
        $taskStatus->fill($validated);
        $taskStatus->save();
        flash(__('flashes.task_status.store.success'))->success();

        return redirect()->route('task_statuses.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskStatus $taskStatus)
    {
        return view('task_status.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        $id = $taskStatus->id;
        $taskStatus = TaskStatus::find($id);

        abort_unless($taskStatus, 404);

        $validated = $this->validate($request, [
            'name' => 'required|unique:task_statuses|max:255'
        ]);

        $taskStatus->fill($validated);
        $taskStatus->save();

        flash(__('flashes.statuses.updated'))->success();
        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskStatus $taskStatus)
    {
        $id = $taskStatus->id;
        $taskStatus = TaskStatus::find($id);

        abort_unless($taskStatus, 404);

        if ($taskStatus->tasks()->exists()) {
            flash(__('flashes.task_status.delete.error'))->error();
            return back();
        }

        $taskStatus->delete();

        flash(__('flashes.statuses.deleted'))->success();
        return redirect()->route('task_statuses.index');
    }
}
