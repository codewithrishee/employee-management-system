<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Illuminate\Http\Request;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;

class PayrollController extends Controller
{
public function index(Request $request)
{
    $query = Payroll::with('employee');

    // Employee Search
    if ($request->filled('search')) {

        $search = $request->search;

        $query->whereHas('employee', function ($q) use ($search) {

            $q->where('name', 'like', "%{$search}%")
              ->orWhere('employee_id', 'like', "%{$search}%");

        });

    }

    // Month Filter
    if ($request->filled('month')) {

        $query->where('month', $request->month);

    }

    // Payment Status
    if ($request->filled('payment_status')) {

        $query->where('payment_status', $request->payment_status);

    }

    $payrolls = $query->latest()->paginate(10);

    $payrolls->appends($request->all());

    return view('admin.payrolls.index', compact('payrolls'));
}

   public function create()
{
    $employees = Employee::where('status',1)
        ->orderBy('name')
        ->get();

    return view('admin.payrolls.create', compact('employees'));
}

   public function store(Request $request)
{
    $request->validate([
        'employee_id'    => 'required|exists:employees,id',
        'month'          => 'required',
        'basic_salary'   => 'required|numeric',
        'bonus'          => 'nullable|numeric',
        'deduction'      => 'nullable|numeric',
        'payment_status' => 'required',
        'payment_date'   => 'nullable|date',
    ]);

    $bonus = $request->bonus ?? 0;
    $deduction = $request->deduction ?? 0;

    $netSalary = $request->basic_salary + $bonus - $deduction;

    Payroll::create([

        'employee_id'    => $request->employee_id,
        'month'          => $request->month,
        'basic_salary'   => $request->basic_salary,
        'bonus'          => $bonus,
        'deduction'      => $deduction,
        'net_salary'     => $netSalary,
        'payment_status' => $request->payment_status,
        'payment_date'   => $request->payment_date,

    ]);

    return redirect()
        ->route('payrolls.index')
        ->with('success','Payroll added successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        //
    }

    public function edit($id)
{
    $payroll = Payroll::findOrFail($id);

    $employees = Employee::where('status',1)
        ->orderBy('name')
        ->get();

    return view('admin.payrolls.edit', compact('payroll','employees'));
}

   public function update(Request $request, $id)
{
    $payroll = Payroll::findOrFail($id);

    $request->validate([
        'employee_id'    => 'required|exists:employees,id',
        'month'          => 'required',
        'basic_salary'   => 'required|numeric',
        'bonus'          => 'nullable|numeric',
        'deduction'      => 'nullable|numeric',
        'payment_status' => 'required',
        'payment_date'   => 'nullable|date',
    ]);

    $bonus = $request->bonus ?? 0;
    $deduction = $request->deduction ?? 0;

    $netSalary = $request->basic_salary + $bonus - $deduction;

    $payroll->update([

        'employee_id'    => $request->employee_id,
        'month'          => $request->month,
        'basic_salary'   => $request->basic_salary,
        'bonus'          => $bonus,
        'deduction'      => $deduction,
        'net_salary'     => $netSalary,
        'payment_status' => $request->payment_status,
        'payment_date'   => $request->payment_date,

    ]);

    return redirect()
        ->route('payrolls.index')
        ->with('success','Payroll updated successfully.');
}

   public function destroy($id)
{
    Payroll::findOrFail($id)->delete();

    return redirect()
        ->route('payrolls.index')
        ->with('success','Payroll deleted successfully.');
}
public function exportPdf()
{
    $payrolls = Payroll::with('employee')
                    ->latest()
                    ->get();

    $pdf = Pdf::loadView(
        'admin.payrolls.pdf',
        compact('payrolls')
    );

    return $pdf->download('payroll-report.pdf');
}
}
