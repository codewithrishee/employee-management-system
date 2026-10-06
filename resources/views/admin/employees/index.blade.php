@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>Employees</h1>

    <div>

        <a href="{{ route('employees.pdf') }}"
           class="btn btn-danger mr-2">

            <i class="fas fa-file-pdf"></i>
            Export PDF

        </a>

        <a href="{{ route('employees.create') }}"
           class="btn btn-primary">

            <i class="fas fa-plus"></i>
            Add Employee

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
        <form action="{{ route('employees.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search by name, ID, or email"
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-4">
                    <select name="department_id" class="form-control">
                        <option value="">Filter by Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>

                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Employee List</h3>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
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
                <th width="180">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($employees as $employee)
            <tr>
                <td>{{ $employees->firstItem() + $loop->index }}</td>
                <td>
                    @if($employee->image)
                        <img src="{{ asset('uploads/employees/'.$employee->image) }}"
                             width="45"
                             height="45"
                             class="rounded-circle">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}"
                             width="45"
                             class="rounded-circle">
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
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete Employee ?')" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center">No Employees Found</td>
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