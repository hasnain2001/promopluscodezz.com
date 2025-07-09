@extends('employee.layouts.master')
@section('title', 'Store Details')
@section('content')

<main class="container py-5">
    @php
    $codeCount = 0;
    $dealCount = 0;
    foreach ($coupons as $coupon) {
        if ($coupon->code) {
            $codeCount++;
        } else {
            $dealCount++;
        }
    }
    $totalCount = $codeCount + $dealCount;
    @endphp

    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url(app()->getLocale() . '/') }}" class="text-purple">Home</a></li>
            @if($store->category)
                <li class="breadcrumb-item"><a href="{{ route('category.detail', ['slug' => Str::slug($store->category)]) }}" class="text-purple">{{ $store->category->name }}</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ route('stores') }}" class="text-purple">Stores</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $store->slug }}</li>
        </ol>
    </nav>

    <!-- Store Header -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-dark mb-3">{{ $store->name }}</h1>
        <p class="lead text-muted">Save more with the best deals and discounts!</p>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-9">
            @if($coupons->isEmpty())
                <div class="alert alert-warning text-center py-4">
                    <div class="py-3">
                        <i class="bi bi-exclamation-triangle-fill fs-1 text-warning"></i>
                    </div>
                    <h4 class="alert-heading">Oops! No Coupons Available</h4>
                    <p>Don't worry, you can still explore amazing deals from our partnered brands.</p>
                    <hr>
                    <a href="{{ route('stores') }}" class="btn btn-purple btn-lg mt-2">
                        Explore Brands <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($coupons as $coupon)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                                <div class="card-body d-flex flex-column">
                                    <div class="text-center mb-4">
                                        <img src="{{ asset('uploads/stores/' . $store->image) }}" alt="{{ $store->name }}" class="img-fluid" style="max-height: 80px; width: auto;">
                                    </div>

                                    <div class="flex-grow-1">
                                        <div class="border-top pt-3">
                                            <h5 class="card-title fw-semibold">{{ $coupon->name }}</h5>
                                            <hr class="my-3">
                                        </div>

                                        <p class="card-text small {{ strtotime($coupon->ending_date) < strtotime(now()) ? 'text-danger' : 'text-muted' }}">
                                            <i class="bi bi-clock me-1"></i> Ends: {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d-m-Y') }}
                                        </p>

                                        <div class="border-top pt-3">
                                            <p class="small text-muted" id="usedCount{{ $coupon->id }}">
                                                <i class="bi bi-people me-1"></i> Used By: {{ $coupon->clicks }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-auto pt-3">
                                        @if ($coupon->code)
                                            <a href="{{ $coupon->destination_url }}" target="_blank"
                                               class="btn btn-purple w-100"
                                               id="getCode{{ $coupon->id }}"
                                               onclick="handleRevealCode({{ $coupon->id }}, '{{ $coupon->code }}', '{{ $coupon->name }}', '{{ asset('uploads/stores/' . $store->store_image) }}', '{{ $coupon->destination_url }}', '{{ $coupon->store }}')">
                                                <span class="coupon-text">Activate Coupon</span>
                                                <span class="coupon-code d-none" id="couponCode{{ $coupon->id }}">{{ $coupon->code }}</span>
                                            </a>
                                        @else
                                            <a href="{{ $coupon->destination_url }}" target="_blank"
                                               class="btn btn-success w-100"
                                               onclick="updateClickCount('{{ $coupon->id }}')">
                                                View Deal
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($store->content)
                <div class="mt-5 card border-0 shadow-sm">
                    <div class="card-body">
                        {!! $store->content !!}
                    </div>
                </div>
            @else
                <div class="mt-5 text-center text-muted py-4">
                    <i class="bi bi-info-circle me-2"></i> No additional content available
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-body text-center">
                    <img src="{{ asset('uploads/stores/' . $store->image) }}" alt="{{ $store->name }}" class="img-fluid rounded-circle shadow-sm mb-4" style="width: 120px; height: 120px; object-fit: contain; border: 2px solid #e9ecef;">
                    <h3 class="h4 fw-bold">{{ $store->name }}</h3>
                    <div class="d-flex justify-content-center text-warning mb-3">
                        <!-- Star Ratings -->
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star text-muted"></i>
                    </div>

                    <a href="{{ $store->destination_url }}" class="btn btn-purple w-100 mb-4">
                        Visit Store <i class="bi bi-box-arrow-up-right ms-2"></i>
                    </a>

                    <p class="text-muted small mb-4">{{ $store->description }}</p>

                    @if($store->user)
                        <p class="text-muted small mb-4">
                            <i class="bi bi-person-plus me-1"></i> Added by: <span class="fw-semibold">{{ $store->user->name }}</span>
                        </p>
                    @endif

                    <div class="border-top pt-4 mb-4">
                        <h5 class="fw-semibold mb-3">About {{ $store->name }}</h5>
                        <div class="bg-light p-3 rounded">
                            <p class="text-muted small mb-0">{{ $store->about }}</p>
                        </div>
                    </div>

                    <div class="border-top pt-4 mb-4">
                        <h5 class="fw-semibold mb-3">Filter By Voucher Codes</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ url()->current() }}" class="btn btn-sm btn-purple">All</a>
                            <a href="{{ url()->current() }}?sort=codes" class="btn btn-sm btn-purple">Codes</a>
                            <a href="{{ url()->current() }}?sort=deals" class="btn btn-sm btn-purple">Deals</a>
                        </div>
                    </div>

                    <div class="border-top pt-4">
                        <h5 class="fw-semibold mb-3">Summary</h5>
                        <ul class="list-group list-group-flush small">
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-2">
                                <span><i class="bi bi-tag me-2 text-purple"></i>Total Codes</span>
                                <span class="badge bg-dark rounded-pill">{{ $codeCount }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-2">
                                <span><i class="bi bi-percent me-2 text-purple"></i>Total Deals</span>
                                <span class="badge bg-dark rounded-pill">{{ $dealCount }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-2">
                                <span><i class="bi bi-collection me-2 text-purple"></i>Total</span>
                                <span class="badge bg-dark rounded-pill">{{ $totalCount }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>

    <!-- Modal for Coupon Code -->
    <div class="modal fade" id="couponCodeModal" tabindex="-1" aria-labelledby="couponCodeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="couponCodeModalLabel">Coupon Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="modalStoreImage" src="" alt="" class="img-fluid mb-3" style="max-height: 80px; width: auto;">
                        <h5 id="modalCouponName" class="fw-semibold"></h5>
                        <p id="modalCouponCode" class="text-muted"></p>
                        <button type="button" class="btn btn-purple" id="copyCodeButton">Copy Code</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a id="modalDestinationUrl" href="#" target="_blank" class="btn btn-primary">Go to Store</a>

</main>
@endsection

@section('styles')
<style>
    .btn-purple {
        background-color: #6f42c1;
        color: white;
    }
    .btn-purple:hover {
        background-color: #5e32b0;
        color: white;
    }
    .breadcrumb-item a {
        color: #6f42c1;
    }
    .card.hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
</style>
@endsection
