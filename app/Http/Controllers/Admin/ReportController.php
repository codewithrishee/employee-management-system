<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Payroll;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

   public function employees(Request $request)
{
    $query = Employee::with([
        'department',
        'designation'
    ]);

    if ($request->filled('department_id')) {

        $query->where(
            'department_id',
            $request->department_id
        );

    }

    if ($request->filled('status')) {

        $query->where(
            'status',
            $request->status
        );

    }

    $employees = $query->paginate(10);

    $departments = Department::where('status',1)
                    ->orderBy('name')
                    ->get();

    return view(
        'admin.reports.employees',
        compact(
            'employees',
            'departments'
        )
    );
}

    public function attendance(Request $request)
{
    $query = Attendance::with('employee');

    if ($request->filled('employee_id')) {
        $query->where('employee_id', $request->employee_id);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('from_date')) {
        $query->whereDate('attendance_date', '>=', $request->from_date);
    }

    if ($request->filled('to_date')) {
        $query->whereDate('attendance_date', '<=', $request->to_date);
    }

    $attendances = $query->latest()->paginate(10);

    $employees = Employee::where('status',1)
                    ->orderBy('name')
                    ->get();

    return view(
        'admin.reports.attendance',
        compact(
            'attendances',
            'employees'
        )
    );
}

  public function leaves(Request $request)
{
    $query = Leave::with('employee');

    if ($request->filled('employee_id')) {
        $query->where('employee_id', $request->employee_id);
    }

    if ($request->filled('leave_type')) {
        $query->where('leave_type', $request->leave_type);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('from_date')) {
        $query->whereDate('from_date', '>=', $request->from_date);
    }

    if ($request->filled('to_date')) {
        $query->whereDate('to_date', '<=', $request->to_date);
    }

    $leaves = $query->latest()->paginate(10);

    $employees = Employee::where('status',1)
                    ->orderBy('name')
                    ->get();

    return view(
        'admin.reports.leaves',
        compact(
            'leaves',
            'employees'
        )
    );
}

  public function payrolls(Request $request)
{
    $query = Payroll::with('employee');

    if ($request->filled('employee_id')) {
        $query->where('employee_id', $request->employee_id);
    }

    if ($request->filled('month')) {
        $query->where('month', $request->month);
    }

    if ($request->filled('payment_status')) {
        $query->where('payment_status', $request->payment_status);
    }

    $payrolls = $query->latest()->paginate(10);

    $employees = Employee::where('status', 1)
        ->orderBy('name')
        ->get();

    return view(
        'admin.reports.payrolls',
        compact('payrolls', 'employees')
    );
}
}