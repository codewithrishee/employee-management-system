<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Payroll;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

       $employee = Employee::with(['department', 'designation'])
    ->where('user_id', $user->id)
    ->first();

        if (!$employee) {
            return view('employee.dashboard', [
                'user' => $user,
                'employee' => null,
                'presentCount' => 0,
                'pendingLeaves' => 0,
                'approvedLeaves' => 0,
                'latestSalary' => null,
                'recentAttendance' => collect(),
                'recentLeaves' => collect(),
            ]);
        }

        $presentCount = Attendance::where('employee_id', $employee->id)
            ->where('status', 'Present')
            ->count();

        $pendingLeaves = Leave::where('employee_id', $employee->id)
            ->where('status', 'Pending')
            ->count();

        $approvedLeaves = Leave::where('employee_id', $employee->id)
            ->where('status', 'Approved')
            ->count();

        $latestSalary = Payroll::where('employee_id', $employee->id)
            ->latest()
            ->first();

        $recentAttendance = Attendance::where('employee_id', $employee->id)
            ->latest('attendance_date')
            ->take(5)
            ->get();

        $recentLeaves = Leave::where('employee_id', $employee->id)
            ->latest()
            ->take(5)
            ->get();

        return view('employee.dashboard', compact(
            'user',
            'employee',
            'presentCount',
            'pendingLeaves',
            'approvedLeaves',
            'latestSalary',
            'recentAttendance',
            'recentLeaves'
        ));
    }
}