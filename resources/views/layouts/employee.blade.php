<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | EMS</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- AdminLTE CSS --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        {{-- Navbar --}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">

                        {{ auth()->user()->name }}

                    </a>

                    <div class="dropdown-menu dropdown-menu-right">

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <button class="dropdown-item">

                                Logout

                            </button>

                        </form>

                    </div>

                </li>

            </ul>

        </nav>

        {{-- Sidebar --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="{{ route('employee.dashboard') }}" class="brand-link">

                <span class="brand-text font-weight-light">

                    Employee Panel

                </span>

            </a>

            <div class="sidebar">

                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column">

                        <li class="nav-item">

                            <a href="{{ route('employee.dashboard') }}" class="nav-link">

                                <i class="nav-icon fas fa-home"></i>

                                <p>Dashboard</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="{{ route('employee.profile') }}" class="nav-link">

                                <i class="nav-icon fas fa-user"></i>

                                <p>My Profile</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="{{ route('employee.attendance') }}" class="nav-link">

                                <i class="nav-icon fas fa-calendar-check"></i>

                                <p>Attendance</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="{{ route('employee.leaves.index') }}" class="nav-link">

                                <i class="nav-icon fas fa-plane"></i>

                                <p>My Leaves</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="{{ route('employee.payroll') }}" class="nav-link">

                                <i class="nav-icon fas fa-money-bill-wave"></i>

                                <p>Payroll</p>

                            </a>

                        </li>


                        <li class="nav-item">

                            <a href="{{ route('employee.password.edit') }}" class="nav-link">

                                <i class="nav-icon fas fa-key"></i>

                                <p>Change Password</p>

                            </a>

                        </li>

                    </ul>

                </nav>

            </div>

        </aside>

        {{-- Content --}}
        <div class="content-wrapper">

            <section class="content-header">

                <div class="container-fluid">

                    <h3>@yield('page_title')</h3>

                </div>

            </section>

            <section class="content">

                <div class="container-fluid">

                    @yield('content')

                </div>

            </section>

        </div>

    </div>

    {{-- JS --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

</body>

</html>