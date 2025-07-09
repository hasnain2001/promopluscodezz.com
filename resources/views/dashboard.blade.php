@extends('layouts.welcome')
@section('title', 'User Dashboard')
@push('styles')

@endpush
@section('main')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Enhanced Profile Card -->
                <div class="card shadow-sm border-0 overflow-hidden">
                    <!-- Gradient Header with Improved Visual Hierarchy -->
                    <div class="bg-primary p-4 text-white">
                        <div class="d-flex align-items-center">
                            <!-- Profile Picture with Smooth Transition -->
                            <div class="position-relative me-4">
                                <div class="rounded-circle  border-4 border-white bg-light d-flex align-items-center justify-content-center overflow-hidden" style="width: 96px; height: 96px;">
                                    @if(Auth::user()->image)
                                        <img src="{{ asset('uploads/user/' . Auth::user()->image) }}" alt="{{ Auth::user()->name }}" class="img-fluid h-100 w-100">
                                    @else
                                        <img src="{{ asset('assets/images/users/user-5.jpg') }}" alt="default-image" class="img-fluid rounded-circle">
                                    @endif
                                </div>
                                <a href="{{ route('profile.edit') }}" class="position-absolute bottom-0 end-0 bg-white p-2 rounded-circle shadow-sm text-primary">
                                    <i class="fas fa-pencil-alt fa-sm"></i>
                                </a>
                            </div>

                            <!-- User Info with Better Typography -->
                            <div class="flex-grow-1">
                                <h1 class="h2 mb-1">{{ Auth::user()->name }}</h1>
                                <p class="text-white-50 mb-2">{{ Auth::user()->email }}</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-dark bg-opacity-20 rounded-pill">
                                        Member since {{ Auth::user()->created_at->format('M Y') }}
                                    </span>
                                    @if(Auth::user()->email_verified_at)
                                        <span class="badge bg-white bg-opacity-20 rounded-pill d-flex align-items-center">
                                            <i class="fas fa-check-circle me-1"></i>
                                            Verified
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Content with Refined Layout -->
                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Personal Info Section -->
                            <div class="col-md-6 mb-4 mb-md-0">
                                <h3 class="h5 mb-3 pb-2 border-bottom">Personal Information</h3>
                                <div class="d-flex flex-column gap-3">
                                    <div class="p-3 rounded bg-light">
                                        <small class="text-uppercase text-muted fw-bold">Full Name</small>
                                        <p class="mb-0 fw-medium">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div class="p-3 rounded bg-light">
                                        <small class="text-uppercase text-muted fw-bold">Email Address</small>
                                        <p class="mb-0 fw-medium">{{ Auth::user()->email }}</p>
                                    </div>
                                    <div class="p-3 rounded bg-light">
                                        <small class="text-uppercase text-muted fw-bold">Account Created</small>
                                        <p class="mb-0 fw-medium">{{ Auth::user()->created_at->format('F j, Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Account Actions with Hover Effects -->
                            <div class="col-md-6">
                                <h3 class="h5 mb-3 pb-2 border-bottom">Account Actions</h3>
                                <div class="d-flex flex-column gap-3">
                                    <a href="{{ route('profile.edit') }}" class="d-flex align-items-center p-3 rounded border text-decoration-none hover-shadow">
                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-2 me-3">
                                            <i class="fas fa-cog"></i>
                                        </div>
                                        <div>
                                            <p class="fw-medium mb-0">Update Profile</p>
                                            <small class="text-muted">Change your personal information</small>
                                        </div>
                                    </a>

                                    <a href="{{ route('profile.edit') }}" class="d-flex align-items-center p-3 rounded border text-decoration-none hover-shadow">
                                        <div class="rounded-circle bg-success bg-opacity-10 text-success p-2 me-3">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                        <div>
                                            <p class="fw-medium mb-0">Change Password</p>
                                            <small class="text-muted">Update your account password</small>
                                        </div>
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-100 d-flex align-items-center p-3 rounded border bg-transparent text-decoration-none hover-shadow">
                                            <div class="rounded-circle bg-danger bg-opacity-10 text-danger p-2 me-3">
                                                <i class="fas fa-sign-out-alt"></i>
                                            </div>
                                            <div>
                                                <p class="fw-medium mb-0">Logout</p>
                                                <small class="text-muted">Sign out of your account</small>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
