@extends('layouts.employee')

@section('title', 'My Profile')

@section('page_title', 'My Profile')

@section('content')

<div class="row g-4">

    {{-- Left Column: Profile Summary --}}
    <div class="col-lg-4 col-md-5">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center pt-5">
                
                {{-- Modern Avatar --}}
                <div class="d-inline-block p-1 rounded-circle shadow-sm mb-3" style="background: linear-gradient(135deg, #625bff, #827cff);">
                    @if($employee && $employee->image)
                        <img src="{{ asset('uploads/employees/'.$employee->image) }}" 
                             class="rounded-circle bg-white" 
                             width="120" height="120" style="object-fit: cover;" 
                             alt="Profile Picture">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ffffff&color=625bff&size=120" 
                             class="rounded-circle bg-white" 
                             width="120" height="120" 
                             alt="Profile Picture">
                    @endif
                </div>

                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                <p class="text-muted small mb-4">
                    <i class="fas fa-briefcase me-1"></i> {{ $employee->designation->name ?? 'Employee' }}
                </p>

                <ul class="list-group list-group-flush text-start border-top pt-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-0">
                        <span class="text-muted"><i class="fas fa-id-badge text-primary me-2"></i> Employee ID</span>
                        <span class="fw-semibold">{{ $employee->employee_id ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-0">
                        <span class="text-muted"><i class="fas fa-building text-primary me-2"></i> Department</span>
                        <span class="fw-semibold">{{ $employee->department->name ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom-0">
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

    {{-- Right Column: Personal Information --}}
    <div class="col-lg-8 col-md-7">
        <div class="card shadow-sm border-0 h-100">
            
            <div class="card-header bg-white border-bottom pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h3 class="card-title fw-bold text-dark fs-5 mb-0">
                    <i class="fas fa-user text-primary me-2"></i> Personal Information
                </h3>
                <a href="{{ route('employee.profile.edit') }}" class="btn btn-primary btn-sm px-3">
                    <i class="fas fa-edit me-1"></i> Edit Profile
                </a>
            </div>

            <div class="card-body pt-4">
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                        <span class="text-muted fw-semibold">Full Name</span>
                        <span class="text-dark fw-medium">{{ $user->name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                        <span class="text-muted fw-semibold">Email Address</span>
                        <span class="text-dark fw-medium">{{ $user->email }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                        <span class="text-muted fw-semibold">Phone Number</span>
                        <span class="text-dark fw-medium">{{ $employee->phone ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                        <span class="text-muted fw-semibold">Gender</span>
                        <span class="text-dark fw-medium">{{ $employee->gender ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                        <span class="text-muted fw-semibold">Date of Birth</span>
                        <span class="text-dark fw-medium">{{ $employee->date_of_birth ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                        <span class="text-muted fw-semibold">Joining Date</span>
                        <span class="text-dark fw-medium">{{ $employee->joining_date ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                        <span class="text-muted fw-semibold">Salary</span>
                        <span class="text-success fw-bold">₹{{ isset($employee) ? number_format($employee->salary) : 0 }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom-0">
                        <span class="text-muted fw-semibold">Residential Address</span>
                        <span class="text-dark fw-medium text-end" style="max-width: 60%;">{{ $employee->address ?? '-' }}</span>
                    </li>
                </ul>

            </div>

        </div>
    </div>

</div>

@endsection