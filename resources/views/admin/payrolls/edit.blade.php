@extends('adminlte::page')

@section('title','Edit Payroll')

@section('content_header')
<h1>Edit Payroll</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('payrolls.update',$payroll->id) }}" method="POST">

            @csrf
            @method('PUT')

            @include('admin.payrolls.form')

            <button class="btn btn-primary">

                <i class="fas fa-save"></i>

                Update Payroll

            </button>

            <a href="{{ route('payrolls.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </form>

    </div>

</div>

@stop