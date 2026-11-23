<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse shadow-sm min-vh-100 p-3">
    <div class="position-sticky">
        <h6 class="sidebar-heading text-muted text-uppercase fs-7 mb-2">Management</h6>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link text-dark fw-semibold {{ request()->routeIs('admin.dashboard') ? 'active bg-primary text-white rounded' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    📊 Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-dark fw-semibold {{ request()->routeIs('centers.*') ? 'active bg-primary text-white rounded' : '' }}"
                    href="{{ route('centers.index') }}">
                    🏢 Centers
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-dark fw-semibold {{ request()->routeIs('spaces.*') ? 'active bg-primary text-white rounded' : '' }}"
                    href="{{ route('spaces.index') }}">
                    🚪 Spaces
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-dark fw-semibold {{ request()->routeIs('admin.bookings.*') ? 'active bg-primary text-white rounded' : '' }}"
                    href="{{ route('admin.bookings.index') }}">
                    📅 Bookings
                </a>
            </li>
            @if (auth()->check() && auth()->user()->type === 'super_admin')
                <li class="nav-item mb-2">
                    <a class="nav-link text-dark fw-semibold {{ request()->routeIs('admin.employees.*') ? 'active bg-primary text-white rounded' : '' }}"
                        href="{{ route('admin.employees.index') }}">
                        👥 Employees
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
