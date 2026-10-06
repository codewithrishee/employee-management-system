@extends('adminlte::page')

@section('title','Company Settings')

@section('content_header')
<h1>Company Settings</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('company-settings.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @include('admin.company-settings.form')

            <button class="btn btn-success">

                <i class="fas fa-save"></i>

                Save Settings

            </button>

            <a href="{{ route('company-settings.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </form>

    </div>

</div>

@stop