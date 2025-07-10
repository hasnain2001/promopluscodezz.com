@extends('layouts.welcome')
@section('title')
    Hot Deals - Limited-time offers & exclusive discounts
@endsection
@section('description')
    Discover today's hottest deals and limited-time offers from your favorite stores. Save big with our exclusive discounts!
@endsection
@section('keywords')
    hot deals, limited-time offers, flash sales, exclusive discounts, online shopping deals
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/deal.css') }}">
@endpush

@section('main')
<main class="container">
    <!-- Page Header -->
    <div class="deals-header">
        <div class="container">
            <h1>🔥 FLASH DEALS ALERT!</h1>
            <p class="lead">Limited-time offers you won't want to miss - act fast before they're gone!</p>
        </div>
    </div>

    {{-- <!-- Category Filters -->
    <div class="deal-categories text-center">
        <h5 class="mb-3">Shop by Category:</h5>
        <div>
            <span class="category-badge active">All Deals</span>
            <span class="category-badge">Fashion</span>
            <span class="category-badge">Electronics</span>
            <span class="category-badge">Home & Garden</span>
            <span class="category-badge">Travel</span>
            <span class="category-badge">Food & Drink</span>
        </div>
    </div> --}}

    <!-- Deal List -->
    <div class="row">
        @foreach ($coupons as $coupon)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="deal-card h-100">
                @if($coupon->authentication == 'feature')
                <div class="deal-badge">@lang('message.HOT DEAL')</div>
                @endif

                <div class="deal-image-container">
                    @if ($coupon->store->image)
                   <img src="{{ asset('uploads/stores/' . $coupon->store->image) }}" class="deal-image" alt="{{ $coupon->store->name }}" loading="lazy">

                    @else
                    <img src="{{ asset('uploads/deals/' . $coupon->image) }}" class="deal-image" alt="{{ $coupon->name }}" loading="lazy">
                    @endif
                </div>

                <div class="deal-content">
                    <h3 class="deal-title">{{ $coupon->name }}</h3>
                    <p class="deal-description">{{ $coupon->description }}</p>

                    <div class="deal-meta">
                        <div class="deal-expiry">
                            <i class="far fa-clock"></i> @lang('message.Expires') {{ \Carbon\Carbon::parse($coupon->ending_date)->format('M d') }}
                        </div>
                        <div class="deal-usage">
                            <i class="fas fa-users"></i> {{ $coupon->clicks }}
                        </div>
                    </div>

                    <a href="{{ $coupon->store->destination_url }}" target="_blank" class="view-deal-btn" onclick="updateClickCount({{ $coupon->id }})">
                       @lang('welcome.View Deal')
                    </a>

                    <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store->slug)]) }}" class="more-offers-btn">
                      @lang('welcome.More Offers')
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $coupons->links('vendor.pagination.custom') }}
    </div>
</main>
@endsection

@push('scripts')
<script>
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
                const usedCountElement = document.querySelector(`.deal-card[data-id="${couponId}"] .deal-usage`);
                if (usedCountElement) {
                    usedCountElement.innerHTML = `<i class="fas fa-users me-1"></i> ${data.clicks}`;
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Category filter functionality
    document.querySelectorAll('.category-badge').forEach(badge => {
        badge.addEventListener('click', function() {
            document.querySelector('.category-badge.active').classList.remove('active');
            this.classList.add('active');
            // Here you would typically filter deals by category
            // For now we'll just simulate it
            console.log('Filtering by:', this.textContent);
        });
    });
</script>
@endpush
