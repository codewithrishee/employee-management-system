
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EMS') }} - Sign In</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <main class="min-h-screen bg-slate-100 lg:grid lg:grid-cols-2">

        <section class="relative hidden overflow-hidden bg-slate-950 p-12 text-white lg:flex lg:flex-col lg:justify-between xl:p-16">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-full bg-blue-500/20 blur-3xl"></div>
            <div class="absolute -bottom-24 -left-20 h-80 w-80 rounded-full bg-indigo-500/20 blur-3xl"></div>

            <!-- <a href="/" class="relative z-10 flex items-center gap-3">
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-white text-xl font-bold text-slate-950">
                    E
                </span>
                <span class="text-2xl font-bold tracking-tight">EMS</span>
            </a> -->

            <div class="relative z-10 max-w-lg">
                <span class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-300">
                    Employee Management System
                </span>

                <h1 class="mt-6 text-4xl font-bold leading-tight xl:text-5xl">
                    Manage your workforce.
                    <span class="text-blue-300">Move forward together.</span>
                </h1>

                <p class="mt-6 max-w-md text-base leading-7 text-slate-300">
                    Access your employee workspace and manage your work through one organized platform.
                </p>

                <div class="mt-10 space-y-5">
                    <div class="flex items-center gap-3 text-sm text-slate-200">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/10 text-blue-300">✓</span>
                        Centralized employee information
                    </div>

                    <div class="flex items-center gap-3 text-sm text-slate-200">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/10 text-blue-300">✓</span>
                        Organized and efficient workflows
                    </div>

                    <div class="flex items-center gap-3 text-sm text-slate-200">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/10 text-blue-300">✓</span>
                        Secure account access
                    </div>
                </div>
            </div>

            <p class="relative z-10 text-xs text-slate-400">
                © {{ date('Y') }} EMS. All rights reserved.
            </p>
        </section>

        <section class="flex min-h-screen items-center justify-center px-5 py-10 sm:px-10 lg:px-12">
            <div class="w-full max-w-md">

                <div class="mb-8 text-center lg:hidden">
                    <a href="/" class="inline-flex items-center gap-3">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-900 text-xl font-bold text-white">E</span>
                        <span class="text-2xl font-bold text-slate-900">EMS</span>
                    </a>
                </div>

                {{ $slot }}

                <p class="mt-8 text-center text-xs text-slate-500">
                    Secure access to your Employee Management System.
                </p>
            </div>
        </section>

    </main>
</body>
</html>
