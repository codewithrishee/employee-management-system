
<x-guest-layout>
    <div class="mb-8">
        <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.7">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M20 8v6m3-3h-6"/>
            </svg>
        </div>

        <p class="text-sm font-semibold uppercase tracking-widest text-emerald-700">
            Employee Portal
        </p>

        <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
            Welcome back!
        </h2>

        <p class="mt-3 text-sm leading-6 text-slate-500">
            Sign in to view your profile, attendance, leaves and work information.
        </p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('employee.login.store') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Employee email address"
                class="font-semibold text-slate-700" />

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="you@company.com"
                class="mt-2 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10"
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between gap-3">
                <x-input-label for="password" value="Password"
                    class="font-semibold text-slate-700" />

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-xs font-semibold text-emerald-700 hover:text-emerald-900">
                        Forgot password?
                    </a>
                @endif
            </div>

            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Enter your password"
                class="mt-2 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label class="flex cursor-pointer items-center gap-2.5">
            <input
                type="checkbox"
                name="remember"
                value="1"
                class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600"
            />
            <span class="text-sm text-slate-600">Remember me</span>
        </label>

        <button
            type="submit"
            class="group flex w-full items-center justify-center gap-3 rounded-xl bg-emerald-700 px-5 py-4 text-sm font-semibold text-white shadow-lg shadow-emerald-700/20 transition duration-200 hover:-translate-y-0.5 hover:bg-emerald-800 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-emerald-500/20"
        >
            Sign in to Employee Portal

            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5 12h14m-6-6 6 6-6 6"/>
            </svg>
        </button>
    </form>

    <div class="my-7 flex items-center gap-4">
        <div class="h-px flex-1 bg-slate-200"></div>
        <span class="text-xs text-slate-400">EMPLOYEE ACCESS</span>
        <div class="h-px flex-1 bg-slate-200"></div>
    </div>

    <a href="/"
       class="flex w-full items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3.5 text-sm font-semibold text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50">
        Back to homepage
    </a>

    <div class="mt-7 text-center">
        <a href="{{ route('admin.login') }}"
           class="text-sm font-semibold text-blue-700 hover:underline">
            Admin login →
        </a>
    </div>
</x-guest-layout>
