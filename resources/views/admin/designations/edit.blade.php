@extends('adminlte::page')

@section('title','Edit Designation')

@section('content_header')
<h1>Edit Designation</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('designations.update',$designation->id) }}" method="POST">

            @csrf
            @method('PUT')

            @include('admin.designations.form')

            <button class="btn btn-primary">
                <i class="fas fa-save"></i>
                Update
            </button>

            <a href="{{ route('designations.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

@stop