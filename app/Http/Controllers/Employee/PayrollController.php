<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Support\Facades\Auth;


class PayrollController extends Controller
{
    public function index()
    {
        $employee = Employee::where('user_id', Auth::id())->first();

        $payrolls = [];

        if ($employee) {
            $payrolls = Payroll::where('employee_id', $employee->id)
                ->latest()
                ->get();
        }

        return view('employee.payroll.index', compact('payrolls'));
    }
}