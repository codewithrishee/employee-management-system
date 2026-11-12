@csrf

<div class="row">

    {{-- Department --}}
    <div class="col-md-6">
        <div class="form-group">
            <label>Department <span class="text-danger">*</span></label>

            <select name="department_id" class="form-control @error('department_id') is-invalid @enderror">

                <option value="">Select Department</option>

                @foreach($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ old('department_id', $employee->department_id ?? '') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach

            </select>

            @error('department_id')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror

        </div>
    </div>

    {{-- Name --}}
    <div class="col-md-6">
        <div class="form-group">
            <label>Employee Name <span class="text-danger">*</span></label>

            <input type="text"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $employee->name ?? '') }}"
                   placeholder="Enter Employee Name">

            @error('name')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror

        </div>
    </div>

    {{-- Email --}}
    <div class="col-md-6">
        <div class="form-group">
            <label>Email <span class="text-danger">*</span></label>

            <input type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $employee->email ?? '') }}"
                   placeholder="Enter Email">

            @error('email')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror

        </div>
    </div>

    {{-- Phone --}}
    <div class="col-md-6">
        <div class="form-group">
            <label>Phone <span class="text-danger">*</span></label>

            <input type="text"
                   name="phone"
                   class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone', $employee->phone ?? '') }}"
                   placeholder="Enter Phone Number">

            @error('phone')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror

        </div>
    </div>

  {{-- Designation --}}
<div class="col-md-6">
    <div class="form-group">
        <label>Designation <span class="text-danger">*</span></label>

        <select name="designation_id"
                class="form-control @error('designation_id') is-invalid @enderror">

            <option value="">Select Designation</option>

            @foreach($designations as $designation)

                <option value="{{ $designation->id }}"
                    {{ old('designation_id', $employee->designation_id ?? '') == $designation->id ? 'selected' : '' }}>

                    {{ $designation->name }}

                </option>

            @endforeach

        </select>

        @error('designation_id')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror

    </div>
</div>

    {{-- Salary --}}
    <div class="col-md-6">
        <div class="form-group">
            <label>Salary</label>

            <input type="number"
                   name="salary"
                   class="form-control"
                   value="{{ old('salary', $employee->salary ?? '') }}"
                   placeholder="25000">

        </div>
    </div>

    {{-- Joining Date --}}
    <div class="col-md-6">
        <div class="form-group">
            <label>Joining Date</label>

            <input type="date"
                   name="joining_date"
                   class="form-control"
                   value="{{ old('joining_date', isset($employee) && $employee->joining_date ? \Carbon\Carbon::parse($employee->joining_date)->format('Y-m-d') : '') }}">

        </div>
    </div>

    {{-- Gender --}}
    <div class="col-md-6">
        <div class="form-group">
            <label>Gender</label>

            <select name="gender" class="form-control">

                <option value="Male" {{ old('gender', $employee->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>

                <option value="Female" {{ old('gender', $employee->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>

                <option value="Other" {{ old('gender', $employee->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>

            </select>

        </div>
    </div>

    {{-- DOB --}}
    <div class="col-md-6">
        <div class="form-group">
            <label>Date of Birth</label>

            <input type="date"
                   name="date_of_birth"
                   class="form-control"
                   value="{{ old('date_of_birth', isset($employee) && $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('Y-m-d') : '') }}">

        </div>
    </div>

    {{-- Status --}}
    <div class="col-md-6">
        <div class="form-group">
            <label>Status</label>

            <select name="status" class="form-control">

                <option value="1" {{ old('status', $employee->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>

                <option value="0" {{ old('status', $employee->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>

            </select>

        </div>
    </div>

    {{-- Address --}}
    <div class="col-md-12">
        <div class="form-group">
            <label>Address</label>

            <textarea name="address"
                      rows="3"
                      class="form-control"
                      placeholder="Enter Address">{{ old('address', $employee->address ?? '') }}</textarea>

        </div>
    </div>

    {{-- Image --}}
    <div class="col-md-12">
        <div class="form-group">

            <label>Profile Image</label>

            <input type="file"
                   name="image"
                   class="form-control">

            @if(isset($employee) && $employee->image)

                <div class="mt-2">
                    <img src="{{ asset('uploads/employees/'.$employee->image) }}"
                         width="100"
                         class="img-thumbnail">
                </div>

            @endif

        </div>
    </div>

</div>