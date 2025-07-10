@extends('layouts.welcome')
@section('title','Cut2Coupon | Latest Discount Codes of ' . date('Y') . ' | Best Offers and Deals')
@section('description', 'Explore our amazing stores and offers. Find the best products and services in one place.')
@section('keywords', 'stores, offers, products, services')
@section('author', 'john doe')
@section('main')
    <div class="container py-5">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb " class="mb-4">
            <ol class="breadcrumb bg-light rounded px-3 py-2 mb-0 align-items-center">
            <li class="breadcrumb-item">
                <a href="{{ url(app()->getlocale().'/') }}" class="text-decoration-none text-primary fw-semibold">
                <i class="fas fa-home me-1"></i>@lang('nav.home')
                </a>
            </li>
            <li class="breadcrumb-item active d-flex align-items-center" aria-current="page">
                <span class="mx-2 text-muted">
                <i class="fas fa-chevron-right"></i>
                </span>@lang('nav.stores')
            </li>
            </ol>
        </nav>

        <!-- Store Grid -->
        <div class="row g-4">
            @forelse ($stores as $store)
            @php
              $language = $store->language->code;
              $storeSlug = Str::slug($store->slug);

              // Conditionally generate the URL based on the language
              $storeurl = $store->slug
                  ? ($language === 'en'
                      ? route('store.detail', ['slug' => $storeSlug])  // English route without 'lang'
                      : route('store_details.withLang', ['lang' => $language, 'slug' => $storeSlug]))  // Other languages
                  : '#';
            @endphp

                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ $storeurl }}" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm hover-shadow">
                            <div class="ratio ratio-1x1">
                                <img
                                    src="{{ $store->image ? asset('uploads/stores/' . $store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                    onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'"
                                    class="card-img-top object-fit-contain p-2"
                                    alt="{{ $store->name }}"
                                    loading="lazy"
                                >
                            </div>
                            <div class="card-body d-flex flex-column justify-content-end text-center">
                                <h5 class="card-title text-dark fw-semibold small">
                                    {{ $store->name ?: 'Title not found' }}
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <div>@lang('message.No stores found. Please check back later.')</div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
