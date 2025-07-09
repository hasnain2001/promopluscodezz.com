@extends('admin.layouts.app')
@section('title', 'Admin Dashboard')
@section('styles')
<style>
    .hover-effect:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .hover-effect {
        transition: all 0.3s ease;
    }
    .widget-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .widget-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .hover-scale:hover {
        transform: scale(1.02);
    }

    .avatar-md {
        width: 50px;
        height: 50px;
        display: flex;
    }
</style>
@endsection
@section('content')

    <x-slot name="header">
        <h2 class="">
            {{ _('admin Dashboard') }}
        </h2>
    </x-slot>
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <form class="d-flex align-items-center mb-3">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control border" id="dash-daterange">
                                    <span class="input-group-text bg-blue border-blue text-white">
                                        <i class="mdi mdi-calendar-range"></i>
                                    </span>
                                </div>
                                <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                                    <i class="mdi mdi-autorenew"></i>
                                </a>
                                <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                                    <i class="mdi mdi-filter-variant"></i>
                                </a>
                            </form>
                        </div>
                        <h4 class="page-title"> Admin Dashboard</h4>
                    </div>
                </div>
            </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-circle-outline me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-alert-circle-outline me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

            <div class="row">
                <!-- Total Store Widget -->
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card widget-card hover-scale" style="border-left: 4px solid #7367f0;">
                        <div class="card-body p-1">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-1">
                                    <div class="avatar-md rounded-circle d-flex align-items-center justify-content-center"
                                         style="background-color: rgba(115, 103, 240, 0.1); color: #7367f0;">
                                        <i class="fas fa-store-alt font-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-end">
                                    <h3 class="mb-1 text-dark fw-bold"><span class="counter" data-target="{{$stores}}">0</span></h3>
                                    <p class="text-muted mb-0">Total Stores</p>
                                    <a href="{{route('admin.store.index')}}" class="stretched-link text-decoration-none">
                                        <small class="text-primary">View Details <i class="fas fa-arrow-right ms-1"></i></small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Coupon Widget -->
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card widget-card hover-scale" style="border-left: 4px solid #28c76f;">
                        <div class="card-body p-1">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-1">
                                    <div class="avatar-md rounded-circle d-flex align-items-center justify-content-center"
                                         style="background-color: rgba(40, 199, 111, 0.1); color: #28c76f;">
                                        <i class="fas fa-tag font-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-end">
                                    <h3 class="mb-1 text-dark fw-bold"><span class="counter" data-target="{{$coupons}}">0</span></h3>
                                    <p class="text-muted mb-0">Total Coupons</p>
                                    <a href="{{route('admin.coupon.index')}}" class="stretched-link text-decoration-none">
                                        <small class="text-success">View Details <i class="fas fa-arrow-right ms-1"></i></small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Categories Widget -->
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card widget-card hover-scale" style="border-left: 4px solid #00cfe8;">
                        <div class="card-body p-1">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-1">
                                    <div class="avatar-md rounded-circle d-flex align-items-center justify-content-center"
                                         style="background-color: rgba(0, 207, 232, 0.1); color: #00cfe8;">
                                        <i class="fas fa-layer-group font-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-end">
                                    <h3 class="mb-1 text-dark fw-bold"><span class="counter" data-target="{{$categories}}">0</span></h3>
                                    <p class="text-muted mb-0">Total Categories</p>
                                    <a href="{{route('admin.category.index')}}" class="stretched-link text-decoration-none">
                                        <small class="text-info">View Details <i class="fas fa-arrow-right ms-1"></i></small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Networks Widget -->
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card widget-card hover-scale" style="border-left: 4px solid #ff9f43;">
                        <div class="card-body p-1">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-1">
                                    <div class="avatar-md rounded-circle d-flex align-items-center justify-content-center"
                                         style="background-color: rgba(255, 159, 67, 0.1); color: #ff9f43;">
                                        <i class="fas fa-network-wired font-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-end">
                                    <h3 class="mb-1 text-dark fw-bold"><span class="counter" data-target="{{$networks}}">0</span></h3>
                                    <p class="text-muted mb-0">Total Networks</p>
                                    <a href="{{route('admin.network.index')}}" class="stretched-link text-decoration-none">
                                        <small class="text-warning">View Details <i class="fas fa-arrow-right ms-1"></i></small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total langauge Widget -->
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card widget-card hover-scale" style="border-left: 4px solid #000000;">
                        <div class="card-body p-1">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-1">
                                    <div class="avatar-md rounded-circle d-flex align-items-center justify-content-center"
                                         style="background-color: rgba(0, 0, 0, 0.1); color: #28241f;">
                                        <i class="fas fa-language font-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-end">
                                    <h3 class="mb-1 text-dark fw-bold"><span class="counter" data-target="{{$languge}}">0</span></h3>
                                    <p class="text-muted mb-0">Total langauge</p>
                                    <a href="{{route('admin.language.index')}}" class="stretched-link text-decoration-none">
                                        <small class="text-warning">View Details <i class="fas fa-arrow-right ms-1"></i></small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                      <!-- Total blogs Widget -->
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card widget-card hover-scale" style="border-left: 4px solid #000000;">
                        <div class="card-body p-1">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-1">
                                    <div class="avatar-md rounded-circle d-flex align-items-center justify-content-center"
                                         style="background-color: rgba(0, 0, 0, 0.1); color: #28241f;">
                                        <i class="fas fa-blog font-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-end">
                                    <h3 class="mb-1 text-dark fw-bold"><span class="counter" data-target="{{$blogs}}">0</span></h3>
                                    <p class="text-muted mb-0">Total blogs</p>
                                    <a href="{{route('admin.blog.index')}}" class="stretched-link text-decoration-none">
                                        <small class="text-warning">View Details <i class="fas fa-arrow-right ms-1"></i></small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- end row-->
            <livewire:task-manager />
    <h2 class="text-2xl font-bold mb-4 text-dark">Start a Conversation</h2>
    <div class="list-group">
        @foreach ($user as $user)
            <a href="{{ route('chat', $user->id) }}" class="list-group-item list-group-item-action d-flex align-items-center p-3 mb-2 rounded hover-effect">
                <div class="flex-shrink-0">
                    @if ($user->image)
                        <img src="{{ asset('uploads/user/' . $user->image) }}" alt="{{ $user->name }}" class="rounded-circle me-3" width="50" height="50">
                    @else
                        <img src="{{ asset('assets/images/users/user-5.jpg') }}" alt="{{ $user->name }}" class="rounded-circle me-3" width="50" height="50">
                    @endif
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 me-2">{{ $user->name }}</h5>
                        <span class="badge bg-primary bg-opacity-10 text-primary">{{ $user->role }}</span>
                    </div>
                    <small class="text-muted">Click to start chatting</small>
                </div>
                <div class="flex-shrink-0 text-primary">
                    <i class="bi bi-chevron-right"></i>
                </div>
            </a>
        @endforeach
    </div>



        </div> <!-- container -->

    </div> <!-- content -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div><script>document.write(new Date().getFullYear())</script> © Ubold - <a href="https://coderthemes.com/" target="_blank">Coderthemes.com</a></div>
                </div>
                <div class="col-md-6">
                    <div class="d-none d-md-flex gap-4 align-item-center justify-content-md-end footer-links">
                        <a href="javascript: void(0);">About</a>
                        <a href="javascript: void(0);">Support</a>
                        <a href="javascript: void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

<script>
    // Counter animation
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const increment = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(updateCounter, 1);
            } else {
                counter.innerText = target;
            }

            function updateCounter() {
                const count = +counter.innerText;
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCounter, 1);
                } else {
                    counter.innerText = target;
                }
            }
        });
    });
</script>
@endsection
