{{-- <header class="py-3 mb-3 border-bottom bg-white">
    <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
        <a href="" class="ms-3 text-muted" id="menu-toggle"><i class="feather-menu fa-2x"></i>
        </a>
        <div class="d-flex align-items-center">
            <div class="w-100 me-3">
            </div>
            <div class="flex-shrink-0 dropdown me-3">
                <a href="#" class="d-block link-dark text-decoration-none text-muted" id="dropdownUser2"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="" alt="mdo" width="32" height="32" class="rounded-circle"> <b> {{ Auth::user()->name
                        }}</b>
                </a>
                <ul class="dropdown-menu text-small shadow border-0 mt-3" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item p-2 text-muted" href="#"><i class="feather-user"></i> Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="feather-log-out"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </li>

                </ul>
            </div>
        </div>
    </div>
</header> --}}


<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                    aria-label="Search..." />
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->


            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded-circle bg-label-primary p-3"><i
                                    class="bx bx-user display-6"></i></span>
                        </div>

                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded-circle bg-label-primary p-3"><i
                                            class="bx bx-user display-6"></i></span>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()->name
                                        }}</span>
                                    <small class="text-muted">
                                        @if(Auth::user()->role_as == '1')
                                        Administratior
                                        @elseif(Auth::user()->role_as == '2')
                                        Admin
                                        @elseif(Auth::user()->role_as == '4')
                                        Security
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </a>
                    </li>
                    {{-- <li>
                        <div class="dropdown-divider"></div>
                    </li> --}}
                    {{-- <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <span class="d-flex align-items-center align-middle">
                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                <span class="flex-grow-1 align-middle">Billing</span>
                                <span
                                    class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                            </span>
                        </a>
                    </li> --}}
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>