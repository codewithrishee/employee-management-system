@extends('adminlte::page')

@section('title','Edit Company Settings')

@section('content_header')
<h1>Edit Company Settings</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('company-settings.update',$company->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            @include('admin.company-settings.form')

            <button class="btn btn-primary">

                <i class="fas fa-save"></i>

                Update Settings

            </button>

            <a href="{{ route('company-settings.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </form>

    </div>

</div>

@stop