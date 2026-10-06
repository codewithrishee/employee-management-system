<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
public function index(Request $request)
{
    $query = Employee::with(['department', 'designation']);

    // Search by Name, Email, Employee ID
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('name', 'like', "%{$search}%")
              ->orWhere('employee_id', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");

        });

    }

    // Department Filter
    if ($request->filled('department_id')) {

        $query->where('department_id', $request->department_id);

    }

    $employees = $query->latest()->paginate(10);

    // Pagination me filter preserve karega
    $employees->appends($request->all());

    $departments = Department::where('status',1)
        ->orderBy('name')
        ->get();

    return view('admin.employees.index', compact(
        'employees',
        'departments'
    ));
}

    public function create()
    {
        $departments = Department::where('status', 1)
            ->orderBy('name')
            ->get();

        $designations = Designation::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.employees.create', compact('departments', 'designations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id'  => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:employees,email',
            'phone'          => 'required|max:15',
            'salary'         => 'required|numeric|min:0',
            'joining_date'   => 'required|date',
            'gender'         => 'required|in:Male,Female,Other',
            'date_of_birth'  => 'nullable|date',
            'address'        => 'nullable|string',
            'status'         => 'required|boolean',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $imageName = time().'_'.$request->image->getClientOriginalName();

            $request->image->move(
                public_path('uploads/employees'),
                $imageName
            );
        }

        $lastEmployee = Employee::latest('id')->first();

        $nextNumber = $lastEmployee
            ? ((int) substr($lastEmployee->employee_id, 3)) + 1
            : 1;

        Employee::create([

            'employee_id'   => 'EMP'.str_pad($nextNumber, 4, '0', STR_PAD_LEFT),
            'department_id' => $request->department_id,
            'designation_id'=> $request->designation_id,
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'salary'        => $request->salary,
            'joining_date'  => $request->joining_date,
            'gender'        => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address'       => $request->address,
            'image'         => $imageName,
            'status'        => $request->status,

        ]);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee added successfully.');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        $departments = Department::where('status', 1)
            ->orderBy('name')
            ->get();

        $designations = Designation::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.employees.edit', compact(
            'employee',
            'departments',
            'designations'
        ));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'department_id'  => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:employees,email,' . $employee->id,
            'phone'          => 'required|max:15',
            'salary'         => 'required|numeric|min:0',
            'joining_date'   => 'required|date',
            'gender'         => 'required|in:Male,Female,Other',
            'date_of_birth'  => 'nullable|date',
            'address'        => 'nullable|string',
            'status'         => 'required|boolean',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = $employee->image;

        if ($request->hasFile('image')) {

            if ($employee->image && file_exists(public_path('uploads/employees/'.$employee->image))) {
                unlink(public_path('uploads/employees/'.$employee->image));
            }

            $imageName = time().'_'.$request->image->getClientOriginalName();

            $request->image->move(
                public_path('uploads/employees'),
                $imageName
            );
        }

        $employee->update([

            'department_id' => $request->department_id,
            'designation_id'=> $request->designation_id,
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'salary'        => $request->salary,
            'joining_date'  => $request->joining_date,
            'gender'        => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address'       => $request->address,
            'image'         => $imageName,
            'status'        => $request->status,

        ]);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->image && file_exists(public_path('uploads/employees/'.$employee->image))) {

            unlink(public_path('uploads/employees/'.$employee->image));
        }

        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }

    public function exportPdf()
{
    $employees = Employee::with(['department','designation'])
                    ->orderBy('name')
                    ->get();

    $pdf = Pdf::loadView(
        'admin.employees.pdf',
        compact('employees')
    );

    return $pdf->download('employees-report.pdf');
}

public function exportExcel()
{
    return Excel::download(
        new EmployeesExport,
        'employees.xlsx'
    );
}
}