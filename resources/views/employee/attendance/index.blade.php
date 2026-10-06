@extends('layouts.employee')

@section('title', 'My Attendance')
@section('page_title', 'My Attendance')

@section('content')

<div class="row mb-3">

    <div class="col-md-6">
        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fas fa-calendar-check"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Present Days</span>
                <span class="info-box-number">{{ $presentCount ?? 0 }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="info-box bg-danger">
            <span class="info-box-icon"><i class="fas fa-calendar-times"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Absent Days</span>
                <span class="info-box-number">{{ $absentCount ?? 0 }}</span>
            </div>
        </div>
    </div>

</div>

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Attendance Records</h3>

        <form method="GET" action="{{ route('employee.attendance') }}" class="form-inline">
            <label class="mr-2 mb-0">Month</label>
            <input type="month" name="month" class="form-control form-control-sm mr-2" value="{{ request('month') }}">

            <button class="btn btn-primary btn-sm mr-2">Filter</button>

            <a href="{{ route('employee.attendance') }}" class="btn btn-secondary btn-sm">Reset</a>
        </form>
    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-hover mb-0">

            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->attendance_date }}</td>
                        <td>{{ $attendance->check_in ?? '-' }}</td>
                        <td>{{ $attendance->check_out ?? '-' }}</td>
                        <td>
                            @if($attendance->status == 'Present')
                                <span class="badge badge-success">Present</span>
                            @elseif($attendance->status == 'Absent')
                                <span class="badge badge-danger">Absent</span>
                            @else
                                <span class="badge badge-warning">{{ $attendance->status }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No Attendance Found</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

    <div class="card-footer clearfix">
        {{ $attendances->withQueryString()->links() }}
    </div>

</div>

@endsection