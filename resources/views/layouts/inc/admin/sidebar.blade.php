<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <i class='bx bx-wallet fs-1'></i>
            </span>
            <span class="app-brand-text fs-5 menu-text fw-bolder ms-2">Angelita Finance</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">


        @hasrole('Superadmin|Admin')
            I am a Superadmin And Admin!
        @else
            I am not a Finance...
        @endhasrole

        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ url('admin/dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master</span>
        </li>
        <!-- Layouts -->
        <li
            class="menu-item {{ request()->segment(2) == 'brands' || request()->segment(2) == 'cars' || request()->segment(2) == 'packages' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-car"></i>
                <div data-i18n="Layouts">Kendaraan</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/cars') ? 'active' : '' }}">
                    <a href="{{ url('admin/cars') }}" class="menu-link">
                        <div data-i18n="Without menu">Mobil</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/brands') ? 'active' : '' }}">
                    <a href="{{ url('admin/brands') }}" class="menu-link">
                        <div data-i18n="Without navbar">Type</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/packages') ? 'active' : '' }}">
                    <a href="{{ url('admin/packages') }}" class="menu-link">
                        <div data-i18n="Without navbar">Paket</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item {{ request()->is('admin/customers') ? 'active' : '' }}">
            <a href="{{ url('admin/customers') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Pelanggan</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('admin/customers/calling') ? 'active' : '' }}">
            <a href="{{ url('admin/customers/calling') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-phone"></i>
                <div data-i18n="Analytics">Confirm</div>
                <div class="badge bg-danger rounded-pill ms-auto">{{ count($customer_nav) }}</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('admin/transactions') ? 'active' : '' }}">
            <a href="{{ url('admin/transactions') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                <div data-i18n="Analytics">Orders</div>
            </a>
        </li>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pengguna</span>
        </li>
        <li class="menu-item {{ request()->is('admin/users') ? 'active' : '' }}">
            <a href="{{ url('admin/users') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Analytics">Administrator</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/finances') ? 'active' : '' }}">
            <a href="{{ url('admin/finances') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Analytics">Finance</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/drivers') ? 'active' : '' }}">
            <a href="{{ url('admin/drivers') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-check-shield"></i>
                <div data-i18n="Analytics">Driver</div>
            </a>
        </li>




        <li class="menu-item">
            <a class="menu-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Log Out</span>
            </a>
        </li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </ul>
</aside>
