@extends('adminlte::page')

@section('title','Employee Report')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>Employee Report</h1>

    <a href="{{ route('employees.pdf') }}"
       class="btn btn-danger">

        <i class="fas fa-file-pdf"></i>
        Export PDF

    </a>

</div>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form method="GET"
              action="{{ route('reports.employees') }}">

            <div class="row">

                <div class="col-md-5">

                    <label>Department</label>

                    <select name="department_id"
                            class="form-control">

                        <option value="">

                            All Departments

                        </option>

                        @foreach($departments as $department)

                        <option value="{{ $department->id }}"
                        {{ request('department_id')==$department->id ? 'selected' : '' }}>

                            {{ $department->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-5">

                    <label>Status</label>

                    <select name="status"
                            class="form-control">

                        <option value="">All Status</option>

                        <option value="1"
                        {{ request('status')==='1' ? 'selected' : '' }}>

                            Active

                        </option>

                        <option value="0"
                        {{ request('status')==='0' ? 'selected' : '' }}>

                            Inactive

                        </option>

                    </select>

                </div>

                <div class="col-md-2 d-flex align-items-end">

                    <button class="btn btn-primary btn-block">

                        <i class="fas fa-search"></i>

                        Search

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Employee Report

        </h3>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover">

            <thead>

            <tr>

                <th>#</th>

                <th>Employee ID</th>

                <th>Name</th>

                <th>Department</th>

                <th>Designation</th>

                <th>Email</th>

                <th>Phone</th>

                <th>Status</th>

            </tr>

            </thead>

            <tbody>

            @forelse($employees as $employee)

            <tr>

                <td>

                    {{ $employees->firstItem()+$loop->index }}

                </td>

                <td>

                    {{ $employee->employee_id }}

                </td>

                <td>

                    {{ $employee->name }}

                </td>

                <td>

                    {{ $employee->department->name ?? '-' }}

                </td>

                <td>

                    {{ $employee->designation->name ?? '-' }}

                </td>

                <td>

                    {{ $employee->email }}

                </td>

                <td>

                    {{ $employee->phone }}

                </td>

                <td>

                    @if($employee->status)

                        <span class="badge badge-success">

                            Active

                        </span>

                    @else

                        <span class="badge badge-danger">

                            Inactive

                        </span>

                    @endif

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="8"
                    class="text-center">

                    No Employees Found

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $employees->appends(request()->query())->links() }}

        </div>

    </div>

</div>

@stop