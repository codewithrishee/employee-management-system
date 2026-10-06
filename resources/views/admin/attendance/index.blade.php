@extends('adminlte::page')

@section('title', 'Attendance')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>Attendance</h1>

    <div>

        <a href="{{ route('attendance.pdf') }}"
           class="btn btn-danger">

            <i class="fas fa-file-pdf"></i>
            Export PDF

        </a>

        <a href="{{ route('attendance.create') }}"
           class="btn btn-primary ml-2">

            <i class="fas fa-plus"></i>
            Mark Attendance

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
        <form action="{{ route('attendance.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search by employee name or ID"
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <input type="date"
                           name="attendance_date"
                           class="form-control"
                           value="{{ request('attendance_date') }}">
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">Filter by Status</option>
                        <option value="Present" {{ request('status') == 'Present' ? 'selected' : '' }}>Present</option>
                        <option value="Absent" {{ request('status') == 'Absent' ? 'selected' : '' }}>Absent</option>
                        <option value="Late" {{ request('status') == 'Late' ? 'selected' : '' }}>Late</option>
                        <option value="Half Day" {{ request('status') == 'Half Day' ? 'selected' : '' }}>Half Day</option>
                        <option value="Leave" {{ request('status') == 'Leave' ? 'selected' : '' }}>Leave</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>

                    <a href="{{ route('attendance.index') }}" class="btn btn-secondary mt-1">
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
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
                <th>Remarks</th>
                <th width="170">Action</th>
            </tr>
            </thead>

            <tbody>
            @forelse($attendances as $attendance)
                <tr>
                    <td>{{ $attendances->firstItem() + $loop->index }}</td>
                    <td>{{ $attendance->employee->name ?? '-' }}</td>
                    <td>{{ $attendance->attendance_date }}</td>
                    <td>{{ $attendance->check_in ?? '-' }}</td>
                    <td>{{ $attendance->check_out ?? '-' }}</td>
                    <td>
                        @switch($attendance->status)
                            @case('Present')
                                <span class="badge badge-success">Present</span>
                                @break

                            @case('Absent')
                                <span class="badge badge-danger">Absent</span>
                                @break

                            @case('Late')
                                <span class="badge badge-warning">Late</span>
                                @break

                            @case('Half Day')
                                <span class="badge badge-info">Half Day</span>
                                @break

                            @default
                                <span class="badge badge-secondary">Leave</span>
                        @endswitch
                    </td>
                    <td>{{ $attendance->remarks ?? '-' }}</td>
                    <td>
                        <a href="{{ route('attendance.edit', $attendance->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('attendance.destroy', $attendance->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete attendance?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No Attendance Found</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $attendances->links() }}
        </div>
    </div>
</div>

@stop