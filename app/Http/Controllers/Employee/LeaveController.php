<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;


class LeaveController extends Controller
{
   public function index()
{
    $employee = Employee::where('user_id', Auth::id())->first();

    $leaves = [];

    if ($employee) {
        $leaves = Leave::where('employee_id', $employee->id)
            ->latest()
            ->get();
    }

    return view('employee.leaves.index', compact('leaves'));
}

    public function create()
    {
        return view('employee.leaves.create');
    }

  public function store(Request $request)
{
    $request->validate([
        'leave_type' => 'required',
        'from_date'  => 'required|date',
        'to_date'    => 'required|date|after_or_equal:from_date',
        'reason'     => 'required|max:500',
    ]);

    $employee = Employee::where('user_id', Auth::id())->first();

    if (!$employee) {
        return back()->with('error', 'Employee record not found.');
    }

    Leave::create([
        'employee_id' => $employee->id,
        'leave_type'  => $request->leave_type,
        'from_date'   => $request->from_date,
        'to_date'     => $request->to_date,
        'reason'      => $request->reason,
        'status'      => 'Pending',
    ]);

    return redirect()->route('employee.leaves.index')
        ->with('success', 'Leave Applied Successfully.');
}
}