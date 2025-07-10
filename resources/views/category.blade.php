@extends('layouts.welcome')

@section('title', 'Cut2Coupon | Latest Discount Codes of ' . date('Y') . ' | Best Offers and Deals')
@section('description', 'Explore our amazing stores and offers. Find the best products and services in one place.')
@section('keywords', 'stores, offers, products, services')
@section('author', 'john doe')

@push('styles')
<style>
    .category-card {
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .category-img-container {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        flex-shrink: 0;
    }

    .category-img {
        width: 50px;
        height: 50px;
        object-fit: contain;
    }

    .category-name {
        font-size: 14px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
    }

    .store-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
        display: flex;
        flex-direction: column;
        height: 100%;
        justify-content: center;
    }

    .store-list li {
        font-size: 13px;
        color: #718096;
        margin-bottom: 4px;
        position: relative;
        padding-left: 12px;
    }

    .store-list li:before {
        content: '•';
        position: absolute;
        left: 0;
        color: #667eea;
    }

    .section-title {
        position: relative;
        margin-bottom: 30px;
        font-weight: 700;
        color: #2d3748;
        font-size: 25px;
        text-align: center;
    }

    .section-title:after {
        content: '';
        position: absolute;
        width: 40%;
        height: 4px;
        bottom: -10px;
        left: 30%;
        background: linear-gradient(to right, #667eea, #764ba2);
        border-radius: 2px;
    }

    .gradient-bg {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .category-content-wrapper {
        display: flex;
        height: 100%;
    }

    .category-details {
        flex: 1;
        padding-left: 15px;
        display: flex;
        flex-direction: column;
    }

    .view-more-link {
        margin-top: auto;
        align-self: flex-end;
        font-size: 12px;
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }

    .view-more-link:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('main')
<div class="main_content gradient-bg py-2">
    <div class="container">
        <!-- Title -->
        <h1 class="section-title">@lang('message.Best Discounts For Every Category')</h1>

        <!-- Categories Grid -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach ($categories as $category)
                <div class="col">
                    <div class="category-card h-100">
                        <div class="card-body p-3">
                            <div class="category-content-wrapper">
                                <!-- Category Image (Left Side) -->
                                <div class="category-img-container">
                                    @if ($category->image)
                                        <img src="{{ asset('uploads/categories/' . $category->image) }}"
                                             class="category-img"
                                             alt="{{ $category->name }}"
                                             loading="lazy">
                                    @else
                                        <i class="fas fa-tag fa-lg text-primary"></i>
                                    @endif
                                </div>

                                <!-- Category Details (Right Side) -->
                                <div class="category-details">
                                    <h2 class="category-name">{{ $category->name }}</h2>
                                    <ul class="store-list">
                                        @forelse ($category->stores as $store)
                                            <li>{{ $store->name }}</li>
                                        @empty
                                            <li>@lang('message.No related stores found.')</li>
                                        @endforelse
                                    </ul>
                                    <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}"
                                       class="view-more-link">
                                      @lang('message. View more') &raquo;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
