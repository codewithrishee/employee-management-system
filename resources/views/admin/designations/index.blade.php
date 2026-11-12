@extends('admin.layouts.app')

@section('title', 'Designations')

@section('content_header')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Designations</h1>
    <a href="{{ route('designations.create') }}" class="btn btn-primary mt-2 mt-sm-0">
        <i class="fas fa-plus"></i> Add Designation
    </a>
</div>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Status</th>
                <th width="130" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($designations as $designation)
            <tr>
                <!-- Sahi pagination serial number ke liye firstItem + index use kiya hai -->
                <td>{{ $designations->firstItem() + $loop->index }}</td>
                <td>{{ $designation->department->name ?? '-' }}</td>
                <td>{{ $designation->name }}</td>
                <td>
                    @if($designation->status)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
                <td class="text-center">
                    <!-- Buttons ke beech gap aur alignment fix -->
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('designations.edit', $designation->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('designations.destroy', $designation->id) }}" method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete Designation?')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-muted">No Designations Found</td>
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