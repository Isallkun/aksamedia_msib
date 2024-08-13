<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with('division');

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('division_id')) {
            $query->where('division_id', $request->division_id);
        }

        $employees = $query->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => [
                'employees' => $employees->items(),
            ],
            'pagination' => [
                'current_page' => $employees->currentPage(),
                'last_page' => $employees->lastPage(),
                'per_page' => $employees->perPage(),
                'total' => $employees->total(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'division_id' => 'required|exists:divisions,id',
            'position' => 'required|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('images/employee', 'public');

        $employee = Employee::create([
            'image' => $imagePath,
            'name' => $request->name,
            'phone' => $request->phone,
            'division_id' => $request->division_id,
            'position' => $request->position,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Employee created successfully',
            'data' => $employee,
        ]);
    }

    public function update(Request $request, $id)
    {
        \Illuminate\Support\Facades\Log::info('Update method accessed with ID: ' . $id);

        $employee = Employee::find($id);
        if (!$employee) {
            \Illuminate\Support\Facades\Log::error('Employee not found with ID: ' . $id);
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found',
            ], 404);
        }

        $request->validate([
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'division_id' => 'required|exists:divisions,id',
            'position' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($employee->image) {
                Storage::disk('public')->delete($employee->image);
            }
            // Store new image
            $imagePath = $request->file('image')->store('images/employee', 'public');
            $employee->image = $imagePath;
        }

        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->division_id = $request->division_id;
        $employee->position = $request->position;
        $employee->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Employee updated successfully',
            'data' => $employee->load('division'),
        ]);
    }

    public function show($id)
    {
        $employee = Employee::with('division')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Employee retrieved successfully',
            'data' => $employee,
        ]);
    }
}
