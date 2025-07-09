<!-- ========== Menu ========== -->
<div class="app-menu text-ellipsis text-capitalize">
    <!-- Brand Logo -->
    <div class="logo-box text-center py-4">
        <a href="{{ route('employee.dashboard') }}" class="d-flex align-items-center justify-content-center gap-2">
            <span class="logo-img">
                <x-application-logo class="logo-lg" alt="Employee Dashboard Logo" />
            </span>

        </a>
    </div>

    <!-- Menu Content -->
    <div class="scrollbar">
        <ul class="menu">
            <!-- Dashboard Section -->
            <li class="menu-title">Navigation</li>
            <li class="menu-item">
                <a href="{{ route('employee.dashboard') }}" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-tachometer-alt"></i></span>
                    <span class="menu-text">Employee Dashboard</span>
                 
                </a>
            </li>

            <!-- AMS Section -->
            <li class="menu-title">AMS Management</li>



            <!-- Categories -->
            <li class="menu-item">
                <a href="#category" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-tags"></i></span>
                    <span class="menu-text">Categories</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="category">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('employee.category.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-list-ol"></i></span>
                                <span class="menu-text">All Categories</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('employee.category.create') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-plus-circle"></i></span>
                                <span class="menu-text">Add New Category</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Stores -->
            <li class="menu-item">
                <a href="#store" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-store"></i></span>
                    <span class="menu-text">Stores</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="store">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('employee.store.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-th-list"></i></span>
                                <span class="menu-text">All Stores</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('employee.store.create') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-store-alt"></i></span>
                                <span class="menu-text">Add New Store</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Networks -->
            <li class="menu-item">
                <a href="#network" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-network-wired"></i></span>
                    <span class="menu-text">Networks</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="network">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('employee.network.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-project-diagram"></i></span>
                                <span class="menu-text">All Networks</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('employee.network.create') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-plus"></i></span>
                                <span class="menu-text">Add New Network</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Coupons -->
            <li class="menu-item">
                <a href="#coupon" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-ticket-alt"></i></span>
                    <span class="menu-text">Coupons</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="coupon">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('employee.coupon.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-list-ul"></i></span>
                                <span class="menu-text">All Coupons</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('employee.coupon.create') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-ticket"></i></span>
                                <span class="menu-text">Add New Coupon</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Blogs -->
            <li class="menu-item">
                <a href="#blog" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-blog"></i></span>
                    <span class="menu-text">Blogs</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="blog">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('employee.blog.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-list"></i></span>
                                <span class="menu-text">All Blogs</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('employee.blog.create') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-plus"></i></span>
                                <span class="menu-text">Add New Blog</span>
                            </a>
                        </li>
                    </ul>

            <!-- Additional Menu Items -->
            <li class="menu-title">Reports</li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-chart-line"></i></span>
                    <span class="menu-text">Analytics</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-file-alt"></i></span>
                    <span class="menu-text">Reports</span>
                </a>
            </li>
        </ul>

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left menu End ========== -->
