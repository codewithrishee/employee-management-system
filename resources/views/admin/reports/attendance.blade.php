@extends('adminlte::page')

@section('title','Attendance Report')

@section('content_header')

<h1>Attendance Report</h1>

@stop

@section('content')

<div class="card">

<div class="card-body">

<form method="GET">

<div class="row">

<div class="col-md-3">

<label>Employee</label>

<select name="employee_id" class="form-control">

<option value="">All Employees</option>

@foreach($employees as $employee)

<option value="{{ $employee->id }}"
{{ request('employee_id')==$employee->id?'selected':'' }}>

{{ $employee->employee_id }}
-
{{ $employee->name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-2">

<label>From</label>

<input type="date"
name="from_date"
class="form-control"
value="{{ request('from_date') }}">

</div>

<div class="col-md-2">

<label>To</label>

<input type="date"
name="to_date"
class="form-control"
value="{{ request('to_date') }}">

</div>

<div class="col-md-3">

<label>Status</label>

<select name="status"
class="form-control">

<option value="">All</option>

<option value="Present">Present</option>

<option value="Absent">Absent</option>

<option value="Late">Late</option>

<option value="Half Day">Half Day</option>

<option value="Leave">Leave</option>

</select>

</div>

<div class="col-md-2 d-flex align-items-end">

<button class="btn btn-primary btn-block">

Search

</button>

</div>

</div>

</form>

</div>

</div>

<div class="card">

<div class="card-body table-responsive">

<table class="table table-bordered">

<thead>

<tr>

<th>#</th>

<th>Employee</th>

<th>Date</th>

<th>Check In</th>

<th>Check Out</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@forelse($attendances as $attendance)

<tr>

<td>{{ $attendances->firstItem()+$loop->index }}</td>

<td>{{ $attendance->employee->name }}</td>

<td>{{ $attendance->attendance_date }}</td>

<td>{{ $attendance->check_in }}</td>

<td>{{ $attendance->check_out }}</td>

<td>{{ $attendance->status }}</td>

</tr>

@empty

<tr>

<td colspan="6"
class="text-center">

No Records

</td>

</tr>

@endforelse

</tbody>

</table>

{{ $attendances->appends(request()->query())->links() }}

</div>

</div>

@stop