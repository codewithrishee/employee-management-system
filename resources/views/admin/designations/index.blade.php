@extends('adminlte::page')

@section('title','Designations')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Designations</h1>

    <a href="{{ route('designations.create') }}"
       class="btn btn-primary">

        <i class="fas fa-plus"></i>
        Add Designation

    </a>

</div>

@stop

@section('content')

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

<div class="card">

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover">

            <thead>

            <tr>

                <th>#</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Status</th>
                <th width="170">Action</th>

            </tr>

            </thead>

            <tbody>

            @forelse($designations as $designation)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $designation->department->name }}</td>

                <td>{{ $designation->name }}</td>

                <td>

                    @if($designation->status)

                        <span class="badge badge-success">
                            Active
                        </span>

                    @else

                        <span class="badge badge-danger">
                            Inactive
                        </span>

                    @endif

                </td>

                <td>

                    <a href="{{ route('designations.edit',$designation->id) }}"
                       class="btn btn-warning btn-sm">

                        <i class="fas fa-edit"></i>

                    </a>

                    <form action="{{ route('designations.destroy',$designation->id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete Designation?')">

                            <i class="fas fa-trash"></i>

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5" class="text-center">
                    No Designations Found
                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

        <div class="mt-3">
            {{ $designations->links() }}
        </div>

    </div>

</div>

@stop