@extends('layouts.welcome')

@section('title', 'Blog')
@section('description', 'Explore our amazing blogs and offers. Find the best products and services in one place.')
@section('keywords', 'blogs, offers, products, services')
@section('author', 'John Doe')

@section('main')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-dark mb-3">@lang('message.Our Blog')</h1>
        <p class="lead text-muted">@lang('message.Discover the latest insights, tips, and news.')</p>
    </div>

    <div class="row g-4">
        @foreach ($blogs as $blog)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm overflow-hidden rounded-3 hover-zoom">

                    @php
    $language = $blog->language ? $blog->language->code : 'en'; // Default to 'en' if no language is set
    $slug = Str::slug($blog->slug);

    // Generate the URL based on whether the language is 'en' or not
    if ($language === 'en') {
        $blogurl = route('blog.detail', ['slug' => $slug]);
    } else {
        $blogurl = route('blog-details.withLang', ['lang' => $language, 'slug' => $slug]);
    }
@endphp
                <a href="{{ $blogurl}}" class="text-decoration-none text-dark">
                    <div class="position-relative">
                        <img
                            src="{{ $blog->image ? asset('uploads/blogs/' . $blog->image) : asset('front/assets/images/no-image-found.jpg') }}"
                            alt="{{ $blog->name }}"
                            class="card-img-top object-fit-fill"
                            loading="lazy"
                            style="height: 200px; width: 100%;"
                        >
                        <div class="position-absolute bottom-0 start-0 p-3">
                            <span class="badge bg-primary bg-opacity-75 text-white">
                                {{ $blog->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">{{ $blog->name }}</h5>
                        <p class="card-text text-muted mb-4">
                            {{ Str::limit(strip_tags($blog->description), 100, '...') }}
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($blog->user->name ?? 'Unknown') }}&background=random"
                                    alt="Author"
                                    class="rounded-circle"
                                    width="30"
                                >
                            </div>
                            <small class="text-secondary">{{ $blog->user->name ?? 'Unknown' }}</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination (if needed) -->
    @if ($blogs->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $blogs->links('vendor.pagination.custom') }}
    </div>
    @endif
</div>
@endsection
