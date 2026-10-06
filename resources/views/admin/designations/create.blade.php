@extends('adminlte::page')

@section('title','Add Designation')

@section('content_header')
<h1>Add Designation</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('designations.store') }}" method="POST">

            @include('admin.designations.form')

            <button class="btn btn-success">
                <i class="fas fa-save"></i>
                Save
            </button>

            <a href="{{ route('designations.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

@stop