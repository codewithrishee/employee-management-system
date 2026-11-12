@csrf

<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <label>Company Name <span class="text-danger">*</span></label>
            <input type="text"
                   name="company_name"
                   class="form-control"
                   value="{{ old('company_name', $company->company_name ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email', $company->email ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Phone</label>
            <input type="text"
                   name="phone"
                   class="form-control"
                   value="{{ old('phone', $company->phone ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Website</label>
            <input type="text"
                   name="website"
                   class="form-control"
                   value="{{ old('website', $company->website ?? '') }}">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Address</label>
            <textarea name="address"
                      rows="3"
                      class="form-control">{{ old('address', $company->address ?? '') }}</textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Footer Text</label>
            <input type="text"
                   name="footer_text"
                   class="form-control"
                   value="{{ old('footer_text', $company->footer_text ?? '') }}">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Company Logo</label>

            <input type="file"
                   name="logo"
                   class="form-control">

            @if(isset($company) && $company->logo)

                <div class="mt-3">
                    <img src="{{ asset('uploads/company/'.$company->logo) }}"
                         width="120"
                         class="img-thumbnail">
                </div>

            @endif

        </div>
    </div>

</div>