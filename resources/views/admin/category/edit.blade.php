@extends('admin.layouts.app')
@section('title', 'Edit Category')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <h2 class="header-title mb-3 text-primary fw-bold">
                    <i class="fa fa-edit me-2"></i> Edit Category
                </h2>
                <p class="text-muted mb-4">
                    Update the category details below.
                </p>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="slug" class="form-label fw-semibold">Category Slug/Url</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ $category->slug }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="meta_keyword" class="form-label fw-semibold">Meta Keyword</label>
                            <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ $category->meta_keyword }}">
                        </div>
                        <div class="col-md-6">
                            <label for="language" class="form-label fw-semibold">Language</label>
                            <select name="language_id" id="language" class="form-select">
                                <option value="">-- Select Language --</option>
                                @foreach($languages as $language)
                                    <option value="{{ $language->id }}" {{ $category->language_id == $language->id ? 'selected' : '' }}>{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="meta_description" class="form-label fw-semibold">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" rows="3" style="resize: none;">{{ $category->meta_description }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label fw-semibold">Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept=".jpg, .jpeg, .png, .gif, .webp">
                            @if($category->image)
                                <input type="hidden" name="previous_image" value="{{ $category->image }}">
                                <div class="mt-2">
                                    <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="Current Category Image" class="img-thumbnail" style="max-width: 120px;">
                                </div>
                            @else
                                <p class="text-muted mt-2">No image uploaded</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold d-block">Status</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" id="enable" value="1" class="form-check-input" {{ $category->status == 1 ? 'checked' : '' }}>
                                <label for="enable" class="form-check-label">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" id="disable" value="0" class="form-check-input" {{ $category->status == 0 ? 'checked' : '' }}>
                                <label for="disable" class="form-check-label">Inactive</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="top_category" id="top_category" value="1" {{ $category->top_category ? 'checked' : '' }}>
                                <label class="form-check-label" for="top_category">Featured Category</label>
                            </div>
                            <small class="text-muted">Show this category in featured sections</small>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-2"></i>Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
