@extends('admin.layouts.app')

@section('title', 'My Profile')

@section('content_header')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div>
            <h1 class="mb-1 fw-bold">My Profile</h1>
            <p class="text-muted mb-0">
                Manage your account information and security settings.
            </p>
        </div>

        <span class="badge bg-primary fs-6 p-2 mt-2 mt-sm-0 shadow-sm">
            <i class="fas fa-user-circle me-1"></i> Account Settings
        </span>
    </div>
@stop

@section('content')

<div class="row g-4">

    {{-- Left Column: Forms --}}
    <div class="col-lg-8">
        
        <!-- Profile Information Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h3 class="card-title fw-bold text-dark fs-5 mb-0">
                    <i class="fas fa-user-edit text-primary me-2"></i> Profile Information
                </h3>
            </div>
            <div class="card-body pt-4">
                <p class="text-muted mb-4">
                    Update your account's profile information and email address.
                </p>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password Card -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h3 class="card-title fw-bold text-dark fs-5 mb-0">
                    <i class="fas fa-lock text-info me-2"></i> Update Password
                </h3>
            </div>
            <div class="card-body pt-4">
                <p class="text-muted mb-4">
                    Ensure your account is using a long, random password to stay secure.
                </p>
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>

    {{-- Right Column: Summary & Danger Zone --}}
    <div class="col-lg-4">
        
        <!-- Profile Summary Card -->
        <div class="card shadow-sm border-0 mb-4 text-center">
            <div class="card-body pt-5 pb-4">
                <!-- Modern Avatar with Gradient -->
                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3 shadow-sm"
                     style="width: 110px; height: 110px; font-size: 42px; font-weight: 600; color: white; background: linear-gradient(135deg, #625bff, #827cff);">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>

                <h4 class="fw-bold mb-1 text-dark">
                    {{ auth()->user()->name }}
                </h4>
                <p class="text-muted small mb-4">
                    <i class="fas fa-envelope me-1"></i> {{ auth()->user()->email }}
                </p>

                <ul class="list-group list-group-flush text-start border-top pt-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-0 py-2">
                        <span class="text-muted fw-semibold">Account ID</span>
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">#{{ auth()->id() }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-0 py-2">
                        <span class="text-muted fw-semibold">Member Since</span>
                        <span class="fw-medium text-dark">{{ auth()->user()->created_at?->format('d M Y') ?? 'N/A' }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Danger Zone Card -->
        <div class="card shadow-sm border-0 border-start border-4 border-danger">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h3 class="card-title fw-bold text-danger fs-5 mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i> Danger Zone
                </h3>
            </div>
            <div class="card-body pt-4">
                <p class="text-muted small mb-4">
                    Once your account is deleted, all of its resources and data will be permanently deleted.
                </p>
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>

</div>

@stop