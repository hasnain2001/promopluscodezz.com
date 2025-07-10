@extends('layouts.welcome')
@section('title', $blog->name . ' | ' . config('app.name'))
@section('description', 'Explore our latest blog post: ' . $blog->name . '. ' . $blog->description)
@section('keywords', $blog->keywords)
@section('author', $blog->author ?? 'Unknown')

@section('main')
<div class="bg-light min-vh-100 py-0">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white p-3 rounded shadow-sm">
                <li class="breadcrumb-item">
                    <a href="/" class="text-primary text-decoration-none fw-semibold">
                        <i class="fas fa-home me-1"></i>@lang('nav.home')
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('category.detail', ['slug' => Str::slug($blog->category->slug) ]) }}" class="text-primary text-decoration-none fw-semibold">
                        <i class="fas fa-list me-1"></i> {{ $blog->category->name ?? 'Uncategorized' }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                       {{ $blog->name }}
                </li>
            </ol>
        </nav>
        <!-- Blog Detail -->
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card shadow-lg border-0 mb-4">
                    <div class="position-relative ratio ratio-16x9">
                        <img src="{{ $blog->image ? asset('uploads/blogs/' . $blog->image) : asset('front/assets/images/no-image-found.jpg') }}"
                             alt="{{ $blog->name }}"
                             class="card-img-top object-fit-cover rounded-top"
                             loading="lazy"
                             style="filter: brightness(0.95);">
                        <span class="position-absolute top-0 end-0 m-3 badge bg-gradient-primary text-white shadow">
                            {{ $blog->category->name ?? 'Uncategorized' }}
                        </span>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title text-dark fw-bold mb-3 display-5">
                            {{ $blog->name }}
                        </h1>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary small px-3 py-2 rounded-pill">
                                <i class="far fa-calendar-alt me-1"></i>{{ $blog->created_at->format('M d, Y') }}
                            </span>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary small px-3 py-2 rounded-pill">
                                <i class="fas fa-user me-1"></i>{{ $blog->user->name ?? 'Unknown' }}
                            </span>
                        </div>
                        <p class="card-text text-muted mb-4 fs-5" style="line-height:1.7;">
                            {!! $blog->content !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title text-dark fw-semibold mb-0">
                            <i class="fas fa-store me-2 text-primary"></i>@lang('message.Related Stores')
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @forelse ($relatedstores as $store)
                                <li class="list-group-item px-0 py-3 border-0">
                                    <a href="{{ route('store.detail', ['slug' => Str::slug($store->slug)]) }}"
                                       class="d-flex align-items-center text-decoration-none hover-bg-light rounded-2 p-2 transition shadow-sm"
                                       style="transition: box-shadow 0.2s;">
                                        <img src="{{ $store->image ? asset('uploads/stores/' . $store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                             alt="{{ $store->name }}"
                                             class="rounded me-3 object-fit-fill border"
                                             style="width: 60px; height: 60px; object-fit: cover; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                                        <div>
                                            <div class="fw-semibold text-dark mb-1">{{ Str::limit($store->name, 40) }}</div>
                                            <small class="text-muted">
                                                <i class="far fa-calendar-alt me-1"></i>
                                                {{ $store->created_at->format('M d, Y') }}
                                            </small>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item text-muted text-center border-0">
                                   @lang('message.No related stores found.')
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title text-dark fw-semibold mb-0">
                            <i class="fas fa-blog me-2 text-primary"></i>@lang('message.related blogs')
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @forelse ($relatedBlogs as $relatedBlog)
                                <li class="list-group-item px-0 py-3 border-0">
                                    <a href="{{ route('blog.detail', ['slug' => Str::slug($relatedBlog->slug)]) }}"
                                       class="d-flex align-items-center text-decoration-none hover-bg-light rounded-2 p-2 transition shadow-sm"
                                       style="transition: box-shadow 0.2s;">
                                        <img src="{{ $relatedBlog->image ? asset('uploads/blogs/' . $relatedBlog->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                             alt="{{ $relatedBlog->name }}"
                                             class="rounded me-3 object-fit-fill border"
                                             style="width: 60px; height: 60px; object-fit: cover; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                                        <div>
                                            <div class="fw-semibold text-dark mb-1">{{ Str::limit($relatedBlog->name, 40) }}</div>
                                            <small class="text-muted">
                                                <i class="far fa-calendar-alt me-1"></i>
                                                {{ $relatedBlog->created_at->format('M d, Y') }}
                                            </small>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item text-muted text-center border-0">
                                @lang('message.No related blogs found.')
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
