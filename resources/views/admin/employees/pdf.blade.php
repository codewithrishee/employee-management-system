<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Employee Report</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
            color:#333;
        }

        h2{
            text-align:center;
            margin-bottom:5px;
        }

        p{
            text-align:center;
            margin-top:0;
            margin-bottom:20px;
        }

        table{

            width:100%;
            border-collapse:collapse;

        }

        th{

            background:#0d6efd;
            color:#fff;
            padding:8px;
            border:1px solid #000;

        }

        td{

            border:1px solid #000;
            padding:7px;

        }

        .text-center{

            text-align:center;

        }

        .footer{

            margin-top:40px;

        }

    </style>

</head>

<body>

<h2>Employee Management System</h2>

<p>

Employee Report

<br>

Generated :
{{ now()->format('d M Y h:i A') }}

</p>

<table>

<thead>

<tr>

<th>#</th>

<th>Emp ID</th>

<th>Name</th>

<th>Department</th>

<th>Designation</th>

<th>Email</th>

<th>Phone</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($employees as $employee)

<tr>

<td class="text-center">

{{ $loop->iteration }}

</td>

<td>

{{ $employee->employee_id }}

</td>

<td>

{{ $employee->name }}

</td>

<td>

{{ $employee->department->name ?? '-' }}

</td>

<td>

{{ $employee->designation->name ?? '-' }}

</td>

<td>

{{ $employee->email }}

</td>

<td>

{{ $employee->phone }}

</td>

<td class="text-center">

@if($employee->status)

Active

@else

Inactive

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

<div class="footer">

<table width="100%">

<tr>

<td>

Prepared By

</td>

<td align="right">

Authorized Signature

</td>

</tr>

</table>

</div>

</body>

</html>