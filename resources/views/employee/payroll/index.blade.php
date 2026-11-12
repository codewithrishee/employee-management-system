@extends('layouts.employee')

@section('title', 'My Payroll')
@section('page_title', 'My Payroll')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title">My Salary Slips</h3>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover">

            <thead>

                <tr>

                    <th>#</th>
                    <th>Month</th>
                    <th>Basic Salary</th>
                    <th>Bonus</th>
                    <th>Deduction</th>
                    <th>Net Salary</th>
                    <th>Status</th>
                    <th>Payment Date</th>

                </tr>

            </thead>

            <tbody>

            @forelse($payrolls as $payroll)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $payroll->month }}</td>

                    <td>₹{{ number_format($payroll->basic_salary, 2) }}</td>

                    <td>₹{{ number_format($payroll->bonus, 2) }}</td>

                    <td>₹{{ number_format($payroll->deduction, 2) }}</td>

                    <td>
                        <strong>
                            ₹{{ number_format($payroll->net_salary, 2) }}
                        </strong>
                    </td>

                    <td>

                        @if($payroll->payment_status == 'Paid')

                            <span class="badge badge-success">
                                Paid
                            </span>

                        @else

                            <span class="badge badge-warning">
                                Pending
                            </span>

                        @endif

                    </td>

                    <td>

                        {{ $payroll->payment_date ?? '-' }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="text-center">

                        No Salary Record Found

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection