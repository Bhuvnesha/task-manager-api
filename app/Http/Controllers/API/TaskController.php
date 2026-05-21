<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class TaskController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $query = auth()->user()->tasks();

        if($request->search){
            $query = auth()->user()->tasks()->where('title', 'like', '%'.$request->search.'%');
        }

        if($request->status){
            $query = auth()->user()->tasks()->where('status', $request->status);
        }

        if($request->search && $request->status)
            {
                $query = auth()->user()->tasks()->where('title', 'like', '%'.$request->search.'%')->where('status',$request->status);
            }

        return TaskResource::collection(
            $query->latest()->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = auth()->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Task created successfully',
            'data' => new TaskResource($task)
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = auth()->user()->tasks()->find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task not found/not authorized'
            ], 404);
        }

        // if($task->user_id !== auth()->id()){
        //     return response()->json([
        //         'message' => 'Unauthorized'
        //     ], 403);
        // }
        $this->authorize('view', $task);

        return response()->json([
            'data' => new TaskResource($task)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = auth()->user()->tasks()->find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task not found/not authorized'
            ], 404);
        }

        // Security check
        // if ($task->user_id !== auth()->id()) {

        //     return response()->json([
        //         'message' => 'Unauthorized'
        //     ], 403);
        // }

        $this->authorize('update', $task);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return response()->json([
            'message' => 'Task updated successfully',
            'data' => new TaskResource($task)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = auth()->user()->tasks()->find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task not found/not authorized'
            ], 404);
        }

         // Security check
        // if ($task->user_id !== auth()->id()) {

        //     return response()->json([
        //         'message' => 'Unauthorized'
        //     ], 403);
        // }

        $this->authorize('delete', $task);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }
}
