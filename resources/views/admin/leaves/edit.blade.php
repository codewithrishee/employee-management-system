@extends('adminlte::page')

@section('title','Edit Leave')

@section('content_header')
<h1>Edit Leave</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">
        

        <form action="{{ route('leaves.update', $leave) }}" method="POST">

            @csrf
            @method('PUT')

            @include('admin.leaves.form')

            <button class="btn btn-primary">
                <i class="fas fa-save"></i>
                Update Leave
            </button>

            <a href="{{ route('leaves.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

@stop