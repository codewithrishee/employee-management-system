@extends('layouts.employee')

@section('title', 'Employee Dashboard')

@section('page_title', 'Employee Dashboard')

@section('css')
<style>
    /* Card & Hover Animations */
    .metric-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-radius: 12px;
    }
    .metric-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.08) !important;
    }
    
    /* Icon Box styling */
    .icon-box {
        width: 55px;
        height: 55px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    /* Table Styling */
    .table th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6c757d;
        font-weight: 600;
    }
    .table td {
        font-size: 0.875rem;
        vertical-align: middle;
    }

    /* Badge Styling */
    .badge {
        font-weight: 500;
        padding: 6px 12px;
        letter-spacing: 0.3px;
    }

    /* Profile Image Border */
    .profile-img-wrapper {
        padding: 4px;
        background: linear-gradient(135deg, #625bff, #827cff);
        border-radius: 50%;
        display: inline-block;
    }
</style>
@endsection

@section('content')

{{-- ========================== --}}
{{-- Welcome Header --}}
{{-- ========================== --}}
<div class="card shadow-sm border-0 mb-4 bg-white" style="border-radius: 12px;">
    <div class="card-body p-4 d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h3 class="mb-1 fw-bold text-dark">
                Welcome, <span class="text-primary">{{ $user->name }}</span> 👋
            </h3>
            <p class="text-muted mb-0">
                Here is your daily workspace summary. Have a great day!
            </p>
        </div>
        <div class="mt-3 mt-sm-0">
            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fs-6">
                <i class="fas fa-calendar-alt text-primary me-2"></i> {{ now()->format('l, d M Y') }}
            </span>
        </div>
    </div>
</div>

{{-- ========================== --}}
{{-- Statistics Cards --}}
{{-- ========================== --}}
<div class="row g-3 mb-4">
    <!-- Present Days -->
    <div class="col-xl-3 col-md-6">
        <div class="card metric-card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 fw-semibold text-uppercase" style="font-size:0.75rem;">Present Days</h6>
                    <h3 class="mb-0 fw-bold text-dark">{{ $presentCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Leaves -->
    <div class="col-xl-3 col-md-6">
        <div class="card metric-card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-warning bg-opacity-10 text-warning me-3">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 fw-semibold text-uppercase" style="font-size:0.75rem;">Pending Leaves</h6>
                    <h3 class="mb-0 fw-bold text-dark">{{ $pendingLeaves }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Approved Leaves -->
    <div class="col-xl-3 col-md-6">
        <div class="card metric-card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 fw-semibold text-uppercase" style="font-size:0.75rem;">Approved Leaves</h6>
                    <h3 class="mb-0 fw-bold text-dark">{{ $approvedLeaves }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Salary -->
    <div class="col-xl-3 col-md-6">
        <div class="card metric-card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-danger bg-opacity-10 text-danger me-3">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 fw-semibold text-uppercase" style="font-size:0.75rem;">Latest Salary</h6>
                    <h3 class="mb-0 fw-bold text-dark">
                        @if($latestSalary)
                            ₹{{ number_format($latestSalary->net_salary) }}
                        @else
                            ₹0
                        @endif
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ========================== --}}
{{-- Info + Attendance + Leaves --}}
{{-- ========================== --}}
<div class="row g-4">

    {{-- LEFT: Employee Information --}}
    <div class="col-lg-5">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h3 class="card-title fw-bold text-dark fs-5 mb-0">
                    <i class="fas fa-user-circle text-primary me-2"></i> Employee Information
                </h3>
            </div>
            <div class="card-body">
                
                {{-- Profile Image --}}
                <div class="text-center mb-4">
                    <div class="profile-img-wrapper shadow-sm">
                        @if($employee && $employee->image)
                            <img src="{{ asset('uploads/employees/'.$employee->image) }}" class="rounded-circle" width="110" height="110" style="object-fit: cover;" alt="Profile Image">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=110&background=ffffff&color=625bff" class="rounded-circle" width="110" height="110" alt="Profile Image">
                        @endif
                    </div>
                    <h5 class="fw-bold mt-3 mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small">{{ $employee->designation->name ?? 'Employee' }}</p>
                </div>

                {{-- Employee Details List --}}
                <ul class="list-group list-group-flush border-top">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <span class="text-muted"><i class="fas fa-id-badge text-primary me-2"></i> Employee ID</span>
                        <span class="fw-semibold">{{ $employee->employee_id ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <span class="text-muted"><i class="fas fa-envelope text-primary me-2"></i> Email</span>
                        <span class="fw-semibold">{{ $user->email }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <span class="text-muted"><i class="fas fa-phone text-primary me-2"></i> Phone</span>
                        <span class="fw-semibold">{{ $employee->phone ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <span class="text-muted"><i class="fas fa-building text-primary me-2"></i> Department</span>
                        <span class="fw-semibold">{{ $employee->department->name ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <span class="text-muted"><i class="fas fa-calendar-alt text-primary me-2"></i> Joining Date</span>
                        <span class="fw-semibold">{{ $employee->joining_date ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-bottom-0">
                        <span class="text-muted"><i class="fas fa-toggle-on text-primary me-2"></i> Status</span>
                        @if($employee && $employee->status)
                            <span class="badge bg-success rounded-pill"><i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i> Active</span>
                        @else
                            <span class="badge bg-danger rounded-pill"><i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i> Inactive</span>
                        @endif
                    </li>
                </ul>

            </div>
        </div>
    </div>

    {{-- RIGHT: Attendance + Leaves --}}
    <div class="col-lg-7">
        
        {{-- Recent Attendance --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h3 class="card-title fw-bold text-dark fs-5 mb-0">
                    <i class="fas fa-calendar-check text-success me-2"></i> Recent Attendance
                </h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th class="pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($recentAttendance as $attendance)
                        <tr>
                            <td class="ps-4">{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M Y') }}</td>
                            <td>{{ $attendance->check_in ?? '-' }}</td>
                            <td>{{ $attendance->check_out ?? '-' }}</td>
                            <td class="pe-4">
                                @if($attendance->status == 'Present')
                                    <span class="badge bg-success rounded-pill"><i class="fas fa-check me-1"></i> Present</span>
                                @elseif($attendance->status == 'Absent')
                                    <span class="badge bg-danger rounded-pill"><i class="fas fa-times me-1"></i> Absent</span>
                                @elseif($attendance->status == 'Late')
                                    <span class="badge bg-warning text-dark rounded-pill"><i class="fas fa-clock me-1"></i> Late</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill">{{ $attendance->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="fas fa-calendar-times fs-3 mb-2 d-block"></i>
                                No Attendance Records Found
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Recent Leave Requests --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h3 class="card-title fw-bold text-dark fs-5 mb-0">
                    <i class="fas fa-file-alt text-primary me-2"></i> Recent Leave Requests
                </h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Leave Type</th>
                            <th>From</th>
                            <th>To</th>
                            <th class="pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($recentLeaves as $leave)
                        <tr>
                            <td class="ps-4 fw-semibold text-dark">{{ $leave->leave_type }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave->from_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave->to_date)->format('d M Y') }}</td>
                            <td class="pe-4">
                                @if($leave->status == 'Approved')
                                    <span class="badge bg-success rounded-pill"><i class="fas fa-check me-1"></i> Approved</span>
                                @elseif($leave->status == 'Rejected')
                                    <span class="badge bg-danger rounded-pill"><i class="fas fa-times me-1"></i> Rejected</span>
                                @else
                                    <span class="badge bg-warning text-dark rounded-pill"><i class="fas fa-clock me-1"></i> Pending</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="fas fa-file-times fs-3 mb-2 d-block"></i>
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

@section('js')
<script>
    // Auto hide alerts if any
    setTimeout(function () {
        if (typeof $ !== 'undefined') {
            $('.alert').fadeOut('slow');
        } else {
            document.querySelectorAll('.alert').forEach(function(el) {
                el.style.display = 'none';
            });
        }
    }, 5000);
</script>
@endsection