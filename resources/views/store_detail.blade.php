@extends('layouts.welcome')
@section('title') {{ $store->title }} @endsection
@section('description') {{ $store->meta_description }} @endsection
@section('keywords') {{ $store->meta_keyword }} @endsection
@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/store_detail.css') }}">
  <style>
    /* Custom Styles for Enhanced Coupon Modal */
    .bg-gradient-danger {
        background: linear-gradient(135deg, #ff4d4d, #ff1a1a);
    }

    .bg-danger-soft {
        background-color: rgba(255, 77, 77, 0.1);
    }

    .logo-container {
        width: 90px;
        height: 90px;
        padding: 5px;
        background: linear-gradient(135deg, #ff4d4d, #ff1a1a);
        border-radius: 50%;
    }

    .coupon-container {
        border: 2px dashed #ff4d4d;
        position: relative;
        overflow: hidden;
    }

    .coupon-cutout {
        position: absolute;
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 50%;
    }

    .coupon-cutout.top {
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
    }

    .coupon-cutout.bottom {
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
    }

    .coupon-code-text {
        letter-spacing: 2px;
        color: #ff1a1a !important;
    }

    .copy-btn {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .divider-line {
        height: 1px;
        background: linear-gradient(to right, transparent, #ddd, transparent);
        flex: 1;
    }

    .ribbon {
        position: absolute;
        right: -5px;
        top: -5px;
        z-index: 1;
        overflow: hidden;
        width: 150px;
        height: 150px;
        text-align: right;
    }

    .ribbon span {
        font-size: 12px;
        font-weight: bold;
        color: #fff;
        text-transform: uppercase;
        text-align: center;
        line-height: 30px;
        transform: rotate(45deg);
        width: 200px;
        display: block;
        position: absolute;
        top: 35px;
        right: -40px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }

    .store-link-btn {
        position: relative;
        overflow: hidden;
        transition: all 0.3s;
    }

    .store-link-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 77, 77, 0.4);
    }

    .bounce {
        animation: bounce 2s infinite;
    }

    .pulse-animation {
        animation: pulse 2s infinite;
    }

    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: #f00;
        opacity: 0;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
        40% {transform: translateY(-15px);}
        60% {transform: translateY(-7px);}
    }

    @keyframes pulse {
        0% {transform: rotate(45deg) scale(1);}
        50% {transform: rotate(45deg) scale(1.05);}
        100% {transform: rotate(45deg) scale(1);}
    }
    .main{
        padding: 10px;
        margin: 10px;
    }
  </style>
@endpush
@section('main')
 <main class="main">
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
        <!-- Breadcrumb with Icons (Responsive) -->
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb bg-light p-1 rounded-3 shadow-sm flex-nowrap overflow-auto" style="white-space: nowrap;">
            <li class="breadcrumb-item flex-shrink-0">
                <a href="{{ url(app()->getLocale() . '/') }}" class="text-decoration-none text-dark">
                <i class="fas fa-home me-2"></i>@lang('nav.home')
                </a>
            </li>
            @if($store->category)
                <li class="breadcrumb-item flex-shrink-0">
                <a href="{{ route('category.detail', ['slug' => Str::slug($store->category->slug)]) }}" class="text-decoration-none text-dark">
                    <i class="fas fa-tag me-2"></i>{{ $store->category->name }}
                </a>
                </li>
            @endif
            <li class="breadcrumb-item flex-shrink-0">
                <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="text-decoration-none text-dark">
                <i class="fas fa-store me-2"></i>@lang('nav.stores')
                </a>
            </li>
            <li class="breadcrumb-item active flex-shrink-0" aria-current="page">
                <i class="fas fa-chevron-right me-2 text-muted"></i>{{ $store->name }}
            </li>
            </ol>
        </nav>


        <!-- Store Header with Icons -->
        <div class="store-header bg-danger bg-gradient p-2 p-md-5 mb-4 mb-lg-2 text-center text-white rounded-4 position-relative overflow-hidden" >
            <div class="position-absolute top-0 end-0 opacity-10 d-none d-sm-block">
            <i class="fas fa-certificate fa-7x"></i>
            </div>
            <div class="position-absolute bottom-0 start-0 opacity-10 d-none d-sm-block">
            <i class="fas fa-tags fa-6x"></i>
            </div>
            <div class="position-relative h-100 d-flex flex-column justify-content-center align-items-center">
            <div class="store-logo-container mx-auto mb-3 mb-md-4" style="width: 70px; height: 70px;">
                <img src="{{ asset('uploads/stores/' . $store->image) }}" alt="{{ $store->name }}" class="store-logo img-fluid rounded-circle shadow border-4 border-white" style="width: 70px; height: 70px; object-fit:contain;">
            </div>
            <h1 class="h4 h-md display-5 fw-bold mb-2 mb-md-3">
                <i class="fas fa-store-alt me-2"></i>{{ $store->name }}
            </h1>
            <p class="lead mb-2 mb-md-4 fs-6 fs-md-5">
                <i class="fas fa-tag me-2"></i>{{ $store->tagline ?? 'Save more with exclusive deals & coupons!' }}
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-2 gap-md-3">
                <a href="{{ $store->destination_url }}" target="_blank" class="btn btn-light btn-sm btn-lg rounded-pill px-3 px-md-4">
                <i class="fas fa-external-link-alt me-2"></i> @lang('message.Visit Store')
                </a>
                <div class="vr d-none d-md-block"></div>
                <div class="d-flex align-items-center bg-white bg-opacity-25 px-2 px-md-3 rounded-pill">
                <div class="rating me-2">
                    @for ($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star {{ $i <= 4 ? 'text-warning' : 'text-white-50' }}"></i>
                    @endfor
                </div>
                <span class="text-white small small-md">{{ $totalCount }} @lang('message.Offers')</span>
                </div>
            </div>
            </div>
        </div>


        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-9">
                @if($coupons->isEmpty())
                    <div class="alert alert-warning text-center py-5 rounded-4 shadow-sm">
                        <div class="mb-4">
                            <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                        </div>
                        <h4 class="alert-heading fw-bold">@lang('message.Oops! No Coupons Available')</h4>
                        <p class="mb-4">@lang('message.Dont worry, you can still explore amazing deals from our partnered brands.')</p>
                        <a href="{{ route('stores') }}" class="btn btn-danger btn-lg rounded-pill px-4">
                            <i class="fas fa-store me-2"></i>@lang('message.Explore Brands')
                        </a>
                    </div>
                @else
                    <!-- Filter Buttons (Mobile First) -->
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <a href="{{ url()->current() }}" class="btn btn-outline-danger rounded-pill">
                            <i class="fas fa-list me-2"></i>@lang('message.All') ({{ $totalCount }})
                        </a>
                        <a href="{{ url()->current() }}?sort=codes" class="btn btn-outline-danger rounded-pill">
                            <i class="fas fa-ticket-alt me-2"></i>@lang('message.Codes') ({{ $codeCount }})
                        </a>
                        <a href="{{ url()->current() }}?sort=deals" class="btn btn-outline-danger rounded-pill">
                            <i class="fas fa-percentage me-2"></i>@lang('message.Deals') ({{ $dealCount }})
                        </a>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach ($coupons as $coupon)
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                                    <div class="card-body d-flex flex-column p-4">
                                        <!-- Store Logo -->
                                        <div class="text-center mb-3">
                                            <img src="{{ asset('uploads/stores/' . $store->image) }}" alt="{{ $store->name }}" class="img-fluid" style="max-height: 60px; width: auto;">
                                        </div>

                                        <!-- Coupon Content -->
                                        <div class="flex-grow-1">
                                            <!-- Coupon Title -->
                                            <h6 class="card-title fw-bold mb-3">
                                                <i class="fas {{ $coupon->code ? 'fa-ticket-alt text-dark' : 'fa-percentage text-success' }} me-2"></i>
                                                {{ $coupon->name }}
                                            </h6>

                                            <!-- Coupon Description -->
                                            @if($coupon->description)
                                              <hr>
                                                <div class="mb-3">
                                                    <p class="small text-muted mb-1">
                                                        <i class="fas fa-info-circle me-1"></i> @lang('message.Details')
                                                    </p>
                                                    <p class="small">{{ $coupon->description }}</p>
                                                </div>
                                            @endif
                                            <hr>

                                            <!-- Expiry & Usage -->
                                            <div class="d-flex justify-content-between small mb-3">
                                                <span class="{{ strtotime($coupon->ending_date) < strtotime(now()) ? 'text-danger' : 'text-muted' }}">
                                                    <i class="far fa-clock me-1"></i>
                                                    {{ \Carbon\Carbon::parse($coupon->ending_date)->format('M d, Y') }}
                                                </span>
                                                <span class="text-muted" id="usedCount{{ $coupon->id }}">
                                                    <i class="fas fa-users me-1"></i> {{ $coupon->clicks ?? 0 }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Action Button -->
                                        <div class="mt-auto d-grid gap-2">
                                            @if ($coupon->code)
                                                <button class="get-code-btn "
                                                    onclick="handleRevealCode(event, {{ $coupon->id }}, '{{ $coupon->code }}', '{{ $coupon->name }}', '{{ asset('uploads/stores/' . $coupon->store->image) }}', '{{ $coupon->store->destination_url }}', '{{ $coupon->store->name }}')">
                                                    <i class="fas fa-ticket-alt me-2"></i> @lang('welcome.Get Code')
                                                </button>
                                            @else
                                                <a href="{{ $coupon->store->destination_url }}" target="_blank"
                                                   class="deal-btn w-100"
                                                   onclick="updateClickCount({{ $coupon->id }})">
                                                    <i class="fas fa-shopping-bag me-2"></i>@lang('welcome.View Deal')
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Store Content Section -->
                @if ($store->content)
                    <div class="mt-5 bg-white p-3 p-md-4 rounded-4 shadow-sm w-100">
                        <div class="d-flex align-items-center mb-3 mb-md-4 flex-column flex-md-row text-center text-md-start">
                            <i class="fas fa-info-circle fa-2x text-dark me-0 me-md-3 mb-2 mb-md-0"></i>
                            <h3 class="mb-0 fs-5 fs-md-3">@lang('nav.about') {{ $store->name }}</h3>
                        </div>
                        <div class="content-text" style="font-size: 1rem;">
                            {!! $store->content !!}
                        </div>
                    </div>

                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-3 mt-4 mt-lg-0">
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                    <!-- Store Summary -->
                    <div class="card-header bg-danger text-white py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-pie me-2"></i> @lang('message.Store Summary')
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">
                                    <i class="fas fa-ticket-alt text-dark me-2"></i> Coupon @lang('message.Codes')
                                </span>
                                <span class="badge bg-danger rounded-pill">{{ $codeCount }}</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">
                                    <i class="fas fa-percentage text-success me-2"></i> @lang('message.Deals')
                                </span>
                                <span class="badge bg-success rounded-pill">{{ $dealCount }}</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center py-2">
                                <span class="text-muted">
                                    <i class="fas fa-tags text-info me-2"></i> @lang('message.Total Offers')
                                </span>
                                <span class="badge bg-info rounded-pill">{{ $totalCount }}</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Quick Links -->
                    <div class="card-header bg-light py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-link me-2"></i> @lang('nav.Quick Links')
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ $store->destination_url }}" target="_blank" class="btn btn-outline-danger text-start btn-sm">
                                <i class="fas fa-external-link-alt me-2"></i> @lang('message.Visit Store')
                            </a>
                            <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="btn btn-outline-secondary text-start btn-sm">
                                <i class="fas fa-store me-2"></i>  @lang('nav.stores')
                            </a>
                            @if($store->category)
                                <a href="{{ route('category.detail', ['slug' => Str::slug($store->category->slug)]) }}" class="btn btn-outline-secondary text-start btn-sm"><i class="fas fa-tag me-2"></i><small class="text-nowrap">@lang('nav.cateories'): {{ $store->category->name }}</small></a>
                            @endif
                        </div>
                    </div>

                    <!-- Store Details -->
                    <div class="card-header bg-light py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i> @lang('message.Store Details')
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted mb-3">
                            <i class="fas fa-align-left me-2"></i> {{ $store->description }}
                        </p>
                        @if($store->user)
                            <p class="small text-muted mb-0">
                                <i class="fas fa-user-plus me-2"></i> @lang('message.Added by'):{{ $store->user->name }}
                            </p>
                        @endif
                    </div>
                        <!-- Store Details -->
                    <div class="card-header bg-light py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>@lang('message.About Store')
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted mb-3">
                            <i class="fas fa-align-left me-2"></i> {{ $store->about }}
                        </p>
                    </div>
                    <!-- Related Stores -->
                    <div class="card-header bg-light py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-store-alt me-2"></i> @lang('message.Related Stores')
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($relatedStores->isNotEmpty())
                            <ul class="list-unstyled mb-0">
                                @foreach ($relatedStores as $related)
                                    <li class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <img src="{{ asset('uploads/stores/' . $related->image) }}" alt="{{ $related->name }}" class="rounded-circle shadow-sm" style="width: 40px; height: 40px; object-fit: cover;">
                                        </div>
                                        <div>
                                            <a href="{{ route('store.detail', ['slug' => Str::slug($related->slug)]) }}" class="fw-semibold text-dark text-decoration-none">
                                                {{ $related->name }}
                                            </a>
                                            @if($related->tagline)
                                                <div class="small text-muted">{{ $related->tagline }}</div>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="small text-muted mb-0">
                                <i class="fas fa-info-circle me-2"></i> No related stores found.
                            </p>
                        @endif
                    </div>
                     <!-- Related Stores -->
                    <div class="card-header bg-light py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-store-alt me-2"></i> @lang('message.Store Blogs')
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($relatedblogs->isNotEmpty())
                            <ul class="list-unstyled mb-0">
                                @foreach ($relatedblogs as $related)
                                    <li class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <img src="{{ asset('uploads/blogs/' . $related->image) }}" alt="{{ $related->name }}" class="rounded-circle shadow-sm" style="width: 40px; height: 40px; object-fit: cover;">
                                        </div>
                                        <div>
                                            <a href="{{ route('blog.detail', ['slug' => Str::slug($related->slug)]) }}" class="fw-semibold text-dark text-decoration-none">
                                                {{ $related->name }}
                                            </a>
                                            @if($related->tagline)
                                                <div class="small text-muted">{{ $related->tagline }}</div>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="small text-muted mb-0">
                                <i class="fas fa-info-circle me-2"></i> @lang('message.No related stores found.')
                            </p>
                        @endif
                    </div>


                </div>
            </div>
        </div>
 </main>
   <!-- Enhanced Coupon Code Modal -->
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow border-0 overflow-hidden">
                <!-- Ribbon Banner -->
                <div class="ribbon ribbon-top-right">
                    <span class="bg-danger pulse-animation">
                        <i class="fas fa-bolt me-1"></i> LIMITED OFFER
                    </span>
                </div>

                <!-- Modal Header -->
                <div class="modal-header position-relative bg-gradient-danger text-white border-0">
                    <div class="w-100 text-center">
                        <h5 class="modal-title fw-bold" id="couponModalLabel">EXCLUSIVE DISCOUNT</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <!-- Modal Body -->
                <div class="modal-body text-center py-4 px-5">
                    <!-- Animated Logo -->
                    <div class="mb-4">
                        <div class="logo-container mx-auto">
                            <img src="" alt="Brand Logo" id="storeImage" class="img-fluid rounded-circle shadow border-4 border-white bounce">
                        </div>
                    </div>

                    <!-- Title with decorative elements -->
                    <div class="position-relative mb-4">
                        <div class="divider-line"></div>
                        <h5 class="fw-bold text-dark mb-0 px-3 d-inline-block bg-white position-relative" id="couponName"></h5>
                        <div class="divider-line"></div>
                    </div>

                    <!-- Coupon Code Section -->
                    <div class="coupon-container bg-light rounded-3 p-2 mb-4 position-relative">
                        <div class="coupon-cutout top"></div>
                        <div class="coupon-cutout bottom"></div>

                        <p class="small text-muted mb-2">
                            <i class="fas fa-tag me-1"></i> YOUR EXCLUSIVE CODE
                        </p>
                        <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                            <span id="couponCode" class="fw-bold fs-3 text-dark coupon-code-text text-nowrap"></span>
                            <button class="btn btn-sm btn-danger rounded-circle copy-btn" onclick="copyToClipboard()" data-bs-toggle="tooltip" title="Copy Code">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                        <p id="copyMessage" class="small text-success fw-bold mb-0" style="display: none;">
                            <i class="fas fa-check-circle me-1"></i> Copied to clipboard!
                        </p>
                    </div>

                    <!-- Expiry Timer -->
                    <div class="bg-danger-soft rounded-3 p-2 mb-4">
                        <p class="small text-danger mb-1 fw-bold">
                            <i class="fas fa-clock me-1"></i> OFFER EXPIRES IN:
                            <span class="countdown-timer">15:00</span>
                        </p>
                    </div>

                    <!-- Instructions -->
                    <p class="small text-muted mb-0">
                        <i class="fas fa-info-circle me-1"></i> Apply this code at checkout on
                        <a href="" id="couponUrl" class="text-decoration-none fw-semibold text-dark"></a>
                    </p>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-light rounded-bottom-4 justify-content-center border-0 pt-0">
                    <a href="" id="storeLink" class="btn btn-danger btn-lg rounded-pill px-4 shadow-sm store-link-btn">
                        <i class="fas fa-external-link-alt me-2"></i> REDEEM NOW
                    </a>
                </div>

                <!-- Confetti decoration -->
                <div class="confetti"></div>
                <div class="confetti"></div>
                <div class="confetti"></div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script>
        let couponModal = null;

        document.addEventListener('DOMContentLoaded', function() {
            couponModal = new bootstrap.Modal(document.getElementById('couponModal'));
        });

        function handleRevealCode(event, couponId, couponCode, couponName, storeImage, destinationUrl, storeName) {
            event.preventDefault();

            // Update modal content
            document.getElementById('couponCode').textContent = couponCode;
            document.getElementById('couponName').textContent = couponName;
            document.getElementById('storeImage').src = storeImage;
            document.getElementById('couponUrl').href = destinationUrl;
            document.getElementById('couponUrl').textContent = storeName;
            document.getElementById('storeLink').href = destinationUrl;

            // Update click count
            updateClickCount(couponId);

            // Show modal
            if (couponModal) {
                couponModal.show();
                // Redirect to destination_url after showing modal
                setTimeout(function() {
                    window.open(destinationUrl, '_blank');
                }, 500); // Adjust delay as needed
            } else {
                window.open(destinationUrl, '_blank');
            }
        }

        function updateClickCount(couponId) {
            fetch('{{ route("update.clicks") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ coupon_id: couponId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const usedCountElement = document.getElementById('usedCount' + couponId);
                    if (usedCountElement) {
                        usedCountElement.innerHTML = `<i class="fas fa-users me-1"></i> ${data.clicks}`;
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function copyToClipboard() {
            const code = document.getElementById('couponCode').textContent;
            navigator.clipboard.writeText(code).then(() => {
                const copyMessage = document.getElementById('copyMessage');
                copyMessage.style.display = 'block';
                setTimeout(() => {
                    copyMessage.style.display = 'none';
                }, 3000);
            });
        }
    </script>
@endpush
