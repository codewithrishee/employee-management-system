@extends('adminlte::page')

@section('title','Add Leave')

@section('content_header')
<h1>Add Leave</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('leaves.store') }}" method="POST">

            @include('admin.leaves.form')

            <button class="btn btn-success">
                <i class="fas fa-save"></i> Save Leave
            </button>

            <a href="{{ route('leaves.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

@stop