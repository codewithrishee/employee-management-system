@extends('layouts.employee')

@section('title', 'My Leaves')
@section('page_title', 'My Leaves')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between">

        <h3 class="card-title">My Leave Requests</h3>

        <a href="{{ route('employee.leaves.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Apply Leave
        </a>

    </div>

    <div class="card-body">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Leave Type</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($leaves as $leave)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $leave->leave_type }}</td>

                        <td>{{ $leave->from_date }}</td>

                        <td>{{ $leave->to_date }}</td>

                        <td>

                            @if($leave->status == 'Approved')

                                <span class="badge badge-success">
                                    Approved
                                </span>

                            @elseif($leave->status == 'Rejected')

                                <span class="badge badge-danger">
                                    Rejected
                                </span>

                            @else

                                <span class="badge badge-warning">
                                    Pending
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">

                            No Leave Records Found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection