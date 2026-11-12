<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Workspace') · EMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/ems-favicon.png') }}">
    <link href="{{ asset('css/ems.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body class="ems-body">

    <div class="ems-shell">

        {{-- Sidebar --}}
        <aside class="ems-sidebar">

            <a class="ems-brand" href="{{ route('employee.dashboard') }}">
                <img
                    src="{{ asset('images/ems-logo.png') }}"
                    alt="EMS - Employee Management System"
                    class="ems-brand-logo"
                >
            </a>

            <div class="sidebar-user">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'E', 0, 1)) }}
                </div>

                <div class="sidebar-user-info">
                    <strong>{{ auth()->user()->name ?? 'Employee' }}</strong>
                    <small>Employee</small>
                </div>

                <span class="online-dot"></span>
            </div>

            <div class="nav-caption">MY WORKSPACE</div>

            <nav class="ems-nav">

                <a href="{{ route('employee.dashboard') }}"
                   class="{{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('employee.profile') }}"
                   class="{{ request()->routeIs('employee.profile*') ? 'active' : '' }}">
                    <i class="bi bi-person"></i>
                    <span>My Profile</span>
                </a>

                <a href="{{ route('employee.attendance') }}"
                   class="{{ request()->routeIs('employee.attendance') ? 'active' : '' }}">
                    <i class="bi bi-calendar2-check"></i>
                    <span>Attendance</span>
                </a>

                <a href="{{ route('employee.leaves.index') }}"
                   class="{{ request()->routeIs('employee.leaves.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar2-week"></i>
                    <span>My Leaves</span>
                </a>

                <a href="{{ route('employee.payroll') }}"
                   class="{{ request()->routeIs('employee.payroll') ? 'active' : '' }}">
                    <i class="bi bi-wallet2"></i>
                    <span>Payroll</span>
                </a>

                <a href="{{ route('employee.password.edit') }}"
                   class="{{ request()->routeIs('employee.password.*') ? 'active' : '' }}">
                    <i class="bi bi-shield-lock"></i>
                    <span>Change Password</span>
                </a>

            </nav>

            <div class="sidebar-bottom">
                <div class="sidebar-version">
                    <i class="bi bi-shield-check"></i>
                    EMS · Employee Workspace
                </div>
            </div>

        </aside>

        {{-- Main Application --}}
        <div class="ems-main">

            {{-- Topbar --}}
            <header class="ems-topbar">

                <button
                    type="button"
                    class="icon-button"
                    data-ems-toggle
                    aria-label="Toggle sidebar"
                    aria-expanded="true"
                >
                    <i class="bi bi-list"></i>
                </button>

                <div class="topbar-search">
                    <i class="bi bi-house-door"></i>
                    <span>Employee Workspace</span>
                </div>

                <div class="topbar-actions">

                    <div class="dropdown">

                        <button
                            type="button"
                            class="profile-trigger dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <span class="user-avatar small-avatar">
                                {{ strtoupper(substr(auth()->user()->name ?? 'E', 0, 1)) }}
                            </span>

                            <span class="profile-name">
                                {{ auth()->user()->name ?? 'Employee' }}
                            </span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('employee.profile') }}">
                                    <i class="bi bi-person me-2"></i>
                                    My Profile
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        Sign Out
                                    </button>
                                </form>
                            </li>

                        </ul>

                    </div>

                </div>

            </header>

            {{-- Page Content --}}
            <main class="ems-content">

                <div class="page-heading">
                    <div>
                        <div class="eyebrow">YOUR WORKSPACE</div>
                        <h1>@yield('page_title', 'Dashboard')</h1>
                    </div>

                    @yield('page_actions')
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')

            </main>

            {{-- Footer --}}
            <footer class="ems-footer">
                <span>© {{ date('Y') }} EMS</span>
                <span>Employee Management System</span>
            </footer>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        (() => {
            const toggle = document.querySelector('[data-ems-toggle]');
            const shell = document.querySelector('.ems-shell');

            if (toggle && shell) {
                toggle.addEventListener('click', () => {
                    shell.classList.toggle('sidebar-collapsed');

                    toggle.setAttribute(
                        'aria-expanded',
                        String(!shell.classList.contains('sidebar-collapsed'))
                    );
                });
            }
        })();
    </script>

    @stack('scripts')

</body>
</html>
