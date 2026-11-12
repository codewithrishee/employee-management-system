<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') · EMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/ems.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body class="ems-body">
<div class="ems-shell">
    @include('admin.partials.sidebar')
    <div class="ems-main">
        @include('admin.partials.navbar')
        <main class="ems-content">
            @if (session('success')) <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div> @endif
            @if (session('error')) <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div> @endif
            @yield('content_header')
            @yield('content')
        </main>
        <footer class="ems-footer">© {{ date('Y') }} EMS <span>Employee Management System</span></footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
(() => { const toggle=document.querySelector('[data-ems-toggle]'); const shell=document.querySelector('.ems-shell'); if(toggle&&shell) toggle.addEventListener('click',()=>shell.classList.toggle('sidebar-collapsed')); })();
</script>
@yield('js')
@stack('scripts')
</body></html>
