@csrf

<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <label>Employee <span class="text-danger">*</span></label>

            <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror">

                <option value="">Select Employee</option>

                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}"
                        {{ old('employee_id', $attendance->employee_id ?? '') == $employee->id ? 'selected' : '' }}>
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
            <label>Attendance Date</label>

            <input type="date"
                   name="attendance_date"
                   class="form-control"
                   value="{{ old('attendance_date', isset($attendance) ? $attendance->attendance_date : date('Y-m-d')) }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Check In</label>

            <input type="time"
                   name="check_in"
                   class="form-control"
                   value="{{ old('check_in', $attendance->check_in ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Check Out</label>

            <input type="time"
                   name="check_out"
                   class="form-control"
                   value="{{ old('check_out', $attendance->check_out ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">

            <label>Status</label>

            <select name="status" class="form-control">

                <option value="Present"
                    {{ old('status', $attendance->status ?? '') == 'Present' ? 'selected' : '' }}>
                    Present
                </option>

                <option value="Absent"
                    {{ old('status', $attendance->status ?? '') == 'Absent' ? 'selected' : '' }}>
                    Absent
                </option>

                <option value="Late"
                    {{ old('status', $attendance->status ?? '') == 'Late' ? 'selected' : '' }}>
                    Late
                </option>

                <option value="Half Day"
                    {{ old('status', $attendance->status ?? '') == 'Half Day' ? 'selected' : '' }}>
                    Half Day
                </option>

                <option value="Leave"
                    {{ old('status', $attendance->status ?? '') == 'Leave' ? 'selected' : '' }}>
                    Leave
                </option>

            </select>

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Remarks</label>

            <input type="text"
                   name="remarks"
                   class="form-control"
                   value="{{ old('remarks', $attendance->remarks ?? '') }}"
                   placeholder="Optional">
        </div>
    </div>

</div>