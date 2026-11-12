<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>

    <h2>Hello {{ $leave->employee->name }},</h2>

    <p>Your leave request has been updated.</p>

    <table border="1" cellpadding="8" cellspacing="0">

        <tr>
            <th>Leave Type</th>
            <td>{{ $leave->leave_type }}</td>
        </tr>

        <tr>
            <th>From Date</th>
            <td>{{ $leave->from_date }}</td>
        </tr>

        <tr>
            <th>To Date</th>
            <td>{{ $leave->to_date }}</td>
        </tr>

        <tr>
            <th>Status</th>
            <td>
                <strong>{{ $leave->status }}</strong>
            </td>
        </tr>

    </table>

    <br>

    <p>Thank you.</p>

    <p><strong>Employee Management System</strong></p>

</body>

</html>