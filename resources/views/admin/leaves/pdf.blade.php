<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

body{
    font-family: DejaVu Sans;
    font-size:12px;
}

h2{
    text-align:center;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#0d6efd;
    color:#fff;
    border:1px solid #000;
    padding:8px;
}

td{
    border:1px solid #000;
    padding:7px;
}

</style>

</head>

<body>

<h2>Employee Management System</h2>

<p align="center">

Leave Report

<br>

{{ now()->format('d M Y h:i A') }}

</p>

<table>

<thead>

<tr>

<th>#</th>
<th>Employee ID</th>
<th>Employee</th>
<th>Leave Type</th>
<th>From</th>
<th>To</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($leaves as $leave)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $leave->employee->employee_id ?? '-' }}</td>

<td>{{ $leave->employee->name ?? '-' }}</td>

<td>{{ $leave->leave_type }}</td>

<td>{{ $leave->from_date }}</td>

<td>{{ $leave->to_date }}</td>

<td>{{ $leave->status }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>

</html>