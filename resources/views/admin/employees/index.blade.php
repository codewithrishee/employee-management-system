@extends('admin.layouts.app')

@section('title', 'Employees')

@section('content_header')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Employees</h1>
    <div class="mt-2 mt-sm-0 d-flex gap-2">
        <a href="{{ route('employees.pdf') }}" class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Employee
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
        <form action="{{ route('employees.index') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, ID, or email" value="{{ request('search') }}">
                </div>

                <div class="col-md-4">
                    <select name="department_id" class="form-select">
                        <option value="">Filter by Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary px-4">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table Card -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
        <h3 class="card-title fw-bold text-dark fs-4">Employee List</h3>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th width="130" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($employees as $employee)
            <tr>
                <td>{{ $employees->firstItem() + $loop->index }}</td>
                <td class="text-center">
                    @if($employee->image)
                        <img src="{{ asset('uploads/employees/'.$employee->image) }}" width="40" height="40" class="rounded-circle object-fit-cover">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&background=random" width="40" class="rounded-circle">
                    @endif
                </td>
                <td>{{ $employee->employee_id }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->department->name ?? '-' }}</td>
                <td>{{ $employee->designation->name ?? '-' }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>
                    @if($employee->status)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
                <td class="text-center">
                    <!-- yahan buttons ke beech gap add kiya gaya hai -->
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete Employee ?')" class="btn btn-danger btn-sm" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center py-4 text-muted">No Employees Found</td>
            </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $employees->links() }}
        </div>
    </div>
</div>

@stop