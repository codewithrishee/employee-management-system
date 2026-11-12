@csrf

<div class="form-group">

    <label>Department Name</label>

    <input
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $department->name ?? '') }}">

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>


<div class="form-group">

    <label>Department Code</label>

    <input
        type="text"
        name="code"
        class="form-control @error('code') is-invalid @enderror"
        value="{{ old('code', $department->code ?? '') }}">

    @error('code')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>


<div class="form-group">

    <label>Description</label>

    <textarea
        name="description"
        rows="4"
        class="form-control">{{ old('description', $department->description ?? '') }}</textarea>

</div>


<div class="form-group">

    <label>Status</label>

    <select name="status" class="form-control">

        <option value="1"
            {{ old('status', $department->status ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>

        <option value="0"
            {{ old('status', $department->status ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>

    </select>

</div>


<button class="btn btn-success">
    Save Department
</button>

<a href="{{ route('departments.index') }}"
   class="btn btn-secondary">
    Cancel
</a>