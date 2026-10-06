@extends('adminlte::page')

@section('title','Add Payroll')

@section('content_header')
<h1>Add Payroll</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('payrolls.store') }}" method="POST">

            @include('admin.payrolls.form')

            <button class="btn btn-success">

                <i class="fas fa-save"></i>

                Save Payroll

            </button>

            <a href="{{ route('payrolls.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </form>

    </div>

</div>

@stop