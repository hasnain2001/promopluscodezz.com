<!-- ========== Menu ========== -->
<div class="app-menu text-ellipsis text-capitalize w-3" >
    <!-- Brand Logo -->
    <div class="logo-box text-center py-3">
        <!-- Light Logo -->
        <a href="{{ route('admin.dashboard') }}" class="logo-light">
            <x-application-logo class="logo-lg" style="height: 40px;" />
            {{-- <span class="logo-text">Admin Dashboard</span> --}}
        </a>

        <!-- Dark Logo -->
        <a href="{{ route('admin.dashboard') }}" class="logo-dark">
           <x-application-logo class="logo-lg" style="height: 40px;" />
           {{-- <span class="logo-text">Admin Dashboard</span> --}}
        </a>
    </div>

    <!-- Menu Content -->
    <div class="scrollbar">
        <ul class="menu">
            <!-- Dashboard Section -->
            <li class="menu-title">Navigation</li>
            <li class="menu-item">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-tachometer-alt"></i></span>
                    <span class="menu-text"> admin Dashboard</span>
                    <span class="menu-badge"><span class="badge bg-success rounded-pill">New</span></span>
                </a>
            </li>

            <!-- AMS Section -->
            <li class="menu-title">AMS Management</li>

            <!-- Users -->
            <li class="menu-item">
                <a href="#user" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-users"></i></span>
                    <span class="menu-text">User Management</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="user">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('admin.user.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-list"></i></span>
                                <span class="menu-text">All Users</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.user.create') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-user-plus"></i></span>
                                <span class="menu-text">Add New User</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

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
                            <a href="{{ route('admin.category.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-list-ol"></i></span>
                                <span class="menu-text">All Categories</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.category.create') }}" class="menu-link">
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
                            <a href="{{ route('admin.store.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-th-list"></i></span>
                                <span class="menu-text">All Stores</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.store.create') }}" class="menu-link">
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
                            <a href="{{ route('admin.network.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-project-diagram"></i></span>
                                <span class="menu-text">All Networks</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.network.create') }}" class="menu-link">
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
                            <a href="{{ route('admin.coupon.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-list-ul"></i></span>
                                <span class="menu-text">All Coupons</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.coupon.create') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-ticket"></i></span>
                                <span class="menu-text">Add New Coupon</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

             <!-- blogs -->
             <li class="menu-item">
                <a href="#blog" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-blog"></i></span>
                    <span class="menu-text">blogs</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="blog">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('admin.blog.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-list-ul"></i></span>
                                <span class="menu-text">All blogs</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.blog.create') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-ticket"></i></span>
                                <span class="menu-text">Add New blog</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- language -->
            <li class="menu-item">
                <a href="#language" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-language"></i></span>
                    <span class="menu-text">Languages</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="language">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('admin.language.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-list-ul"></i></span>
                                <span class="menu-text">All Languages</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.language.create') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-plus"></i></span>
                                <span class="menu-text">Add New Language</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
               <!-- Delete Request -->
             <li class="menu-item">
                <a href="#deletestore" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-trash"></i></span>
                    <span class="menu-text">Delete Request</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="deletestore">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('admin.delete.requests') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-list-ul"></i></span>
                                <span class="menu-text">Delete store request</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <!-- Slider -->
            <li class="menu-item">
                <a href="#slider" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-images"></i></span>
                    <span class="menu-text">Slider</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="slider">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('admin.slider.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-list-ul"></i></span>
                                <span class="menu-text">All Sliders</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.slider.create') }}" class="menu-link">
                                <span class="menu-icon"><i class="fas fa-plus"></i></span>
                                <span class="menu-text">Add New Slider</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

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
