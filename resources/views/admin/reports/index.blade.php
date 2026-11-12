@extends('admin.layouts.app')

@section('title', 'Reports')

@section('content_header')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div>
            <h1 class="mb-1 fw-bold">Reports</h1>
            <p class="text-muted mb-0">View and analyse your employee management data.</p>
        </div>

        <span class="badge bg-primary fs-6 p-2 mt-2 mt-sm-0 shadow-sm">
            <i class="fas fa-chart-bar mr-1"></i> Reports Centre
        </span>
    </div>
@stop

@section('content')

<!-- Top Metrics Cards -->
<div class="row g-3 mb-4">
    {{-- Employees Report --}}
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card border-0 shadow-sm h-100 hover-lift">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3 text-primary d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                    <i class="fas fa-users fa-2x"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.8rem;">Employees</h6>
                    <h3 class="mb-0 fw-bold">{{ $totalEmployees ?? 0 }}</h3>
                    <a href="{{ route('reports.employees') }}" class="text-decoration-none small mt-1 d-inline-block">
                        View Report <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Attendance Report --}}
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card border-0 shadow-sm h-100 hover-lift">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3 text-success d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                    <i class="fas fa-calendar-check fa-2x"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.8rem;">Attendance</h6>
                    <h3 class="mb-0 fw-bold">{{ $presentToday ?? 0 }}</h3>
                    <a href="{{ route('reports.attendance') }}" class="text-decoration-none text-success small mt-1 d-inline-block">
                        View Report <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Leaves Report --}}
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card border-0 shadow-sm h-100 hover-lift">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3 text-warning d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                    <i class="fas fa-calendar-minus fa-2x"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.8rem;">Leave Requests</h6>
                    <h3 class="mb-0 fw-bold">{{ $totalLeaves ?? 0 }}</h3>
                    <a href="{{ route('reports.leaves') }}" class="text-decoration-none text-warning small mt-1 d-inline-block">
                        View Report <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Payroll Report --}}
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card border-0 shadow-sm h-100 hover-lift">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3 text-info d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                    <i class="fas fa-money-bill-wave fa-2x"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.8rem;">Payroll</h6>
                    <h3 class="mb-0 fw-bold">₹{{ number_format($totalPayroll ?? 0, 2) }}</h3>
                    <a href="{{ route('reports.payrolls') }}" class="text-decoration-none text-info small mt-1 d-inline-block">
                        View Report <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Table Card -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h3 class="card-title fw-bold text-dark fs-5">
            <i class="fas fa-chart-line text-primary me-2"></i> Available Reports
        </h3>
    </div>

    <div class="card-body table-responsive pt-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="25%">Report</th>
                    <th>Description</th>
                    <th class="text-end" width="15%">Action</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="fw-semibold"><i class="fas fa-users text-primary me-2"></i>Employees</td>
                    <td class="text-muted">Employee records and department information.</td>
                    <td class="text-end">
                        <a href="{{ route('reports.employees') }}" class="btn btn-sm btn-outline-primary px-3">
                            Open <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td class="fw-semibold"><i class="fas fa-calendar-check text-success me-2"></i>Attendance</td>
                    <td class="text-muted">Attendance records and daily status.</td>
                    <td class="text-end">
                        <a href="{{ route('reports.attendance') }}" class="btn btn-sm btn-outline-success px-3">
                            Open <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td class="fw-semibold"><i class="fas fa-calendar-minus text-warning me-2"></i>Leaves</td>
                    <td class="text-muted">Employee leave requests and their status.</td>
                    <td class="text-end">
                        <a href="{{ route('reports.leaves') }}" class="btn btn-sm btn-outline-warning px-3">
                            Open <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td class="fw-semibold"><i class="fas fa-money-bill-wave text-info me-2"></i>Payroll</td>
                    <td class="text-muted">Payroll records and salary information.</td>
                    <td class="text-end">
                        <a href="{{ route('reports.payrolls') }}" class="btn btn-sm btn-outline-info px-3">
                            Open <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@stop

@push('css')
<style>
    /* Chota sa CSS taaki cards hover karne par ek smooth animation aaye */
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>
@endpush