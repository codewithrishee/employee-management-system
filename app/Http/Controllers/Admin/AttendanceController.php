<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class AttendanceController extends Controller
{
 public function index(Request $request)
{
    $query = Attendance::with('employee');

    // Employee Search
    if ($request->filled('search')) {

        $search = $request->search;

        $query->whereHas('employee', function ($q) use ($search) {

            $q->where('name', 'like', "%{$search}%")
              ->orWhere('employee_id', 'like', "%{$search}%");

        });

    }

    // Date Filter
    if ($request->filled('attendance_date')) {

        $query->whereDate('attendance_date', $request->attendance_date);

    }

    // Status Filter
    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }

    $attendances = $query->latest()->paginate(10);

    $attendances->appends($request->all());

    return view('admin.attendance.index', compact('attendances'));
}

   public function create()
{
    $employees = Employee::where('status', 1)
        ->orderBy('name')
        ->get();

    return view('admin.attendance.create', compact('employees'));
}

   public function store(Request $request)
{
    $request->validate([
        'employee_id'      => 'required|exists:employees,id',
        'attendance_date'  => 'required|date',
        'check_in'         => 'nullable',
        'check_out'        => 'nullable',
        'status'           => 'required',
        'remarks'          => 'nullable|max:255',
    ]);

    $exists = Attendance::where('employee_id', $request->employee_id)
        ->where('attendance_date', $request->attendance_date)
        ->exists();

    if ($exists) {
        return back()
            ->withInput()
            ->withErrors([
                'employee_id' => 'Attendance already marked for this employee on this date.'
            ]);
    }

    Attendance::create([
        'employee_id'     => $request->employee_id,
        'attendance_date' => $request->attendance_date,
        'check_in'        => $request->check_in,
        'check_out'       => $request->check_out,
        'status'          => $request->status,
        'remarks'         => $request->remarks,
    ]);

    return redirect()
        ->route('attendance.index')
        ->with('success', 'Attendance added successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

  public function edit(Attendance $attendance)
{
    $employees = Employee::where('status', 1)
        ->orderBy('name')
        ->get();

    return view('admin.attendance.edit', compact('attendance', 'employees'));
}

   public function update(Request $request, Attendance $attendance)
{
    $request->validate([
        'employee_id'     => 'required|exists:employees,id',
        'attendance_date' => 'required|date',
        'check_in'        => 'nullable',
        'check_out'       => 'nullable',
        'status'          => 'required',
        'remarks'         => 'nullable|max:255',
    ]);

    $exists = Attendance::where('employee_id', $request->employee_id)
        ->where('attendance_date', $request->attendance_date)
        ->where('id', '!=', $attendance->id)
        ->exists();

    if ($exists) {
        return back()
            ->withInput()
            ->withErrors([
                'employee_id' => 'Attendance already exists for this date.'
            ]);
    }

    $attendance->update([
        'employee_id'     => $request->employee_id,
        'attendance_date' => $request->attendance_date,
        'check_in'        => $request->check_in,
        'check_out'       => $request->check_out,
        'status'          => $request->status,
        'remarks'         => $request->remarks,
    ]);

    return redirect()
        ->route('attendance.index')
        ->with('success', 'Attendance updated successfully.');
}

   public function destroy(Attendance $attendance)
{
    $attendance->delete();

    return redirect()
        ->route('attendance.index')
        ->with('success', 'Attendance deleted successfully.');
}

public function exportPdf()
{
    $attendances = Attendance::with('employee')
                    ->orderByDesc('attendance_date')
                    ->get();

    $pdf = Pdf::loadView(
        'admin.attendance.pdf',
        compact('attendances')
    );

    return $pdf->download('attendance-report.pdf');
}
}
