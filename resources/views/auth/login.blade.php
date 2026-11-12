
<x-guest-layout>
    <div class="mb-8">
        <span class="text-sm font-semibold uppercase tracking-widest text-blue-700">
            Welcome back
        </span>

        <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
            Sign in to EMS
        </h2>

        <p class="mt-3 text-sm leading-6 text-slate-500">
            Enter your credentials to access your dashboard.
        </p>
    </div>

    <x-auth-session-status
        class="mb-5"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email address')" />

            <x-text-input
                id="email"
                class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 shadow-sm focus:border-blue-600 focus:ring-blue-600"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="you@company.com"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        <div>
            <div class="flex items-center justify-between gap-3">
                <x-input-label for="password" :value="__('Password')" />

                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-sm font-medium text-blue-700 hover:text-blue-900 hover:underline"
                    >
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-text-input
                id="password"
                class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 shadow-sm focus:border-blue-600 focus:ring-blue-600"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Enter your password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        <div>
            <label for="remember_me" class="inline-flex items-center gap-2">
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded border-slate-300 text-blue-700 shadow-sm focus:ring-blue-600"
                />

                <span class="text-sm text-slate-600">
                    {{ __('Remember me') }}
                </span>
            </label>
        </div>

        <button
            type="submit"
            class="flex w-full items-center justify-center rounded-xl bg-slate-900 px-5 py-3.5 text-sm font-semibold text-white shadow-lg transition duration-200 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2"
        >
            Sign in to EMS
        </button>
    </form>

    <div class="mt-6 flex items-center justify-center gap-2 text-xs text-slate-500">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <rect x="4" y="10" width="16" height="11" rx="2"/>
            <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
        </svg>
        Your account is protected by secure authentication.
    </div>
</x-guest-layout>
