<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
public function index()
{
    $departments = Department::latest()->paginate(10);

    return view('admin.departments.index', compact('departments'));
}

public function create()
{
    return view('admin.departments.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:departments,name',
        'code' => 'required|unique:departments,code',
        'description' => 'nullable',
        'status' => 'required|boolean',
    ]);

    Department::create([
        'name' => $request->name,
        'code' => $request->code,
        'description' => $request->description,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('departments.index')
        ->with('success', 'Department created successfully.');
}


    public function show(Department $department)
    {
        //
    }

public function edit(Department $department)
{
    return view('admin.departments.edit', compact('department'));
}

  public function update(Request $request, Department $department)
{
    $request->validate([
        'name' => 'required|unique:departments,name,' . $department->id,
        'code' => 'required|unique:departments,code,' . $department->id,
        'description' => 'nullable',
        'status' => 'required|boolean',
    ]);

    $department->update([
        'name' => $request->name,
        'code' => $request->code,
        'description' => $request->description,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('departments.index')
        ->with('success', 'Department updated successfully.');
}

  public function destroy(Department $department)
{
    $department->delete();

    return redirect()
        ->route('departments.index')
        ->with('success', 'Department deleted successfully.');
}
}
