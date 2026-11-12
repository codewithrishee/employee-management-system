<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="mt-2">
    @csrf
    @method('patch')

    <div class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-warning small mb-1">
                        <i class="fas fa-exclamation-triangle me-1"></i> Your email address is unverified.
                        <button form="send-verification" class="btn btn-link p-0 text-decoration-none small align-baseline">Click here to re-send.</button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success small mb-0 fw-semibold">A new verification link has been sent!</p>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <div class="d-flex align-items-center gap-3 mt-4">
        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-1"></i> Save</button>
        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-success mb-0 fw-semibold">
                <i class="fas fa-check-circle me-1"></i> Saved.
            </p>
        @endif
    </div>
</form>