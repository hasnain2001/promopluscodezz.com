@extends('admin.layouts.master')

@section('title', 'Blog Details')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Blog Details</h1>
        <div class="btn-group" role="group">
            <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" class="mx-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">
                    <i class="fas fa-trash me-1"></i> Delete
                </button>
            </form>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-gradient-primary text-white">
            <h3 class="card-title mb-0">{{ $blog->name }}</h3>
            <div class="d-flex justify-content-between align-items-center mt-2">
                <span class="badge bg-light text-dark">
                    <i class="fas fa-user me-1"></i> {{ $blog->user->name }}
                </span>
                <span class="badge bg-light text-dark">
                    <i class="fas fa-calendar me-1"></i>
                    {{ $blog->created_at->setTimezone('Asia/Karachi')->format('M d, Y') }}
                </span>
                @if ($blog->status == '1')
                    <span class="badge bg-success">
                        <i class="fas fa-check-circle me-1"></i> Active
                    </span>
                @else
                    <span class="badge bg-danger">
                        <i class="fas fa-times-circle me-1"></i> Inactive
                    </span>
                @endif
            </div>
        </div>

        <div class="card-body">
            <!-- Featured Image -->
            <div class="text-center mb-4">
                <img class="img-fluid rounded shadow"
                     src="{{ asset('uploads/blogs/' . $blog->image) }}"
                     style="max-height: 400px; width: auto; object-fit: cover;"
                     alt="{{ $blog->name }}">
            </div>

            <!-- Category and Description -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-tag me-2"></i>Category</h5>
                            <p class="card-text">{{ $blog->category->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Blog Content -->
            <div class="mb-4 p-3 border rounded bg-light">
                <h4 class="mb-3 text-center"><i class="fas fa-file-alt me-2"></i>Content</h4>
                <div class="blog-content">
                    {!! $blog->content !!}
                </div>
            </div>

            <!-- SEO Section -->
            <div class="card border-info mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-search me-2"></i>SEO Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><strong>Meta Title:</strong></h6>
                            <p>{{ $blog->title }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Meta Keywords:</strong></h6>
                            <p>{{ $blog->meta_keyword }}</p>
                        </div>
                    </div>
                    <div class="mt-2">
                        <h6><strong>Meta Description:</strong></h6>
                        <p>{{ $blog->meta_description ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="row text-muted small">
                <div class="col-md-6">
                    <p><i class="fas fa-calendar-plus me-1"></i>
                        <strong>Created:</strong>
                        {{ $blog->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}
                    </p>
                </div>
                <div class="col-md-6">
                    <p><i class="fas fa-calendar-check me-1"></i>
                        <strong>Last Updated:</strong>
                        {{ $blog->updated_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-header.bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }
    .blog-content img {
        max-width: 100%;
        height: auto;
        margin: 15px 0;
        border-radius: 5px;
    }
    .blog-content p {
        line-height: 1.8;
        margin-bottom: 1.2rem;
    }
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
    }
</style>
@endsection
