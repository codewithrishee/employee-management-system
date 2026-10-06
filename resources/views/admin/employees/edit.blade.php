@extends('adminlte::page')

@section('title', 'Edit Employee')

@section('content_header')
    <h1>Edit Employee</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Edit Employee
        </h3>

    </div>

    <form action="{{ route('employees.update',$employee->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="card-body">

            @include('admin.employees.form')

        </div>

        <div class="card-footer">

            <button type="submit"
                    class="btn btn-primary">

                <i class="fas fa-save"></i>
                Update Employee

            </button>

            <a href="{{ route('employees.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>
                Back

            </a>

        </div>

    </form>

</div>

@stop