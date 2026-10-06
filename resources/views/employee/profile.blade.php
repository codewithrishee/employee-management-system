@extends('layouts.employee')

@section('title', 'My Profile')

@section('page_title', 'My Profile')

@section('content')

<div class="row">

    <div class="col-md-4">

        <div class="card card-primary card-outline">

            <div class="card-body box-profile">

                <div class="text-center">

                    @if($employee && $employee->image)
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ asset('uploads/employees/'.$employee->image) }}"
                             alt="Profile Picture">
                    @else
                        <img class="profile-user-img img-fluid img-circle"
                             src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff&size=200"
                             alt="Profile Picture">
                    @endif

                </div>

                <h3 class="profile-username text-center">
                    {{ $user->name }}
                </h3>

                <p class="text-muted text-center">
                    {{ $employee->designation->name ?? '-' }}
                </p>

                <ul class="list-group list-group-unbordered mb-3">

                    <li class="list-group-item">
                        <b>Employee ID</b>
                        <span class="float-right">
                            {{ $employee->employee_id ?? '-' }}
                        </span>
                    </li>

                    <li class="list-group-item">
                        <b>Department</b>
                        <span class="float-right">
                            {{ $employee->department->name ?? '-' }}
                        </span>
                    </li>

                    <li class="list-group-item">
                        <b>Status</b>

                        <span class="float-right">

                            @if($employee && $employee->status)

                                <span class="badge badge-success">
                                    Active
                                </span>

                            @else

                                <span class="badge badge-danger">
                                    Inactive
                                </span>

                            @endif

                        </span>

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <div class="col-md-8">

        <div class="card">

         <div class="card-header d-flex justify-content-between align-items-center">

    <h3 class="card-title">

        Personal Information

    </h3>

    <a href="{{ route('employee.profile.edit') }}"
       class="btn btn-primary btn-sm">

        <i class="fas fa-edit"></i>

        Edit Profile

    </a>

</div>

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>
                        <th width="35%">Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>

                    <tr>
                        <th>Phone</th>
                        <td>{{ $employee->phone ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Gender</th>
                        <td>{{ $employee->gender ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Date of Birth</th>
                        <td>{{ $employee->date_of_birth ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Joining Date</th>
                        <td>{{ $employee->joining_date ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Salary</th>
                        <td>
                            ₹{{ isset($employee) ? number_format($employee->salary) : 0 }}
                        </td>
                    </tr>

                    <tr>
                        <th>Address</th>
                        <td>{{ $employee->address ?? '-' }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection