@extends('adminlte::page')

@section('title', 'Add Attendance')

@section('content_header')
<h1>Add Attendance</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('attendance.store') }}" method="POST">

            @include('admin.attendance.form')

            <button class="btn btn-success">
                <i class="fas fa-save"></i> Save Attendance
            </button>

            <a href="{{ route('attendance.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

@stop