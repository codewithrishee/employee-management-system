@extends('adminlte::page')

@section('title', 'Edit Attendance')

@section('content_header')
<h1>Edit Attendance</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">

            @csrf
            @method('PUT')

            @include('admin.attendance.form')

            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Update Attendance
            </button>

            <a href="{{ route('attendance.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

@stop