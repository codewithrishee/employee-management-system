@extends('layouts.employee')

@section('title', 'Employee Dashboard')

@section('page_title', 'Employee Dashboard')

@section('content')

{{-- ========================== --}}
{{-- Welcome Header --}}
{{-- ========================== --}}

<div class="row mb-3">

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-1">
                    Welcome, <strong>{{ $user->name }}</strong> 👋
                </h3>
                <p class="text-muted mb-0">
                    Welcome back to the Employee Management System.
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="mb-2">
                    <i class="fas fa-calendar-alt text-primary"></i>
                    Today
                </h5>
                <h4>{{ now()->format('d M Y') }}</h4>
            </div>
        </div>
    </div>

</div>

{{-- ========================== --}}
{{-- Statistics Cards --}}
{{-- ========================== --}}

<div class="row">

    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $presentCount }}</h3>
                <p>Present Days</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $pendingLeaves }}</h3>
                <p>Pending Leaves</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $approvedLeaves }}</h3>
                <p>Approved Leaves</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>
                    @if($latestSalary)
                        ₹{{ number_format($latestSalary->net_salary) }}
                    @else
                        ₹0
                    @endif
                </h3>
                <p>Latest Salary</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
    </div>

</div>

{{-- ========================== --}}
{{-- Employee Info + Attendance + Leaves --}}
{{-- ========================== --}}

<div class="row">

    {{-- ========================== --}}
    {{-- LEFT: Employee Information --}}
    {{-- ========================== --}}

    <div class="col-lg-5">

        <div class="card card-primary card-outline">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-circle mr-2"></i>
                    Employee Information
                </h3>
            </div>

            <div class="card-body">

                {{-- Profile Image --}}
                <div class="text-center mb-3">
                    @if($employee && $employee->image)
                        <img
                            src="{{ asset('uploads/employees/'.$employee->image) }}"
                            class="img-circle elevation-2"
                            width="120"
                            height="120"
                            style="object-fit: cover;"
                            alt="Profile Image"
                        >
                    @else
                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=120&background=007bff&color=fff"
                            class="img-circle elevation-2"
                            width="120"
                            height="120"
                            alt="Profile Image"
                        >
                    @endif
                </div>

                {{-- Employee Details Table --}}
                <table class="table table-bordered table-sm">

                    <tr>
                        <th width="40%" class="bg-light">
                            <i class="fas fa-id-badge mr-1 text-primary"></i>
                            Employee ID
                        </th>
                        <td>{{ $employee->employee_id ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th class="bg-light">
                            <i class="fas fa-user mr-1 text-primary"></i>
                            Name
                        </th>
                        <td>{{ $user->name }}</td>
                    </tr>

                    <tr>
                        <th class="bg-light">
                            <i class="fas fa-envelope mr-1 text-primary"></i>
                            Email
                        </th>
                        <td>{{ $user->email }}</td>
                    </tr>

                    <tr>
                        <th class="bg-light">
                            <i class="fas fa-phone mr-1 text-primary"></i>
                            Phone
                        </th>
                        <td>{{ $employee->phone ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th class="bg-light">
                            <i class="fas fa-building mr-1 text-primary"></i>
                            Department
                        </th>
                        <td>{{ $employee->department->name ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th class="bg-light">
                            <i class="fas fa-briefcase mr-1 text-primary"></i>
                            Designation
                        </th>
                        <td>{{ $employee->designation->name ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th class="bg-light">
                            <i class="fas fa-calendar-alt mr-1 text-primary"></i>
                            Joining Date
                        </th>
                        <td>{{ $employee->joining_date ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th class="bg-light">
                            <i class="fas fa-toggle-on mr-1 text-primary"></i>
                            Status
                        </th>
                        <td>
                            @if($employee && $employee->status)
                                <span class="badge badge-success">
                                    <i class="fas fa-circle mr-1"></i> Active
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    <i class="fas fa-circle mr-1"></i> Inactive
                                </span>
                            @endif
                        </td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

    {{-- ========================== --}}
    {{-- RIGHT: Attendance + Leaves --}}
    {{-- ========================== --}}

    <div class="col-lg-7">

        {{-- Recent Attendance --}}
        <div class="card card-outline card-success">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-check text-success mr-2"></i>
                    Recent Attendance
                </h3>
            </div>

            <div class="card-body table-responsive p-0">

                <table class="table table-hover table-bordered mb-0">

                    <thead class="thead-light">
                        <tr>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($recentAttendance as $attendance)

                        <tr>
                            <td>{{ $attendance->attendance_date }}</td>
                            <td>{{ $attendance->check_in ?? '-' }}</td>
                            <td>{{ $attendance->check_out ?? '-' }}</td>
                            <td>
                                @if($attendance->status == 'Present')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check mr-1"></i> Present
                                    </span>
                                @elseif($attendance->status == 'Absent')
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times mr-1"></i> Absent
                                    </span>
                                @elseif($attendance->status == 'Late')
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock mr-1"></i> Late
                                    </span>
                                @else
                                    <span class="badge badge-secondary">
                                        {{ $attendance->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center py-3">
                                <i class="fas fa-calendar-times text-muted mr-2"></i>
                                No Attendance Records Found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- Recent Leave Requests --}}
        <div class="card card-outline card-primary mt-3">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-alt text-primary mr-2"></i>
                    Recent Leave Requests
                </h3>
            </div>

            <div class="card-body table-responsive p-0">

                <table class="table table-bordered table-hover mb-0">

                    <thead class="thead-light">
                        <tr>
                            <th>Leave Type</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($recentLeaves as $leave)

                        <tr>
                            <td>{{ $leave->leave_type }}</td>
                            <td>{{ $leave->from_date }}</td>
                            <td>{{ $leave->to_date }}</td>
                            <td>
                                @if($leave->status == 'Approved')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check mr-1"></i> Approved
                                    </span>
                                @elseif($leave->status == 'Rejected')
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times mr-1"></i> Rejected
                                    </span>
                                @else
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock mr-1"></i> Pending
                                    </span>
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center py-3">
                                <i class="fas fa-file-times text-muted mr-2"></i>
                                No Leave Requests Found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection

@section('css')
<style>

    .small-box {
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .small-box:hover {
        transform: translateY(-5px);
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .table th {
        font-size: 0.85rem;
        font-weight: 600;
    }

    .table td {
        font-size: 0.875rem;
        vertical-align: middle;
    }

    .badge {
        font-size: 0.78rem;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .img-circle {
        border: 4px solid #007bff;
        padding: 2px;
    }

</style>
@endsection

@section('js')
<script>
    setTimeout(function () {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
