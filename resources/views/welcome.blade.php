@extends('layouts.welcome')

@section('title', '| Latest Discount Codes of '. date('y') .' | Best Offers and Deals')
@section('description', 'Explore our amazing stores and offers. Find the best products and services in one place.')
@section('keywords', 'coupons, discount codes, best offers, deals')
@section('author', 'john doe')

@push('styles')
 <link rel="stylesheet" href="{{ asset('assets/css/welcome.css') }}">
@endpush
@section('main')
<!-- Hero Slider Section -->
<section class="hero-slider">
    <div class="container px-0 px-md-3">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($sliders as $key => $slider)
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}" aria-current="{{ $key === 0 ? 'true' : '' }}" aria-label="Slide {{ $key + 1 }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner rounded-xl">
                @foreach ($sliders as $key => $slider)
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                    <img src="{{ $slider->image ? asset('uploads/slider/' . $slider->image) : asset('front/assets/images/no-image-found.jpg') }}"
                         class="d-block w-100"
                         alt="{{ $slider->title }}"
                         loading="lazy">
                    <div class="slide-overlay">
                        <span class="fw-bold mb-2">{{ $slider->title }}</span>
                        <p class="mb-0">{{ $slider->description }}</p>
                    </div>
                    <a href="{{ $slider->link }}" target="_blank" class="shop-now-btn"> <span class=" slider-title">{{ $slider->title }}</span></a>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
<hr class="welcome-hr">
<!-- Stores Section -->
<section class="stores-section py-2 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <div class="store-heading">
                <h1>@lang('welcome.H1')</h1>
                <p>@lang('welcome.p1')</p>
            </div>
        </div>

        <div class="position-relative">
            <div class="swiper storesSwiper">
                <div class="swiper-wrapper pb-4">
                    @foreach ($stores as $store)
                    @php
                        $storeUrl = $store->slug ? route('store.detail', ['slug' => Str::slug($store->slug)]) : '#';
                    @endphp

                    <div class="swiper-slide">
                        <div class="card store-card h-100 border-0  overflow-hidden">
                            <div class="store-image-container p-4">
                                <a href="{{ $storeUrl }}" class="text-decoration-none text-dark">
                                    <div class="ratio ratio-1x1">
                                        <img src="{{ $store->image ? asset('uploads/stores/' . $store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                             class="img-fluid rounded-circle object-fit-fill shadow"
                                             alt="{{ $store->name }}"
                                             loading="lazy"
                                             onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                                    </div>
                                </a>
                            </div>
                            <div class="card-body text-center pt-0">
                                <a href="{{ $storeUrl }}" class=" text-decoration-none text-dark">
                                    <small class=" text-nowrap">{{ $store->name }}</small>
                                </a>
                                <p class="card-text text-muted mb-3">{{ Str::limit($store->description, 100) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination position-relative mt-3"></div>
            </div>

            <!-- Custom navigation buttons -->
            <button class="swiper-button-prev text-dark shadow-sm"></button>
            <button class="swiper-button-next text-dark shadow-sm"></button>
        </div>
    </div>
</section>
<hr class="welcome-hr">
<!-- Featured Couponscode Section -->
<section class="couponcode container py-2">
       <div class="text-center mb-5">
            <div class="coupon-heading">
                <h2>@lang('welcome.H2')</h2>
             </div>
        </div>
    <div class="row g-4">
        @foreach ($couponscode as $coupon)
        <div class="col-md-6 col-lg-3">
            <div class="coupon-card position-relative h-100">
                <!-- Ribbon Badges -->
                <div class="ribbon-wrapper">
                    <span class="ribbon verified"><i class="fas fa-check-circle me-1"></i> @lang('welcome.Verified')</span>
                    <span class="ribbon exclusive">@lang('welcome.Exclusive')</span>
                </div>

                <!-- Store image -->
                <div class="store-logo text-center mb-3">
                    <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store->slug)]) }}">
                        <img src="{{ $coupon->store->image ? asset('uploads/stores/' . $coupon->store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                            alt="{{ $coupon->store->name }}"
                            class="img-fluid store-img"
                            loading="lazy"
                            onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                    </a>
                </div>

                <!-- Coupon Info -->
                <div class="coupon-info px-3">
                    <h5 class="coupon-title mb-2">{{ $coupon->name }}</h5>

                    <!-- Expiry Info -->
                    <div class="expiry-badge mb-3">
                        <span class="badge bg-light text-dark">
                            <i class="fas fa-clock me-1 text-warning"></i>
                            @if(\Carbon\Carbon::parse($coupon->ending_date)->isPast())
                                Expired
                            @else
                                Expires: {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d M Y') }}
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Get Code Button -->
                @if ($coupon->code)
                <div class="code-wrapper px-3 mb-3">
                    <button class="btn get-code-btn w-100 position-relative"
                        onclick="handleRevealCode(event, {{ $coupon->id }}, '{{ $coupon->code }}', '{{ $coupon->name }}', '{{ asset('uploads/stores/' . $coupon->store->image) }}', '{{ $coupon->store->destination_url }}', '{{ $coupon->store->name }}')">
                        <span class="btn-text">Get Code</span>

                        <span class="corner-flag"></span>
                    </button>
                </div>
                @else
                <div class="code-wrapper px-3 mb-3">
                    <a href="{{ $coupon->store->destination_url }}" target="_blank" class="btn deal-btn w-100"
                        onclick="updateClickCount({{ $coupon->id }})">
                        Get Deal <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
                @endif

                <!-- Footer Stats -->
                <div class="coupon-footer px-3 pb-2">
                    <div class="d-flex justify-content-between small">
                        <span class="text-muted"><i class="fas fa-users me-1"></i> {{ $coupon->clicks ?? 0 }} used</span>
                        <span class="text-success fw-bold"><i class="fas fa-bolt me-1"></i> Active</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<hr class="welcome-hr">
<!-- category Section -->
<section class="category-section py-2 ">
    <div class="container">
        <div class="text-center mb-5">
            <div class="category-heading">
                    <h3 class="fw-bold text-dark">@lang('welcome.H3')</h3>
               </div>
        </div>

        <div class="position-relative">
            <div class="swiper storesSwiper">
                <div class="swiper-wrapper pb-4">
                    @foreach ($categories as $category)
                    @php
                        $categoryurl = $category->slug ?  route('category.detail', ['slug' => Str::slug($category->slug)]) : '#';
                    @endphp

                    <div class="swiper-slide">
                        <div class="card category-card h-100 border-0  overflow-hidden">
                            <div class="category-image-container p-4">
                                <a href="{{ $categoryurl }}" class="text-decoration-none text-dark">
                                    <div class="ratio ratio-1x1">
                                        <img src="{{ $category->image ? asset('uploads/categories/' . $category->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                             class="img-fluid rounded-circle object-fit-fill"
                                             alt="{{ $category->name }}"
                                             loading="lazy"
                                             onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                                    </div>
                                </a>
                            </div>
                            <div class="card-body text-center pt-0">
                                <a href="{{ $categoryurl }}" class=" text-decoration-none text-dark">
                                    <span class="h6 card-title fw-bold mb-4 text-nowrap">{{ $category->name }}</span>
                                </a>
                                <p class="card-text text-muted mb-3">{{ Str::limit($category->description, 100) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination position-relative mt-3"></div>
            </div>

            <!-- Custom navigation buttons -->
            <button class="swiper-button-prev text-dark shadow-sm"></button>
            <button class="swiper-button-next text-dark shadow-sm"></button>
        </div>
    </div>
</section>
<hr class="welcome-hr">
<!-- Featured Couponscode Section -->
<section class="couponcode container py-2">
           <div class="text-center mb-5">
            <div class="coupon-heading">
                <h4>@lang('welcome.H4')</h4>
             </div>
        </div>
    <div class="row g-4">
        @foreach ($couponsdeal as $coupon)
        <div class="col-md-6 col-lg-3">
            <div class="coupon-card position-relative h-100">
                <!-- Ribbon Badges -->
                <div class="ribbon-wrapper">
                    <span class="ribbon verified"><i class="fas fa-check-circle me-1"></i> @lang('welcome.Verified')</span>
                    <span class="ribbon exclusive">@lang('welcome.Exclusive')</span>
                </div>

                <!-- Store image -->
                <div class="store-logo text-center mb-3">
                    <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store->slug)]) }}">
                        <img src="{{ $coupon->store->image ? asset('uploads/stores/' . $coupon->store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                            alt="{{ $coupon->store->name }}"
                            class="img-fluid store-img"
                            loading="lazy"
                            onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                    </a>
                </div>

                <!-- Coupon Info -->
                <div class="coupon-info px-3">
                    <h5 class="coupon-title mb-2">{{ $coupon->name }}</h5>

                    <!-- Expiry Info -->
                    <div class="expiry-badge mb-3">
                        <span class="badge bg-light text-dark">
                            <i class="fas fa-clock me-1 text-warning"></i>
                            @if(\Carbon\Carbon::parse($coupon->ending_date)->isPast())
                                Expired
                            @else
                                Expires: {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d M Y') }}
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Get Code Button -->
                @if ($coupon->code)
                <div class="code-wrapper px-3 mb-3">
                    <button class="btn get-code-btn w-100 position-relative"
                        onclick="handleRevealCode(event, {{ $coupon->id }}, '{{ $coupon->code }}', '{{ $coupon->name }}', '{{ asset('uploads/stores/' . $coupon->store->image) }}', '{{ $coupon->store->destination_url }}', '{{ $coupon->store->name }}')">
                        <span class="btn-text">Get Code</span>

                        <span class="corner-flag"></span>
                    </button>
                </div>
                @else
                <div class="code-wrapper px-3 mb-3">
                    <a href="{{ $coupon->store->destination_url }}" target="_blank" class="btn deal-btn w-100"
                        onclick="updateClickCount({{ $coupon->id }})">
                        Get Deal <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
                @endif

                <!-- Footer Stats -->
                <div class="coupon-footer px-3 pb-2">
                    <div class="d-flex justify-content-between small">
                        <span class="text-muted"><i class="fas fa-users me-1"></i> {{ $coupon->clicks ?? 0 }} @lang('welcome.used')</span>
                        <span class="text-success fw-bold"><i class="fas fa-bolt me-1"></i> @if ($coupon->status = 1)
                        @lang('welcome.active')
                        @else
                         @lang('welcome.inactive')
                        @endif
                    </span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<hr class="welcome-hr">
<!-- Blog Section -->
<section class="blog-section py-2 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-3 d-inline-flex align-items-center">
                <i class="fas fa-newspaper me-2"></i>@lang('welcome.sp')
            </span>
            <h2 class="fw-bold mb-3">@lang('welcome.H5')</h2>
            <p class="text-muted mb-0">@lang('welcome.blog-p')</p>
        </div>

        <div class="row g-4">
            @foreach ($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="card blog-card h-100 border-0 shadow-sm overflow-hidden transition-all hover-shadow">
                    <div class="card-img-top position-relative overflow-hidden" style="height: 220px;">
                       <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}">
                            <img src="{{ $blog->image ? asset('uploads/blogs/' . $blog->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                 alt="{{ $blog->title }}"
                                 class="img-fluid w-100 h-100 object-cover transition-scale"
                                 loading="lazy"
                                 onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                        </a>
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <span class="badge bg-primary bg-opacity-90 position-absolute top-0 end-0 m-3">{{ $blog->category->name ?? 'General' }}</span>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <small class="text-muted">
                                <i class="far fa-calendar-alt me-2"></i>{{ $blog->created_at->format('M d, Y') }}
                            </small>
                            <small class="text-muted ms-3">
                                <i class="far fa-clock me-2"></i>{{ ceil(str_word_count($blog->description) / 200) }} min read
                            </small>
                        </div>

                        <h5 class="card-title fw-bold mb-3">{{ Str::limit($blog->name, 60) }}</h5>


                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}" class="btn btn-link text-primary p-0 text-decoration-none d-flex align-items-center">
                               @lang('welcome.Read More')<i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <div class="d-flex">
                                <!-- Add social sharing icons if needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('blog', ['lang' => app()->getLocale()]) }}" class="btn btn-primary px-4 py-2 rounded-pill">
                <i class="fas fa-book-open me-2"></i>@lang('welcome.View All Articles')
            </a>
        </div>
    </div>
