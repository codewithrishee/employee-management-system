@csrf

<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <label>Department <span class="text-danger">*</span></label>

            <select name="department_id" class="form-control">

                <option value="">Select Department</option>

                @foreach($departments as $department)

                    <option value="{{ $department->id }}"
                        {{ old('department_id', $designation->department_id ?? '') == $department->id ? 'selected' : '' }}>

                        {{ $department->name }}

                    </option>

                @endforeach

            </select>

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">

            <label>Designation Name</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $designation->name ?? '') }}"
                   placeholder="Enter Designation">

        </div>
    </div>

    <div class="col-md-12">

        <div class="form-group">

            <label>Description</label>

            <textarea
                name="description"
                class="form-control"
                rows="3">{{ old('description', $designation->description ?? '') }}</textarea>

        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">

            <label>Status</label>

            <select name="status" class="form-control">

                <option value="1"
                    {{ old('status', $designation->status ?? 1) == 1 ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0"
                    {{ old('status', $designation->status ?? 1) == 0 ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

        </div>

    </div>

</div>