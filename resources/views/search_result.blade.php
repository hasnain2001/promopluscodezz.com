@extends('layouts.welcome')
@section('title','search | Latest Discount Codes of ' . date('Y') . ' | Best Offers and Deals')
@section('description', 'Explore our amazing stores and offers. Find the best products and services in one place.')
@section('keywords', 'stores, offers, products, services')
@section('author', 'john doe')
@section('main')

<div class="container animate-fade-in">
    <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px; padding: 12px;">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/" class="text-decoration-none text-primary">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Search Results</li>
        </ol>
    </nav>

    <h3 class="mt-4 mb-3 text-primary" style="font-weight: 700; letter-spacing: -0.5px;">
        Search Results
        <small class="text-muted fs-5">({{ $stores->total() }} results)</small>
    </h3>

    <div class="row g-4">
        @if ($stores->isEmpty())
            <div class="col-12 text-center py-5">
                <img src="{{ asset('assets/images/no-image-found.png') }}"
                     alt="No results"
                     style="max-width: 200px; opacity: 0.6;">
                <h4 class="mt-3 text-muted">No stores found</h4>
                <p class="text-secondary">Try adjusting your search criteria and try again</p>
            </div>
        @else
            @foreach ($stores as $store)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class=" h-100 ">
                        @php
                            $language = $store->language ? $store->language->code : 'en';
                            $storeSlug = Str::slug($store->slug);
                            $storeurl = $store->slug
                                ? ($language === 'en'
                                    ? route('store.detail', ['slug' => $storeSlug])
                                    : route('store_details.withLang', ['lang' => $language, 'slug' => $storeSlug]))
                                : '#';
                        @endphp
                        <a href="{{ $storeurl }}" class="text-decoration-none">
                            <div class="card-body text-center p-2">
                                <div class="d-flex justify-content-center mb-3">
                                    <img src="{{ $store->image ?
                                                asset('uploads/stores/' . $store->image) :
                                                asset('front/assets/images/no-image-found.jpg') }}"
                                         class="rounded-circle shadow"
                                         style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #fff;">
                                </div>
                                <h5 class="card-title mb-0 text-dark">{{ $store->name }}</h5>
                                @if($store->offers_count > 0)
                                    <span class="badge bg-primary mt-2">
                                        {{ $store->offers_count }} {{ Str::plural('offer', $store->offers_count) }}
                                    </span>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $stores->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add copy protection with nicer alerts
    document.addEventListener('copy', function(e) {
        e.preventDefault();
        Swal.fire({
            icon: 'info',
            title: 'Copying Disabled',
            text: 'Copying content is not allowed on this page',
            confirmButtonText: 'Okay'
        });
    });

    document.addEventListener('contextmenu', function(e) {
        if (e.target.tagName === 'IMG') {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Right-click Disabled',
                text: 'Saving images is not permitted',
                confirmButtonText: 'Understood'
            });
        }
    });
</script>
@endpush
