@extends('adminlte::page')

@section('title', 'Add Employee')

@section('content_header')
    <h1>Add Employee</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Employee Information
        </h3>

    </div>

    <form action="{{ route('employees.store') }}"
          method="POST"
          enctype="multipart/form-data">

        <div class="card-body">

            @include('admin.employees.form')

        </div>

        <div class="card-footer">

            <button type="submit"
                    class="btn btn-success">

                <i class="fas fa-save"></i>
                Save Employee

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