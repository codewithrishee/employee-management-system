@extends('adminlte::page')

@section('title', 'Departments')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center">
                <h1>Departments</h1>

                <a href="{{ route('departments.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Department
                </a>
            </div>

        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Department List</h3>
                </div>

                <div class="card-body p-0">

                    <table class="table table-bordered table-hover">

                        <thead>
                        <tr>
                            <th width="60">#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse($departments as $department)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $department->name }}</td>

                                <td>{{ $department->code }}</td>

                               <td>
    @if($department->status)
        <span class="badge bg-success">Active</span>
    @else
        <span class="badge bg-danger">Inactive</span>
    @endif
</td>

                                <td>

                                    <a href="{{ route('departments.edit',$department->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('departments.destroy',$department->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this department?')">
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center">
                                    No Departments Found
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="card-footer">
                    {{ $departments->links() }}
                </div>

            </div>

        </div>

    </section>

</div>

@endsection