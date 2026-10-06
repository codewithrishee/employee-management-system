@csrf

<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <label>Employee <span class="text-danger">*</span></label>

            <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror">

                <option value="">Select Employee</option>

                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}"
                        {{ old('employee_id', $leave->employee_id ?? '') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->employee_id }} - {{ $employee->name }}
                    </option>
                @endforeach

            </select>

            @error('employee_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Leave Type</label>

            <select name="leave_type" class="form-control">

                <option value="Casual Leave" {{ old('leave_type', $leave->leave_type ?? '') == 'Casual Leave' ? 'selected' : '' }}>Casual Leave</option>

                <option value="Sick Leave" {{ old('leave_type', $leave->leave_type ?? '') == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>

                <option value="Emergency Leave" {{ old('leave_type', $leave->leave_type ?? '') == 'Emergency Leave' ? 'selected' : '' }}>Emergency Leave</option>

                <option value="Paid Leave" {{ old('leave_type', $leave->leave_type ?? '') == 'Paid Leave' ? 'selected' : '' }}>Paid Leave</option>

                <option value="Unpaid Leave" {{ old('leave_type', $leave->leave_type ?? '') == 'Unpaid Leave' ? 'selected' : '' }}>Unpaid Leave</option>

            </select>

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>From Date</label>

            <input type="date"
                   name="from_date"
                   class="form-control"
                   value="{{ old('from_date', $leave->from_date ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>To Date</label>

            <input type="date"
                   name="to_date"
                   class="form-control"
                   value="{{ old('to_date', $leave->to_date ?? '') }}">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Reason</label>

            <textarea name="reason"
                      rows="4"
                      class="form-control">{{ old('reason', $leave->reason ?? '') }}</textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Status</label>

            <select name="status" class="form-control">

                <option value="Pending" {{ old('status', $leave->status ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>

                <option value="Approved" {{ old('status', $leave->status ?? '') == 'Approved' ? 'selected' : '' }}>Approved</option>

                <option value="Rejected" {{ old('status', $leave->status ?? '') == 'Rejected' ? 'selected' : '' }}>Rejected</option>

            </select>

        </div>
    </div>

</div>