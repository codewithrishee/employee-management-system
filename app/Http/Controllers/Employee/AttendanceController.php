<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $employee = Employee::where('user_id', Auth::id())->first();

        if (!$employee) {
            $attendances = new LengthAwarePaginator(
                [],
                0,
                10,
                LengthAwarePaginator::resolveCurrentPage(),
                [
                    'path' => $request->url(),
                    'query' => $request->query(),
                ]
            );

            return view('employee.attendance.index', [
                'attendances' => $attendances,
                'presentCount' => 0,
                'absentCount' => 0,
            ]);
        }

        $query = Attendance::where('employee_id', $employee->id);

        // Month Filter
        if ($request->filled('month')) {
            $month = explode('-', $request->month);

            if (
                count($month) === 2 &&
                checkdate((int) $month[1], 1, (int) $month[0])
            ) {
                $query->whereYear('attendance_date', (int) $month[0])
                    ->whereMonth('attendance_date', (int) $month[1]);
            }
        }

        $attendances = $query
            ->latest('attendance_date')
            ->paginate(10)
            ->withQueryString();

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
