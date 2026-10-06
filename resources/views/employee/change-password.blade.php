@extends('layouts.employee')

@section('title', 'Change Password')

@section('page_title', 'Change Password')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-key"></i>

                    Change Password

                </h3>

            </div>

            <form action="{{ route('employee.password.update') }}" method="POST">

                @csrf
                @method('PUT')

                <div class="card-body">

                    @if(session('success'))

                        <div class="alert alert-success">

                            {{ session('success') }}

                        </div>

                    @endif

                    @if($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <div class="form-group">

                        <label>Current Password</label>

                        <input type="password"
                               name="current_password"
                               class="form-control"
                               required>

                    </div>

                    <div class="form-group">

                        <label>New Password</label>

                        <input type="password"
                               name="password"
                               class="form-control"
                               required>

                    </div>

                    <div class="form-group">

                        <label>Confirm Password</label>

                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               required>

                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fas fa-save"></i>

                        Update Password

                    </button>

                    <a href="{{ route('employee.dashboard') }}"
                       class="btn btn-secondary">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection