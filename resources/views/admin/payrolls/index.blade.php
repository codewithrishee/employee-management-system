@extends('adminlte::page')

@section('title','Payroll')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>Payroll</h1>

    <div>

        <a href="{{ route('payrolls.pdf') }}"
           class="btn btn-danger">

            <i class="fas fa-file-pdf"></i>
            Export PDF

        </a>

        <a href="{{ route('payrolls.create') }}"
           class="btn btn-primary ml-2">

            <i class="fas fa-plus"></i>
            Add Payroll

        </a>

    </div>

</div>

@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
@endif

<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('payrolls.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search by employee name or ID"
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <input type="month"
                           name="month"
                           class="form-control"
                           value="{{ request('month') }}">
                </div>

                <div class="col-md-3">
                    <select name="payment_status" class="form-control">
                        <option value="">All Status</option>
                        <option value="Pending" {{ request('payment_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Paid" {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-search"></i> Search
                    </button>

                    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary btn-block mt-2">
                        Reset
                    </a>
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
                <th>Basic</th>
                <th>Bonus</th>
                <th>Deduction</th>
                <th>Net Salary</th>
                <th>Status</th>
                <th width="170">Action</th>

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

                <td>

                    <a href="{{ route('payrolls.edit',$payroll->id) }}"
                       class="btn btn-warning btn-sm">

                        <i class="fas fa-edit"></i>

                    </a>

                    <form action="{{ route('payrolls.destroy',$payroll->id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete Payroll?')">

                            <i class="fas fa-trash"></i>

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="9" class="text-center">

                    No Payroll Found

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $payrolls->links() }}

        </div>

    </div>

</div>

@stop