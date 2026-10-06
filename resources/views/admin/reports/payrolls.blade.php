@extends('adminlte::page')

@section('title','Payroll Report')

@section('content_header')
<h1>Payroll Report</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form method="GET" action="{{ route('reports.payrolls') }}">

            <div class="row">

                <div class="col-md-4">

                    <label>Employee</label>

                    <select name="employee_id" class="form-control">

                        <option value="">All Employees</option>

                        @foreach($employees as $employee)

                        <option value="{{ $employee->id }}"
                            {{ request('employee_id') == $employee->id ? 'selected' : '' }}>

                            {{ $employee->employee_id }} - {{ $employee->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-3">

                    <label>Month</label>

                    <input type="month"
                           name="month"
                           class="form-control"
                           value="{{ request('month') }}">

                </div>

                <div class="col-md-3">

                    <label>Payment Status</label>

                    <select name="payment_status" class="form-control">

                        <option value="">All</option>

                        <option value="Pending"
                        {{ request('payment_status')=='Pending' ? 'selected' : '' }}>
                        Pending
                        </option>

                        <option value="Paid"
                        {{ request('payment_status')=='Paid' ? 'selected' : '' }}>
                        Paid
                        </option>

                    </select>

                </div>

                <div class="col-md-2 d-flex align-items-end">

                    <button class="btn btn-primary btn-block">
                        Search
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card">

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover">

            <thead>

            <tr>

                <th>#</th>
                <th>Employee</th>
                <th>Month</th>
                <th>Basic Salary</th>
                <th>Bonus</th>
                <th>Deduction</th>
                <th>Net Salary</th>
                <th>Status</th>

            </tr>

            </thead>

            <tbody>

            @forelse($payrolls as $payroll)

            <tr>

                <td>{{ $payrolls->firstItem() + $loop->index }}</td>

                <td>{{ $payroll->employee->name ?? '-' }}</td>

                <td>{{ $payroll->month }}</td>

                <td>₹{{ number_format($payroll->basic_salary,2) }}</td>

                <td>₹{{ number_format($payroll->bonus,2) }}</td>

                <td>₹{{ number_format($payroll->deduction,2) }}</td>

                <td>
                    <strong>
                        ₹{{ number_format($payroll->net_salary,2) }}
                    </strong>
                </td>

                <td>

                    @if($payroll->payment_status=='Paid')

                        <span class="badge badge-success">
                            Paid
                        </span>

                    @else

                        <span class="badge badge-warning">
                            Pending
                        </span>

                    @endif

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="8" class="text-center">

                    No Payroll Records Found

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

        {{ $payrolls->appends(request()->query())->links() }}

    </div>

</div>

@stop