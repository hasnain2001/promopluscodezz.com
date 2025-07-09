<!-- ========== Topbar Start ========== -->
<div class="navbar-custom ">
    <div class="topbar">
        <div class="topbar-menu d-flex align-items-center gap-1">
            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>

           <!-- Enhanced Dropdown Menu -->
            <div class="dropdown d-none d-xl-block">
                <a class="nav-link dropdown-toggle waves-effect waves-light fw-semibold" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-plus-circle-outline me-1"></i>
                    Create New
                    <i class="mdi mdi-chevron-down ms-1"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 border-2 shadow">
                    <!-- item-->
                    <a href="{{ route('employee.store.create') }}" class="dropdown-item py-3 px-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-soft-primary rounded p-2 me-3">
                                <i class="mdi mdi-storefront-outline text-primary fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Add New Store</h6>
                                <p class="text-muted mb-0 font-12">Create a new retail store</p>
                            </div>
                        </div>
                    </a>

                    <!-- item-->
                    <a href="{{ route('employee.coupon.create') }}" class="dropdown-item py-3 px-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-soft-success rounded p-2 me-3">
                                <i class="mdi mdi-ticket-percent-outline text-success fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Add New Coupon</h6>
                                <p class="text-muted mb-0 font-12">Create discount offers</p>
                            </div>
                        </div>
                    </a>

                    <!-- item-->
                    <a href="{{ route('employee.category.create')}}" class="dropdown-item py-3 px-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-soft-info rounded p-2 me-3">
                                <i class="mdi mdi-shape-outline text-info fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Add New Category</h6>
                                <p class="text-muted mb-0 font-12">Organize your products</p>
                            </div>
                        </div>
                    </a>

                    <!-- item-->
                    <a href="{{ route('employee.network.create') }}" class="dropdown-item py-3 px-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-soft-warning rounded p-2 me-3">
                                <i class="mdi mdi-access-point-network text-warning fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Add New Network</h6>
                                <p class="text-muted mb-0 font-12">Expand your networks</p>
                            </div>
                        </div>
                    </a>

                    <div class="dropdown-divider m-0"></div>
                </div>
            </div>


        </div>

        <ul class="topbar-menu d-flex align-items-center">
            <!-- Topbar Search Form -->
            <li class="app-search dropdown me-3 d-none d-lg-block">
                <form role="search" class="position-relative d-flex align-items-center" action="{{ route('employee.search') }}" method="GET">
                    <input type="search" class="form-control rounded-pill me-2" name="query" id="searchInput" placeholder="Search store here..." aria-label="Search">
                    <button type="submit" class="btn btn-primary rounded-pill">
                        <i class="fe-search"></i>
                    </button>
                </form>
            </li>

            <!-- Fullscreen Button -->
            <li class="d-none d-md-inline-block">
                <a class="nav-link waves-effect waves-light" href="" data-toggle="fullscreen">
                    <i class="fe-maximize font-22"></i>
                </a>
            </li>

            <!-- Light/Dark Mode Toggle Button -->
            <li class="d-none d-sm-inline-block">
                <div class="nav-link waves-effect waves-light" id="light-dark-mode">
                    <i class="ri-moon-line font-22"></i>
                </div>
            </li>

            <!-- User Dropdown -->
            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                @if(Auth::user()->image)
                <img src="{{ asset('uploads/user/' . Auth::user()->image) }}" alt="user-image" class="rounded-circle">
                @else
                    <img src="{{ asset('assets/images/users/user-5.jpg') }}" alt="default-image" class="rounded-circle">
                @endif
                    <span class="ms-1 d-none d-md-inline-block">
                        {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{ route('profile.edit') }}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('profile.edit') }}" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Settings</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- ========== Topbar End ========== -->
