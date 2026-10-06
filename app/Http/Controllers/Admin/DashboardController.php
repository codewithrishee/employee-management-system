<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Dashboard Cards
        $totalEmployees = Employee::count();
        $totalDepartments = Department::count();
        $totalDesignations = Designation::count();

        $presentToday = Attendance::whereDate('attendance_date', $today)
            ->where('status', 'Present')
            ->count();

        $absentToday = Attendance::whereDate('attendance_date', $today)
            ->where('status', 'Absent')
            ->count();

        $leaveToday = Leave::where('status', 'Approved')
            ->whereDate('from_date', '<=', $today)
            ->whereDate('to_date', '>=', $today)
            ->count();

        $totalPayroll = Payroll::sum('net_salary');

        // Recent Employees
        $recentEmployees = Employee::with('department')
            ->latest()
            ->take(5)
            ->get();

        // Recent Leaves
        $recentLeaves = Leave::with('employee')
            ->latest()
            ->take(5)
            ->get();

        $departmentChart = Department::leftJoin('employees', 'departments.id', '=', 'employees.department_id')
            ->select(
                'departments.name',
                DB::raw('COUNT(employees.id) as total')
            )
            ->groupBy('departments.name')
            ->get();

        $payrollChart = Payroll::select(

            'month',

            DB::raw('SUM(net_salary) as total_salary')

        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('dashboard', compact(
            'totalEmployees',
            'totalDepartments',
            'totalDesignations',
            'presentToday',
            'absentToday',
            'leaveToday',
            'totalPayroll',
            'recentEmployees',
            'recentLeaves',
            'departmentChart',
            'payrollChart'
        ));
    }
}