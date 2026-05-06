<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', 1)->get();
        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);
        $data = array_merge($validated, [
            'user_id' => 1,
            'status' => 'pending',
        ]);
        $task = Task::create($data);
        return (new TaskResource($task))->response()->setStatusCode(201);

    }
    public function show(string $id)
    {
        $task = Task::where('user_id', 1)->findOrFail($id);
        return new TaskResource($task);
    }
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
        ]);
        $task = Task::where('user_id', 1)
            ->where('id', $id)
            ->firstOrFail();
        $task->update($validated);
        return new TaskResource($task);
    }
    public function destroy(string $id)
    {
        $task = Task::where('user_id', 1)
            ->where('id', $id)
            ->firstOrFail();
        $task->delete();
        return response()->json(null, 204);
    }
}
