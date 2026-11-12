@extends('layouts.employee')

@section('title', 'My Attendance')
@section('page_title', 'My Attendance')

@section('css')
<style>
    .metric-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-radius: 12px;
    }
    .metric-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.08) !important;
    }
    .icon-box {
        width: 55px;
        height: 55px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
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
</style>
@endsection

@section('content')

{{-- Statistics Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card metric-card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-info bg-opacity-10 text-info me-3">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem;">Present Days</h6>
                    <h3 class="mb-0 fw-bold text-dark">{{ $presentCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card metric-card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-danger bg-opacity-10 text-danger me-3">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.75rem;">Absent Days</h6>
                    <h3 class="mb-0 fw-bold text-dark">{{ $absentCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Attendance Table --}}
<div class="card shadow-sm border-0">
    
    <div class="card-header bg-white border-bottom pt-4 pb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <h3 class="card-title fw-bold text-dark fs-5 mb-0">
                <i class="fas fa-list text-primary me-2"></i> Attendance Records
            </h3>

            <!-- Filter Form -->
            <form method="GET" action="{{ route('employee.attendance') }}" class="d-flex flex-wrap align-items-center gap-2 m-0">
                <label class="text-muted fw-semibold mb-0 small d-none d-sm-block">Filter by Month:</label>
                <input type="month" name="month" class="form-control form-control-sm" style="width: 160px;" value="{{ request('month') }}">
                
                <button type="submit" class="btn btn-primary btn-sm px-3">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
                
                <a href="{{ route('employee.attendance') }}" class="btn btn-secondary btn-sm px-3">
                    Reset
                </a>
            </form>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Date</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th class="pe-4">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($attendances as $attendance)
                    <tr>
                        <td class="ps-4 fw-semibold text-dark">
                            {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M Y') }}
                        </td>
                        <td>{{ $attendance->check_in ?? '-' }}</td>
                        <td>{{ $attendance->check_out ?? '-' }}</td>
                        <td class="pe-4">
                            @if($attendance->status == 'Present')
                                <span class="badge bg-success rounded-pill px-3 py-2"><i class="fas fa-check me-1"></i> Present</span>
                            @elseif($attendance->status == 'Absent')
                                <span class="badge bg-danger rounded-pill px-3 py-2"><i class="fas fa-times me-1"></i> Absent</span>
                            @elseif($attendance->status == 'Late')
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2"><i class="fas fa-clock me-1"></i> Late</span>
                            @else
                                <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $attendance->status }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="fas fa-calendar-times fs-2 mb-3 d-block text-secondary"></i>
                            <h5 class="fw-semibold">No Attendance Found</h5>
                            <p class="mb-0 small">No records match your filter criteria.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($attendances->hasPages())
    <div class="card-footer bg-white border-top clearfix pt-3">
        {{ $attendances->links() }}
    </div>
    @endif

</div>

@endsection