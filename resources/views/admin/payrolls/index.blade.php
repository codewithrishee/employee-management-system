@extends('admin.layouts.app')

@section('title', 'Payroll')

@section('content_header')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Payroll</h1>
    <div class="mt-2 mt-sm-0 d-flex gap-2">
        <a href="{{ route('payrolls.pdf') }}" class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
        <a href="{{ route('payrolls.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Payroll
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

<!-- Filter Card -->
<div class="card mb-3 shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('payrolls.index') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by employee name or ID" value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <input type="month" name="month" class="form-control" value="{{ request('month') }}">
                </div>

                <div class="col-md-3">
                    <select name="payment_status" class="form-select">
                        <option value="">All Status</option>
                        <option value="Pending" {{ request('payment_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Paid" {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary w-100">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table Card -->
<div class="card shadow-sm border-0">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Month</th>
                <th>Basic</th>
                <th>Bonus</th>
                <th>Deduction</th>
                <th>Net Salary</th>
                <th>Status</th>
                <th width="120" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($payrolls as $payroll)
            <tr>
                <td>{{ $payrolls->firstItem() + $loop->index }}</td>
                <td>{{ $payroll->employee->name ?? '-' }}</td>
                <td>{{ $payroll->month }}</td>
                <td>₹{{ number_format($payroll->basic_salary, 2) }}</td>
                <td>₹{{ number_format($payroll->bonus, 2) }}</td>
                <td>₹{{ number_format($payroll->deduction, 2) }}</td>
                <td>
                    <strong>₹{{ number_format($payroll->net_salary, 2) }}</strong>
                </td>
                <td>
                    @if($payroll->payment_status == 'Paid')
                        <span class="badge bg-success">Paid</span>
                    @else
                        <!-- text-dark add kiya taaki text black dikhe -->
                        <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </td>
                <td class="text-center">
                    <!-- Buttons ke beech gap aur alignment fix -->
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete Payroll?')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center py-4 text-muted">No Payroll Found</td>
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