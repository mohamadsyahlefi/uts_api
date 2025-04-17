<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class JsonRpcController extends Controller
{
    public function handle(Request $request)
    {
        try {
            // Mendukung GET request dengan parameter query
            if ($request->isMethod('get')) {
                $data = $request->query();
                // Decode params jika dalam format string JSON
                if (isset($data['params']) && is_string($data['params'])) {
                    try {
                        $data['params'] = json_decode($data['params'], true);
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            throw new \Exception('Invalid JSON in params');
                        }
                    } catch (\Exception $e) {
                        Log::error('JSON decode error: ' . $e->getMessage());
                        return response()->json([
                            'jsonrpc' => '2.0',
                            'error' => [
                                'code' => -32700,
                                'message' => 'Parse error: Invalid JSON in params'
                            ],
                            'id' => null
                        ], 400);
                    }
                }
            } else {
                $data = $request->all();
            }

            // Log request data untuk debugging
            Log::info('Request data:', $data);

            $validator = Validator::make($data, [
                'jsonrpc' => 'required|in:2.0',
                'method' => 'required|string',
                'params' => 'required|array',
                'id' => 'required'
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed:', $validator->errors()->toArray());
                return response()->json([
                    'jsonrpc' => '2.0',
                    'error' => [
                        'code' => -32600,
                        'message' => 'Invalid Request: ' . $validator->errors()->first()
                    ],
                    'id' => null
                ], 400);
            }

            $method = $data['method'];
            $params = $data['params'];
            $id = $data['id'];

            if (!method_exists($this, $method)) {
                Log::error('Method not found: ' . $method);
                return response()->json([
                    'jsonrpc' => '2.0',
                    'error' => [
                        'code' => -32601,
                        'message' => 'Method not found'
                    ],
                    'id' => $id
                ], 404);
            }

            $result = $this->{$method}($params);
            return response()->json([
                'jsonrpc' => '2.0',
                'result' => $result,
                'id' => $id
            ]);

        } catch (\Exception $e) {
            Log::error('Server error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'jsonrpc' => '2.0',
                'error' => [
                    'code' => -32000,
                    'message' => 'Server error: ' . $e->getMessage()
                ],
                'id' => $data['id'] ?? null
            ], 500);
        }
    }

    // GET /tasks
    private function getTasks($params)
    {
        return Task::all();
    }

    // GET /tasks/{id}
    private function getTask($params)
    {
        try {
            $validator = Validator::make($params, [
                'id' => 'required|exists:tasks,id'
            ]);

            if ($validator->fails()) {
                throw new \Exception('Invalid parameters: ' . $validator->errors()->first());
            }

            return Task::findOrFail($params['id']);
        } catch (\Exception $e) {
            Log::error('getTask error: ' . $e->getMessage());
            throw $e;
        }
    }

    // POST /tasks
    private function createTask($params)
    {
        $validator = Validator::make($params, [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Selesai,Belum Dikerjakan'
        ]);

        if ($validator->fails()) {
            throw new \Exception('Invalid parameters');
        }

        return Task::create($params);
    }

    // PUT /tasks/{id}
    private function updateTask($params)
    {
        $validator = Validator::make($params, [
            'id' => 'required|exists:tasks,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'status' => 'sometimes|required|in:Selesai,Belum Dikerjakan'
        ]);

        if ($validator->fails()) {
            throw new \Exception('Invalid parameters');
        }

        $task = Task::findOrFail($params['id']);
        $task->update($params);
        return $task;
    }

    // DELETE /tasks/{id}
    private function deleteTask($params)
    {
        $validator = Validator::make($params, [
            'id' => 'required|exists:tasks,id'
        ]);

        if ($validator->fails()) {
            throw new \Exception('Invalid parameters');
        }

        $task = Task::findOrFail($params['id']);
        $task->delete();
        return ['success' => true];
    }

    // PATCH /tasks/{id}/status
    private function updateTaskStatus($params)
    {
        $validator = Validator::make($params, [
            'id' => 'required|exists:tasks,id',
            'status' => 'required|in:Selesai,Belum Dikerjakan'
        ]);

        if ($validator->fails()) {
            throw new \Exception('Invalid parameters');
        }

        $task = Task::findOrFail($params['id']);
        $task->update(['status' => $params['status']]);
        return $task;
    }

    // GET /tasks/search
    private function searchTasks($params)
    {
        $validator = Validator::make($params, [
            'query' => 'required|string|min:1'
        ]);

        if ($validator->fails()) {
            throw new \Exception('Invalid parameters');
        }

        return Task::where('title', 'like', '%' . $params['query'] . '%')
            ->orWhere('description', 'like', '%' . $params['query'] . '%')
            ->get();
    }
} 