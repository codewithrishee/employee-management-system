<form method="post" action="{{ route('password.update') }}" class="mt-2">
    @csrf
    @method('put')

    <div class="row g-3">
        <div class="col-md-4">
            <label for="current_password" class="form-label fw-semibold">Current Password</label>
            <input type="password" id="current_password" name="current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
            @error('current_password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label for="password" class="form-label fw-semibold">New Password</label>
            <input type="password" id="password" name="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
            @error('password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="d-flex align-items-center gap-3 mt-4">
        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-key me-1"></i> Update Password</button>
        @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-success mb-0 fw-semibold">
                <i class="fas fa-check-circle me-1"></i> Password Updated.
            </p>
        @endif
    </div>
</form>