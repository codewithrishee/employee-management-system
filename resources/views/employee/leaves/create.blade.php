@extends('layouts.employee')

@section('title', 'Apply Leave')
@section('page_title', 'Apply Leave')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Apply Leave</h3>
    </div>

    <form action="{{ route('employee.leaves.store') }}" method="POST">

        @csrf

        <div class="card-body">

            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <div class="form-group">

                <label>Leave Type <span class="text-danger">*</span></label>

                <select name="leave_type" class="form-control" required>

                    <option value="">Select Leave Type</option>

                    <option value="Casual Leave">Casual Leave</option>
                    <option value="Sick Leave">Sick Leave</option>
                    <option value="Emergency Leave">Emergency Leave</option>
                    <option value="Paid Leave">Paid Leave</option>
                    <option value="Unpaid Leave">Unpaid Leave</option>

                </select>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>From Date <span class="text-danger">*</span></label>

                        <input type="date"
                               name="from_date"
                               class="form-control"
                               value="{{ old('from_date') }}"
                               required>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>To Date <span class="text-danger">*</span></label>

                        <input type="date"
                               name="to_date"
                               class="form-control"
                               value="{{ old('to_date') }}"
                               required>

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label>Reason <span class="text-danger">*</span></label>

                <textarea name="reason"
                          rows="5"
                          class="form-control"
                          required>{{ old('reason') }}</textarea>

            </div>

        </div>

        <div class="card-footer">

            <button type="submit" class="btn btn-primary">

                <i class="fas fa-paper-plane"></i> Apply Leave

            </button>

            <a href="{{ route('employee.leaves.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </div>

    </form>

</div>

@endsection