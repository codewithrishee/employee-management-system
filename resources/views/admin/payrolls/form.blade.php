@csrf

<div class="row">

    <div class="col-md-6">
        <div class="form-group">

            <label>Employee <span class="text-danger">*</span></label>

            <select name="employee_id" class="form-control">

                <option value="">Select Employee</option>

                @foreach($employees as $employee)

                    <option value="{{ $employee->id }}"
                        {{ old('employee_id', $payroll->employee_id ?? '') == $employee->id ? 'selected' : '' }}>

                        {{ $employee->employee_id }} - {{ $employee->name }}

                    </option>

                @endforeach

            </select>

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">

            <label>Month</label>

            <input type="month"
                   name="month"
                   class="form-control"
                   value="{{ old('month', $payroll->month ?? '') }}">

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">

            <label>Basic Salary</label>

            <input type="number"
                   name="basic_salary"
                   class="form-control"
                   value="{{ old('basic_salary', $payroll->basic_salary ?? '') }}">

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">

            <label>Bonus</label>

            <input type="number"
                   name="bonus"
                   class="form-control"
                   value="{{ old('bonus', $payroll->bonus ?? 0) }}">

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">

            <label>Deduction</label>

            <input type="number"
                   name="deduction"
                   class="form-control"
                   value="{{ old('deduction', $payroll->deduction ?? 0) }}">

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">

            <label>Payment Status</label>

            <select name="payment_status" class="form-control">

                <option value="Pending"
                    {{ old('payment_status', $payroll->payment_status ?? '') == 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="Paid"
                    {{ old('payment_status', $payroll->payment_status ?? '') == 'Paid' ? 'selected' : '' }}>
                    Paid
                </option>

            </select>

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">

            <label>Payment Date</label>

            <input type="date"
                   name="payment_date"
                   class="form-control"
                   value="{{ old('payment_date', $payroll->payment_date ?? '') }}">

        </div>
    </div>

</div>