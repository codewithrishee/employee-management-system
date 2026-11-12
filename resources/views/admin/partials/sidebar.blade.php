<aside class="ems-sidebar">
    <a class="ems-brand" href="{{ route('dashboard') }}">
    <img
        src="{{ asset('images/ems-logo.png') }}"
        alt="EMS - Employee Management System"
        class="ems-brand-logo"
    >
</a>
    <div class="sidebar-user"><div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div><div><strong>{{ auth()->user()->name ?? 'Administrator' }}</strong><small>Administrator</small></div><span class="online-dot"></span></div>
    <div class="nav-caption">WORKSPACE</div>
    <nav class="ems-nav">
      <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill"></i> Overview</a>
      <a href="{{ route('employees.index') }}" class="{{ request()->routeIs('employees.*') ? 'active' : '' }}"><i class="bi bi-people"></i> Employees</a>
      <a href="{{ route('departments.index') }}" class="{{ request()->routeIs('departments.*') ? 'active' : '' }}"><i class="bi bi-building"></i> Departments</a>
      <a href="{{ route('designations.index') }}" class="{{ request()->routeIs('designations.*') ? 'active' : '' }}"><i class="bi bi-person-vcard"></i> Designations</a>
      <a href="{{ route('attendance.index') }}" class="{{ request()->routeIs('attendance.*') ? 'active' : '' }}"><i class="bi bi-calendar2-check"></i> Attendance</a>
      <a href="{{ route('leaves.index') }}" class="{{ request()->routeIs('leaves.*') ? 'active' : '' }}"><i class="bi bi-calendar2-week"></i> Leave requests</a>
      <a href="{{ route('payrolls.index') }}" class="{{ request()->routeIs('payrolls.*') ? 'active' : '' }}"><i class="bi bi-wallet2"></i> Payroll</a>
    </nav>
    <div class="nav-caption mt-4">INSIGHTS & SETTINGS</div>
    <nav class="ems-nav">
      <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'active' : '' }}"><i class="bi bi-bar-chart-line"></i> Reports</a>
      <a href="{{ route('company-settings.index') }}" class="{{ request()->routeIs('company-settings.*') ? 'active' : '' }}"><i class="bi bi-sliders"></i> Company settings</a>
      <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}"><i class="bi bi-person-gear"></i> My profile</a>
    </nav>
    <div class="sidebar-bottom"><div class="help-card"><i class="bi bi-life-preserver"></i><strong>Need a hand?</strong><small>Your workspace, made simpler.</small></div><div class="sidebar-version">EMS · Admin workspace</div></div>
</aside>


<style>

.ems-shell {
    display: flex;
    height: 100vh;
    overflow: hidden;
}

.ems-main {
    flex: 1 1 auto;
    min-width: 0;
    min-height: 0;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.ems-content {
    flex: 1 1 auto;
    min-height: 0;
    overflow-y: auto;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.ems-topbar,
.ems-footer {
    flex: 0 0 auto;
}

.ems-sidebar {
    flex: 0 0 auto;
    height: 100vh;
    overflow-y: auto;
    overflow-x: hidden;
}

.ems-body {
    overflow: hidden;
}

.ems-content .table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}


.ems-brand {
    display: flex;
    align-items: center;
    text-decoration: none;
    padding: 1px 16px;
}

.ems-brand-logo {
    display: block;
    width: 100%;
    max-width: 210px;
    height: 90px;
    object-fit: contain;
    object-position: left center;
}
</style>