</section>
 <!-- Coupon Code Modal -->
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow border-0">
                <!-- Modal Header -->
                <div class="modal-header position-relative bg-primary text-white border-0 rounded-top-4">
                    <div class="position-absolute top-0 start-50 translate-middle mt-n4">
                        <span class="badge bg-danger px-3 py-2 shadow-sm">
                            <i class="fas fa-bolt me-1"></i> LIMITED TIME
                        </span>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body text-center py-4 px-5">
                    <!-- Logo -->
                    <div class="mb-4">
                        <img src="" alt="Brand Logo" id="storeImage" class="img-fluid rounded-circle shadow border-4 border-light" style="width: 80px; height: 80px; object-fit: contain;">
                    </div>
                    <!-- Title -->
                    <h5 class="fw-bold text-dark mb-3" id="couponName"></h5>
                    <!-- Coupon Code Section -->
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <p class="small text-muted mb-2">
                            <i class="fas fa-tag me-1"></i> YOUR COUPON CODE
                        </p>
                        <div class="d-flex justify-content-center align-items-center gap-2 mb-3">
                            <span id="couponCode" class="fw-bold fs-4 text-dark"></span>
                            <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard()">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                        <p id="copyMessage" class="small text-success fw-bold mb-0" style="display: none;">
                            <i class="fas fa-check-circle me-1"></i> Copied to clipboard!
                        </p>
                    </div>
                    <!-- Instructions -->
                    <p class="small text-muted mb-0">
                        <i class="fas fa-info-circle me-1"></i> Use this code at checkout on
                        <a href="" id="couponUrl" class="text-decoration-none fw-semibold text-dark"></a>
                    </p>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer bg-light rounded-bottom-4 justify-content-center">
                    <a href="" id="storeLink" target="_blank" class="btn-deal rounded-pill px-4">
                        <i class="fas fa-external-link-alt me-2"></i> Go to Store
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/welcom.js') }}"></script>
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
