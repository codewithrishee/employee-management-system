@extends('layouts.employee')

@section('title', 'Edit Profile')

@section('page_title', 'Edit Profile')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-user-edit"></i>

                    Edit My Profile

                </h3>

            </div>

            <form action="{{ route('employee.profile.update') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card-body">

                    @if($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <div class="text-center mb-4">

                        @if($employee && $employee->image)

                            <img src="{{ asset('uploads/employees/'.$employee->image) }}"
                                 class="img-circle elevation-2"
                                 width="130"
                                 height="130">

                        @else

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=200"
                                 class="img-circle elevation-2">

                        @endif

                    </div>

                    <div class="form-group">

                        <label>Profile Photo</label>

                        <input type="file"
                               name="image"
                               class="form-control">

                    </div>

                    <div class="form-group">

                        <label>Name</label>

                        <input type="text"
                               class="form-control"
                               value="{{ $user->name }}"
                               readonly>

                    </div>

                    <div class="form-group">

                        <label>Email</label>

                        <input type="email"
                               class="form-control"
                               value="{{ $user->email }}"
                               readonly>

                    </div>

                    <div class="form-group">

                        <label>Phone</label>

                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ old('phone',$employee->phone) }}">

                    </div>

                    <div class="form-group">

                        <label>Date of Birth</label>

                        <input type="date"
                               name="date_of_birth"
                               class="form-control"
                               value="{{ old('date_of_birth',$employee->date_of_birth) }}">

                    </div>                    <div class="form-group">

                        <label>Address</label>

                        <textarea name="address"
                                  class="form-control"
                                  rows="4">{{ old('address', $employee->address) }}</textarea>

                    </div>

                </div>

                <div class="card-footer text-right">

                    <a href="{{ route('employee.profile') }}"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>

                        Back

                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fas fa-save"></i>

                        Update Profile

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection