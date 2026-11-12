@extends('admin.layouts.app')

@section('title', 'Leave Management')

@section('content_header')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Leave Management</h1>
    <div class="mt-2 mt-sm-0 d-flex gap-2">
        <a href="{{ route('leaves.pdf') }}" class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
        <a href="{{ route('leaves.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Leave
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
        <form action="{{ route('leaves.index') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search Employee Name / Employee ID" value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <select name="leave_type" class="form-select">
                        <option value="">All Leave Types</option>
                        <option value="Casual Leave" {{ request('leave_type') == 'Casual Leave' ? 'selected' : '' }}>Casual Leave</option>
                        <option value="Sick Leave" {{ request('leave_type') == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                        <option value="Emergency Leave" {{ request('leave_type') == 'Emergency Leave' ? 'selected' : '' }}>Emergency Leave</option>
                        <option value="Paid Leave" {{ request('leave_type') == 'Paid Leave' ? 'selected' : '' }}>Paid Leave</option>
                        <option value="Unpaid Leave" {{ request('leave_type') == 'Unpaid Leave' ? 'selected' : '' }}>Unpaid Leave</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <a href="{{ route('leaves.index') }}" class="btn btn-secondary w-100">
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
                    <th>Leave Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                    <th width="200" class="text-center">Approval</th>
                    <th width="120" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaves as $leave)
                    <tr>
                        <td>{{ $leaves->firstItem() + $loop->index }}</td>
                        <td>{{ $leave->employee->name ?? '-' }}</td>
                        <td>{{ $leave->leave_type }}</td>
                        <td>{{ $leave->from_date }}</td>
                        <td>{{ $leave->to_date }}</td>
                        <td>
                            @if($leave->status == 'Approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($leave->status == 'Rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @else
                                <!-- Yahan text-dark add kiya hai taaki black dikhe -->
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($leave->status == 'Pending')
                                <div class="d-flex justify-content-center gap-2">
                                    <form action="{{ route('leaves.approve', $leave->id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('leaves.reject', $leave->id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-muted fw-bold">Already {{ $leave->status }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('leaves.edit', $leave->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete Leave ?')" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">No Leave Records Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $leaves->links() }}
        </div>
    </div>
</div>

@stop