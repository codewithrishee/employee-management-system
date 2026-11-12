@extends('layouts.employee')

@section('title', 'Change Password')

@section('page_title', 'Change Password')

@section('content')

<div class="row justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="col-lg-12 col-md-8 col-12">
        
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h3 class="card-title fw-bold text-dark fs-5 mb-0">
                    <i class="fas fa-shield-alt text-primary me-2"></i> Update Password
                </h3>
            </div>

            <form action="{{ route('employee.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body p-4">
                    
                    <p class="text-muted small mb-4">
                        Ensure your account is using a long, random password to stay secure.
                    </p>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-semibold">Current Password</label>
                        <input type="password" 
                               id="current_password"
                               name="current_password" 
                               class="form-control" 
                               placeholder="Enter current password" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">New Password</label>
                        <input type="password" 
                               id="password"
                               name="password" 
                               class="form-control" 
                               placeholder="Enter new password" 
                               required>
                        <div class="form-text small text-muted mt-1">
                            Make sure it's at least 8 characters long.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                        <input type="password" 
                               id="password_confirmation"
                               name="password_confirmation" 
                               class="form-control" 
                               placeholder="Confirm new password" 
                               required>
                    </div>

                </div>

                <div class="card-footer bg-light border-top d-flex gap-2 p-3">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Update Password
                    </button>
                    
                    <a href="{{ route('employee.dashboard') }}" class="btn btn-outline-secondary px-4">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
        
    </div>
</div>

@endsection