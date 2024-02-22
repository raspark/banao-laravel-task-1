<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'task' => 'required|string',
            'user_id' => 'required|integer'
        ]);

        // Create a new task
        try{
            $task = Task::create([
                'task' => $request->task,
                'user_id' => $request->user_id
            ]);
            return response()->json(['task' => $task, 'status' => 1, 'message' => 'Task created successfully.'], 201);
        } catch (\Exception $e) {
            return response()->json(['task' => null, 'status' => 0, 'message' => 'There was an error during the creation of the task. Please try again.'], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        // Validate the request
        $request->validate([
            'task_id' => 'required|integer',
            'status' => 'required|in:pending,done'
        ]);
        
        // Update the status of the task
        try {
            // Find the task
            $task = Task::find($request->task_id);
            // Check if the task exists
            if (!$task) {
                return response()->json(['task' => null, 'status' => 0, 'message' => 'Task not found.'], 404);
            }

            $task->status = $request->status;
            $task->save();

            // message
            if ($request->status == 'done') {
                $message = 'Marked task as done.';
            }
            elseif ($request->status == 'pending') {
                $message = 'Marked task as pending.';
            }
            else {
                $message = null;
            }

            return response()->json(['task' => $task, 'status' => 1, 'message' => $message], 200);
        } catch (\Exception $e) {
            return response()->json(['task' => null, 'status' => 0, 'message' => 'There was an error during the update of the task status. Please try again.'], 500);
        }
    }
}
