<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Attendance Report</title>

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

Attendance Report

<br>

Generated :
{{ now()->format('d M Y h:i A') }}

</p>

<table>

<thead>

<tr>

    <th>#</th>
    <th>Employee ID</th>
    <th>Employee Name</th>
    <th>Date</th>
    <th>Check In</th>
    <th>Check Out</th>
    <th>Status</th>
    <th>Remarks</th>

</tr>

</thead>

<tbody>

@foreach($attendances as $attendance)

<tr>

    <td class="text-center">
        {{ $loop->iteration }}
    </td>

    <td>
        {{ $attendance->employee->employee_id ?? '-' }}
    </td>

    <td>
        {{ $attendance->employee->name ?? '-' }}
    </td>

    <td>
        {{ $attendance->attendance_date }}
    </td>

    <td>
        {{ $attendance->check_in ?? '-' }}
    </td>

    <td>
        {{ $attendance->check_out ?? '-' }}
    </td>

    <td class="text-center">
        {{ $attendance->status }}
    </td>

    <td>
        {{ $attendance->remarks ?? '-' }}
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