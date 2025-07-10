@extends('layouts.welcome')
@section('title')
    Coupon Codes - Find the latest coupon codes and deals for your favorite stores
@endsection
@section('description')
    Find the latest coupon codes and deals for your favorite stores. Save money on your online shopping with our exclusive discount codes.
@endsection
@section('keywords')
    coupon codes, discount codes, promo codes, deals, offers, vouchers, discounts, savings, online shopping
@endsection
@push('styles')
<style>
    :root {
        --primary-color: #6f42c1;
        --primary-hover: #5a32a8;
        --secondary-color: #e63946;
        --secondary-hover: #d62839;
        --accent-color: #f3e6ff;
        --text-dark: #2d3748;
        --text-light: #718096;
    }

    .coupon-card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .coupon-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    .coupon-authentication {
        font-size: 18px;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 5px;
    }

    .coupon-name {
        font-size: 22px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .coupon-description {
        font-size: 15px;
        color: var(--text-light);
        margin-bottom: 15px;
    }

    .ending-date {
        font-size: 14px;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ending-date i {
        font-size: 16px;
    }

    .store-logo {
        max-width: 120px;
        max-height: 60px;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .store-logo:hover {
        transform: scale(1.05);
    }

    .usage-count {
        font-size: 14px;
        color: #38a169;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .see-all-link {
        color: var(--primary-color);
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .see-all-link:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    /* Button Styles */
    .get-code-btn {
        padding: 12px 24px;
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--secondary-hover) 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-transform: uppercase;
        display: inline-block;
        text-align: center;
        width: 100%;
        margin-bottom: 10px;
    }

    .get-code-btn:hover {
        color: white;
        background: linear-gradient(135deg, var(--secondary-hover) 0%, var(--secondary-color) 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .deal-btn {
        padding: 12px 24px;
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-transform: uppercase;
        display: inline-block;
        text-align: center;
        width: 100%;
        margin-bottom: 10px;
    }

    .deal-btn:hover {
        background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        color: white;
    }

    .store-btn {
        padding: 10px 20px;
        background-color: white;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        text-align: center;
        text-decoration: none;
    }

    .store-btn:hover {
        background-color: var(--primary-color);
        color: white;
    }

    /* Header Styles */
    .page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, #8a63d2 100%);
        color: white;
        padding: 30px 0;
        margin-bottom: 30px;
        text-align: center;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .page-header h1 {
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .coupon-card {
            text-align: center;
        }

        .store-logo {
            margin-bottom: 15px;
        }

        .coupon-name {
            font-size: 1.2rem;
        }

        .get-code-btn, .deal-btn {
            padding: 10px 15px;
            font-size: 14px;
        }

        .page-header h1 {
            font-size: 2rem;
        }
    }

    /* Modal Styles */
    .coupon-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
        border: none;
    }

    .coupon-modal .modal-header {
        background-color: var(--primary-color);
        color: white;
        border-bottom: none;
    }

    .coupon-modal .modal-body {
        padding: 30px;
        text-align: center;
    }

    .coupon-modal .store-logo-modal {
        max-width: 150px;
        margin: 0 auto 20px;
    }

    .coupon-modal .coupon-code-display {
        background-color: var(--accent-color);
        padding: 15px;
        border-radius: 8px;
        font-size: 24px;
        font-weight: 700;
        color: var(--primary-color);
        margin: 20px 0;
        letter-spacing: 2px;
    }

    .coupon-modal .btn-close {
        filter: invert(1);
    }

    .coupon-modal .btn-copy {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .coupon-modal .btn-copy:hover {
        background-color: var(--primary-hover);
    }
</style>
@endpush
@section('main')
<main class="container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>@lang('message.Exclusive Coupon Codes')</h1>
            <p class="lead">@lang('message.Save money with our verified discount codes for your favorite online stores')</p>
        </div>
    </div>

    <!-- Coupon List -->
    <div class="row">
        @foreach ($coupons as $coupon)
        <div class="col-lg-6 mb-4">
            <div class="coupon-card card h-100 d-flex flex-column">  <!-- Added d-flex flex-column -->
                <div class="card-body flex-grow-1">  <!-- Added flex-grow-1 -->
                    <div class="row h-100">  <!-- Added h-100 -->
                        <div class="col-md-3 text-center mb-3 mb-md-0">
                            @if ($coupon->store->image)
                            <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store)]) }}">
                                <img src="{{ asset('uploads/stores/' . $coupon->store->image) }}" class="store-logo img-fluid" alt="{{ $coupon->store->name }} Logo" loading="lazy">
                            </a>
                            @else
                            <span class="text-muted">@lang('message.No logo available')</span>
                            @endif
                        </div>

                        <div class="col-md-6 d-flex flex-column">  <!-- Added d-flex flex-column -->
                            @if ($coupon->authentication && $coupon->authentication !== 'No Auth')
                            <div class="coupon-authentication">
                                <i class="fas fa-check-circle"></i> {{ $coupon->authentication }}
                            </div>
                            @endif

                            <h3 class="coupon-name">{{ $coupon->name }}</h3>
                            <p class="coupon-description">{{ $coupon->description }}</p>

                            <div class="mt-auto">  <!-- Pushes the following content to bottom -->
                                <div class="d-flex flex-wrap gap-3 align-items-center">
                                    <div class="ending-date">
                                        <i class="far fa-clock"></i> @lang('message.Expires') {{ \Carbon\Carbon::parse($coupon->ending_date)->format('M d, Y') }}
                                    </div>
                                    <div class="usage-count">
                                        <i class="fas fa-users"></i> @lang('welcome.used') {{ $coupon->clicks }} times
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mt-md-auto mt-3 d-flex flex-column text-nowrap">  <!-- Added d-flex flex-column -->
                            @if ($coupon->code)
                            <button class="get-code-btn text-nowrap" onclick="handleRevealCode(event, {{ $coupon->id }}, '{{ $coupon->code }}', '{{ $coupon->name }}', '{{ asset('uploads/stores/' . $coupon->store->image) }}', '{{ $coupon->store->destination_url }}', '{{ $coupon->store->name }}')">@lang('welcome.Get Code')
                            </button>
                            @else
                            <a href="{{ $coupon->store->destination_url }}" target="_blank" class="deal-btn"  onclick="updateClickCount({{ $coupon->id }})">
                               @lang('welcome.View Deal')
                            </a>
                            @endif
                            <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store->slug)]) }}" class="store-btn mt-auto">  <!-- Added mt-auto -->
                                @lang('welcome.More Offers')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $coupons->links('vendor.pagination.custom') }}
    </div>
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

</main>
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
