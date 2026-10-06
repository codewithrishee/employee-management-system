<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $employee = Employee::where('user_id', Auth::id())->first();

        if (!$employee) {

            return view('employee.attendance.index', [
                'attendances' => collect(),
                'presentCount' => 0,
                'absentCount' => 0,
            ]);

        }

        $query = Attendance::where('employee_id', $employee->id);

        // Month Filter
        if ($request->filled('month')) {

            $query->whereMonth('attendance_date', $request->month);

        }

        $attendances = $query
            ->latest('attendance_date')
            ->paginate(10);

        $presentCount = Attendance::where('employee_id', $employee->id)
            ->where('status', 'Present')
            ->count();

        $absentCount = Attendance::where('employee_id', $employee->id)
            ->where('status', 'Absent')
            ->count();

        return view('employee.attendance.index', compact(
            'attendances',
            'presentCount',
            'absentCount'
        ));
    }
}