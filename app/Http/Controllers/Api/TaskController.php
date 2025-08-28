<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

/**
 * @group Tasks
 *
 * APIs for managing tasks
 */
class TaskController extends Controller
{
    /**
     * Get all tasks.
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "title": "Sample Task",
     *       "description": "This is a sample task.",
     *       "due_date": "2024-12-31T23:59:59Z",
     *       "is_completed": false,
     *       "created_at": "2024-01-01T12:00:00Z",
     *       "updated_at": "2024-01-01T12:00:00Z"
     *     }
     *   ]
     * }
     * @response 500 {"message": "Server Error"}
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Create a new task.
     *
     * @bodyParam title string required The title of the task. Example: "New Task"
     * @bodyParam description string The description of the task. Example: "This is a new task."
     * @bodyParam due_date date required The due date of the task. Example: 2024-12-31
     * @bodyParam is_completed boolean required Whether the task is completed. Example: false
     *
     * @response 201 {
     *   "id": 1,
     *   "title": "New Task",
     *   "description": "This is a new task.",
     *   "due_date": "2024-12-31T23:59:59Z",
     *   "is_completed": false,
     *   "created_at": "2024-01-01T12:00:00Z",
     *   "updated_at": "2024-01-01T12:00:00Z"
     * }
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {"title": ["The title field is required."]}
     * }
     * @response 500 {"message": "Server Error"}
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'is_completed' => 'required|boolean'
        ]);

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    /**
     * Show a specific task.
     *
     * @urlParam task int required The ID of the task. Example: 1
     *
     * @response 200 {
     *   "id": 1,
     *   "title": "Sample Task",
     *   "description": "This is a sample task.",
     *   "due_date": "2024-12-31T23:59:59Z",
     *   "is_completed": false,
     *   "created_at": "2024-01-01T12:00:00Z",
     *   "updated_at": "2024-01-01T12:00:00Z"
     * }
     * @response 404 {"message": "No query results for model [App\\Models\\Task] 999"}
     * @response 500 {"message": "Server Error"}
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Update a task.
     *
     * @urlParam task int required The ID of the task. Example: 1
     * @bodyParam title string The title of the task. Example: "Updated Task"
     * @bodyParam description string The description of the task. Example: "This task has been updated."
     * @bodyParam due_date date The due date of the task. Example: 2024-12-31
     * @bodyParam is_completed boolean Whether the task is completed. Example: true
     *
     * @response 200 {
     *   "id": 1,
     *   "title": "Updated Task",
     *   "description": "This task has been updated.",
     *   "due_date": "2024-12-31T23:59:59Z",
     *   "is_completed": true,
     *   "created_at": "2024-01-01T12:00:00Z",
     *   "updated_at": "2024-01-02T12:00:00Z"
     * }
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->all());
        return response()->json($task, 200);
    }

    /**
     * Delete a task.
     *
     * @urlParam task int required The ID of the task. Example: 1
     *
     * @response 204 null
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
