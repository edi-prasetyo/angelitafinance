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


        @hasrole('superadmin|finance')
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

            <li class="menu-item {{ request()->is('admin/banks') ? 'active' : '' }}">
                <a href="{{ url('admin/banks') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-credit-card-alt"></i>
                    <div data-i18n="Analytics">Bank</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/timers') ? 'active' : '' }}">
                <a href="{{ url('admin/timers') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-timer"></i>
                    <div data-i18n="Analytics">Timers</div>
                </a>
            </li>




            <li
                class="menu-item {{ request()->segment(2) == 'customers' || request()->segment(3) == 'customers/calling' ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-user-plus"></i>
                    <div data-i18n="Layouts">Customers</div>
                </a>

                <ul class="menu-sub">

                    <li class="menu-item {{ request()->is('admin/customers') ? 'active' : '' }}">
                        <a href="{{ url('admin/customers') }}" class="menu-link">
                            {{-- <i class="menu-icon tf-icons bx bx-user"></i> --}}
                            <div data-i18n="Analytics">Pelanggan</div>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->is('admin/customers/calling') ? 'active' : '' }}">
                        <a href="{{ url('admin/customers/calling') }}" class="menu-link">
                            {{-- <i class="menu-icon tf-icons bx bx-phone"></i> --}}
                            <div data-i18n="Analytics">Confirm</div>
                            <div class="badge bg-danger rounded-pill ms-auto">{{ count($customer_nav) }}</div>
                        </a>
                    </li>


                </ul>
            </li>


            <li class="menu-item {{ request()->is('admin/orders') ? 'active' : '' }}">
                <a href="{{ url('admin/orders') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                    <div data-i18n="Analytics">Orders</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Pengguna</span>
            </li>

            <li class="menu-item {{ request()->is('admin/rentals') ? 'active' : '' }}">
                <a href="{{ url('admin/rentals') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-store-alt"></i>
                    <div data-i18n="Analytics">Rental</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/partners') ? 'active' : '' }}">
                <a href="{{ url('admin/partners') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-coffee"></i>
                    <div data-i18n="Analytics">Partner</div>
                </a>
            </li>


            <li class="menu-item {{ request()->is('admin/drivers') ? 'active' : '' }}">
                <a href="{{ url('admin/drivers') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-check-shield"></i>
                    <div data-i18n="Analytics">Driver</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/users') ? 'active' : '' }}">
                <a href="{{ url('admin/users') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-pin"></i>
                    <div data-i18n="Analytics">Admin</div>
                </a>
            </li>


            {{-- <li class="menu-item {{ request()->is('admin/finances') ? 'active' : '' }}">
                <a href="{{ url('admin/finances') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-plus"></i>
                    <div data-i18n="Analytics">Finance</div>
                </a>
            </li> --}}
        @endhasrole

        @hasrole('superadmin')
            <li class="menu-item {{ request()->is('admin/reports') ? 'active' : '' }}">
                <a href="{{ url('admin/reports') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-pie-chart-alt-2"></i>
                    <div data-i18n="Analytics">Reports</div>
                </a>
            </li>
        @endhasrole

        @hasrole('admin')
            <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>
            <li
                class="menu-item {{ request()->segment(2) == 'customers' || request()->segment(3) == 'customers/calling' ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-user-plus"></i>
                    <div data-i18n="Layouts">Customers</div>
                </a>

                <ul class="menu-sub">

                    <li class="menu-item {{ request()->is('admin/customers') ? 'active' : '' }}">
                        <a href="{{ url('admin/customers') }}" class="menu-link">
                            {{-- <i class="menu-icon tf-icons bx bx-user"></i> --}}
                            <div data-i18n="Analytics">Pelanggan</div>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->is('admin/customers/calling') ? 'active' : '' }}">
                        <a href="{{ url('admin/customers/calling') }}" class="menu-link">
                            {{-- <i class="menu-icon tf-icons bx bx-phone"></i> --}}
                            <div data-i18n="Analytics">Confirm</div>
                            <div class="badge bg-danger rounded-pill ms-auto">{{ count($customer_nav) }}</div>
                        </a>
                    </li>


                </ul>
            </li>
        @endhasrole

        @hasrole('marketing')
            <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/orders') ? 'active' : '' }}">
                <a href="{{ url('admin/orders') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                    <div data-i18n="Analytics">Orders</div>
                </a>
            </li>
        @endhasrole


        @hasrole('superadmin')
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Pengaturan</span>
            </li>

            <li class="menu-item {{ request()->is('admin/roles') ? 'active' : '' }}">
                <a href="{{ url('admin/roles') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                    <div data-i18n="Analytics">Roles</div>
                </a>
            </li>
        @endhasrole



    </ul>
</aside>
