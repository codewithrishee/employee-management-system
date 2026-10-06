<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\Department;

class DesignationController extends Controller
{
  public function index()
{
    $designations = Designation::with('department')
        ->latest()
        ->paginate(10);

    return view('admin.designations.index', compact('designations'));
} 
   public function create()
{
    $departments = Department::where('status', 1)
        ->orderBy('name')
        ->get();

    return view('admin.designations.create', compact('departments'));
}

   public function store(Request $request)
{
    $request->validate([
        'department_id' => 'required|exists:departments,id',
        'name'          => 'required|max:255',
        'description'   => 'nullable',
        'status'        => 'required|boolean',
    ]);

    Designation::create([
        'department_id' => $request->department_id,
        'name'          => $request->name,
        'description'   => $request->description,
        'status'        => $request->status,
    ]);

    return redirect()
        ->route('designations.index')
        ->with('success', 'Designation created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        //
    }

   public function edit($id)
{
    $designation = Designation::findOrFail($id);

    $departments = Department::where('status', 1)
        ->orderBy('name')
        ->get();

    return view('admin.designations.edit', compact('designation', 'departments'));
}


public function update(Request $request, $id)
{
    $designation = Designation::findOrFail($id);

    $request->validate([
        'department_id' => 'required|exists:departments,id',
        'name'          => 'required|max:255',
        'description'   => 'nullable',
        'status'        => 'required|boolean',
    ]);

    $designation->update([
        'department_id' => $request->department_id,
        'name'          => $request->name,
        'description'   => $request->description,
        'status'        => $request->status,
    ]);

    return redirect()
        ->route('designations.index')
        ->with('success', 'Designation updated successfully.');
}


public function destroy($id)
{
    Designation::findOrFail($id)->delete();

    return redirect()
        ->route('designations.index')
        ->with('success', 'Designation deleted successfully.');
}
}
