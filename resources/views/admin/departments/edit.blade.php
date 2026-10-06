@extends('adminlte::page')

@section('title', 'Edit Department')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Department</h1>
        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Edit Department</h3>
                </div>

                <form action="{{ route('departments.update',$department->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        @include('admin.departments.form')

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>

@endsection