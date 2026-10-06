<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\LeaveStatusMail;
use Illuminate\Support\Facades\Mail;


class LeaveController extends Controller
{
public function index(Request $request)
{
    $query = Leave::with('employee');

    // Employee Search
    if ($request->filled('search')) {

        $search = $request->search;

        $query->whereHas('employee', function ($q) use ($search) {

            $q->where('name', 'like', "%{$search}%")
              ->orWhere('employee_id', 'like', "%{$search}%");

        });

    }

    // Leave Status
    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }

    // Leave Type
    if ($request->filled('leave_type')) {

        $query->where('leave_type', $request->leave_type);

    }

    $leaves = $query->latest()->paginate(10);

    $leaves->appends($request->all());

    return view('admin.leaves.index', compact('leaves'));
}

 public function create()
{
    $employees = Employee::where('status', 1)
        ->orderBy('name')
        ->get();

    return view('admin.leaves.create', compact('employees'));
}

 public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'leave_type'  => 'required|string|max:100',
        'from_date'   => 'required|date',
        'to_date'     => 'required|date|after_or_equal:from_date',
        'reason'      => 'required|string',
        'status'      => 'required|in:Pending,Approved,Rejected',
    ]);

    Leave::create([
        'employee_id' => $request->employee_id,
        'leave_type'  => $request->leave_type,
        'from_date'   => $request->from_date,
        'to_date'     => $request->to_date,
        'reason'      => $request->reason,
        'status'      => $request->status,
    ]);

    return redirect()
        ->route('leaves.index')
        ->with('success', 'Leave created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        //
    }

public function edit($id)
{
    $leave = Leave::findOrFail($id);

    $employees = Employee::where('status',1)->get();

    return view('admin.leaves.edit', compact('leave','employees'));
}

 public function update(Request $request, Leave $leave)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'leave_type'  => 'required|string|max:100',
        'from_date'   => 'required|date',
        'to_date'     => 'required|date|after_or_equal:from_date',
        'reason'      => 'required|string',
        'status'      => 'required|in:Pending,Approved,Rejected',
    ]);

    $leave->update([
        'employee_id' => $request->employee_id,
        'leave_type'  => $request->leave_type,
        'from_date'   => $request->from_date,
        'to_date'     => $request->to_date,
        'reason'      => $request->reason,
        'status'      => $request->status,
    ]);

    return redirect()
        ->route('leaves.index')
        ->with('success', 'Leave updated successfully.');
}

  public function destroy(Leave $leave)
{
    $leave->delete();

    return redirect()
        ->route('leaves.index')
        ->with('success', 'Leave deleted successfully.');
}


public function approve(Leave $leave)
{
    $leave->update([
        'status' => 'Approved'
    ]);

    $leave->load('employee.user');

    if ($leave->employee && $leave->employee->user) {

        Mail::to($leave->employee->user->email)
            ->send(new LeaveStatusMail($leave));

    }

    return redirect()
        ->route('leaves.index')
        ->with('success', 'Leave Approved Successfully.');
}

public function reject(Leave $leave)
{
    $leave->update([
        'status' => 'Rejected'
    ]);

    $leave->load('employee.user');

    if ($leave->employee && $leave->employee->user) {

        Mail::to($leave->employee->user->email)
            ->send(new LeaveStatusMail($leave));

    }

    return redirect()
        ->route('leaves.index')
        ->with('success', 'Leave Rejected Successfully.');
}


public function exportPdf()
{
    $leaves = Leave::with('employee')
                ->latest()
                ->get();

    $pdf = Pdf::loadView(
        'admin.leaves.pdf',
        compact('leaves')
    );

    return $pdf->download('leave-report.pdf');
}
}
