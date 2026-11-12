@extends('admin.layouts.app')

@section('title', 'Overview')

@section('content_header')
    <div class="d-flex flex-wrap justify-content-between align-items-center">
        <div><div class="eyebrow">WORKSPACE / OVERVIEW</div><h1 class="mb-0">Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 18 ? 'afternoon' : 'evening') }}, {{ explode(' ', auth()->user()->name)[0] ?? 'there' }} 👋</h1><p class="text-muted mb-0 mt-2">Here’s what’s happening across your organisation today.</p></div>
        <div class="text-muted">
            <span class="today-chip"><i class="bi bi-calendar3"></i> {{ now()->format('l, d F Y') }}</span>
        </div>
    </div>
@stop

@section('content')
    <!-- First Row: Key Metrics -->
    <div class="row mb-3">
        <div class="col-lg-3 col-6">
            <div class="small-box text-white" style="background:linear-gradient(135deg,#625bff,#827cff)">
                <div class="inner">
                    <h3>{{ $totalEmployees }}</h3>
                    <p>Total Employees</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('employees.index') }}" class="small-box-footer">
                    More Info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box text-white" style="background:linear-gradient(135deg,#119b79,#35c7a2)">
                <div class="inner">
                    <h3>{{ $totalDepartments }}</h3>
                    <p>Departments</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
                <a href="{{ route('departments.index') }}" class="small-box-footer">
                    More Info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box text-white" style="background:linear-gradient(135deg,#e6a23c,#f4c15d)">
                <div class="inner">
                    <h3>{{ $totalDesignations }}</h3>
                    <p>Designations</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-tag"></i>
                </div>
                <a href="{{ route('designations.index') }}" class="small-box-footer">
                    More Info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box text-white" style="background:linear-gradient(135deg,#e45d73,#f28a9a)">
                <div class="inner">
                    <h3>{{ $leaveToday }}</h3>
                    <p>On Leave Today</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <a href="{{ route('leaves.index') }}" class="small-box-footer">
                    More Info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Second Row: Attendance & Payroll -->
    <div class="row mb-3">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="small-box text-white h-100" style="background:linear-gradient(135deg,#4776e6,#6e9cff)">
                <div class="inner">
                    <h3>{{ $presentToday }}</h3>
                    <p>Present Today</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12">
            <div class="small-box text-white h-100" style="background:linear-gradient(135deg,#65758b,#8e9cad)">
                <div class="inner">
                    <h3>{{ $absentToday }}</h3>
                    <p>Absent Today</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-times"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 col-12">
            <div class="small-box text-white h-100" style="background:linear-gradient(135deg,#263448,#4d617c)">
                <div class="inner">
                    <h3>₹{{ number_format($totalPayroll, 2) }}</h3>
                    <p>Total Payroll</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Third Row: Charts -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        <i class="fas fa-user-clock mr-2"></i>Attendance Overview
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-primary">Today</span>
                    </div>
                </div>
                <div class="card-body">
                    <div style="width: 100%; height: 320px;">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-2"></i>Department Wise Employees
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-success">Distribution</span>
                    </div>
                </div>
                <div class="card-body">
                    <div style="width: 100%; height: 320px;">
                        <canvas id="departmentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fourth Row: Monthly Payroll -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-2"></i>Monthly Payroll Report
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-info">Current Year</span>
                    </div>
                </div>
                <div class="card-body">
                    <div style="height: 280px;">
                        <canvas id="payrollChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fifth Row: Recent Tables -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        <i class="fas fa-user-plus mr-2"></i>Recent Employees
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-primary">{{ $recentEmployees->count() }} New</span>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentEmployees as $employee)
                                <tr>
                                    <td>{{ $employee->employee_id }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->department->name ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">
                                        <i class="fas fa-info-circle mr-1"></i>No Employees Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-alt mr-2"></i>Recent Leaves
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-warning">{{ $recentLeaves->count() }} Records</span>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Employee</th>
                                <th>Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentLeaves as $leave)
                                <tr>
                                    <td>{{ $leave->employee->name }}</td>
                                    <td>{{ $leave->leave_type }}</td>
                                    <td>
                                        <span class="badge badge-{{ strtolower($leave->status) == 'approved' ? 'success' : (strtolower($leave->status) == 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($leave->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">
                                        <i class="fas fa-info-circle mr-1"></i>No Leave Records
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Attendance Doughnut Chart
        const attendanceCtx = document.getElementById('attendanceChart');
        if (attendanceCtx) {
            new Chart(attendanceCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Present', 'Absent', 'Leave'],
                    datasets: [{
                        data: [
                            {{ $presentToday }},
                            {{ $absentToday }},
                            {{ $leaveToday }}
                        ],
                        backgroundColor: ['#28a745', '#dc3545', '#ffc107'],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
        }

        // Department Pie Chart
        const departmentCtx = document.getElementById('departmentChart');
        if (departmentCtx) {
            const deptColors = [
                '#007bff', '#28a745', '#ffc107',
                '#dc3545', '#6f42c1', '#17a2b8',
                '#fd7e14', '#20c997', '#e83e8c',
                '#6c757d', '#343a40', '#6610f2'
            ];

            new Chart(departmentCtx, {
                type: 'pie',
                data: {
                    labels: [
                        @foreach($departmentChart as $item)
                            '{{ $item->name }}',
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach($departmentChart as $item)
                                {{ $item->total }},
                            @endforeach
                        ],
                        backgroundColor: deptColors.slice(0, {{ $departmentChart->count() }}),
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        }
                    }
                }
            });
        }

        // Payroll Bar Chart
        const payrollCtx = document.getElementById('payrollChart');
        if (payrollCtx) {
            new Chart(payrollCtx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach($payrollChart as $item)
                            '{{ $item->month }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Total Salary (₹)',
                        data: [
                            @foreach($payrollChart as $item)
                                {{ $item->total_salary }},
                            @endforeach
                        ],
                        backgroundColor: '#17a2b8',
                        borderColor: '#0d6efd',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '₹' + value.toLocaleString('en-IN');
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@stop