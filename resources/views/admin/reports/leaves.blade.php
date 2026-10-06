@extends('adminlte::page')

@section('title','Leave Report')

@section('content_header')
<h1>Leave Report</h1>
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
{{ request('employee_id')==$employee->id ? 'selected':'' }}>

{{ $employee->employee_id }} - {{ $employee->name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-2">

<label>Leave Type</label>

<select name="leave_type" class="form-control">

<option value="">All</option>
<option value="Casual Leave">Casual Leave</option>
<option value="Sick Leave">Sick Leave</option>
<option value="Emergency Leave">Emergency Leave</option>
<option value="Paid Leave">Paid Leave</option>
<option value="Unpaid Leave">Unpaid Leave</option>

</select>

</div>

<div class="col-md-2">

<label>Status</label>

<select name="status" class="form-control">

<option value="">All</option>
<option value="Pending">Pending</option>
<option value="Approved">Approved</option>
<option value="Rejected">Rejected</option>

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

<div class="col-md-1 d-flex align-items-end">

<button class="btn btn-primary btn-block">

Go

</button>

</div>

</div>

</form>

</div>

</div>

<div class="card">

<div class="card-body table-responsive">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>#</th>

<th>Employee</th>

<th>Leave Type</th>

<th>From</th>

<th>To</th>

<th>Status</th>

<th>Reason</th>

</tr>

</thead>

<tbody>

@forelse($leaves as $leave)

<tr>

<td>{{ $leaves->firstItem()+$loop->index }}</td>

<td>{{ $leave->employee->name }}</td>

<td>{{ $leave->leave_type }}</td>

<td>{{ $leave->from_date }}</td>

<td>{{ $leave->to_date }}</td>

<td>{{ $leave->status }}</td>

<td>{{ $leave->reason }}</td>

</tr>

@empty

<tr>

<td colspan="7" class="text-center">

No Records Found

</td>

</tr>

@endforelse

</tbody>

</table>

{{ $leaves->appends(request()->query())->links() }}

</div>

</div>

@stop