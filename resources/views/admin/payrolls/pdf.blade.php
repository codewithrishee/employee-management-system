<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<style>

body{
    font-family:DejaVu Sans;
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
    color:white;
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

Payroll Report

<br>

{{ now()->format('d M Y h:i A') }}

</p>

<table>

<thead>

<tr>

<th>#</th>

<th>Employee ID</th>

<th>Employee</th>

<th>Month</th>

<th>Basic</th>

<th>Bonus</th>

<th>Deduction</th>

<th>Net Salary</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($payrolls as $payroll)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $payroll->employee->employee_id ?? '-' }}</td>

<td>{{ $payroll->employee->name ?? '-' }}</td>

<td>{{ $payroll->month }}</td>

<td>₹{{ number_format($payroll->basic_salary,2) }}</td>

<td>₹{{ number_format($payroll->bonus,2) }}</td>

<td>₹{{ number_format($payroll->deduction,2) }}</td>

<td>₹{{ number_format($payroll->net_salary,2) }}</td>

<td>{{ $payroll->payment_status }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>

</html>