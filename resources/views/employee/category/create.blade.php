@extends('employee.layouts.app')
@section('title', 'Create category')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="header-title">Create New Category</h4>
                    <a href="{{ route('employee.category.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Categories
                    </a>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> Fill out the form below to create a new product category.
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2" aria-hidden="true"></i>
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Error!</strong> Please fix the following issues:
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('employee.category.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Basic Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control" required
                                               placeholder="e.g. Electronics, Clothing, etc.">
                                        <div class="invalid-feedback">Please provide a category name.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Category Slug/URL <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ url('/') }}/</span>
                                            <input type="text" name="slug" id="slug" class="form-control" required
                                                   placeholder="e.g. electronics, clothing">
                                        </div>
                                        <small class="text-muted">This will be used in the URL for this category.</small>
                                        <div class="invalid-feedback">Please provide a valid slug.</div>
                                    </div>
                                 <div class="mb-3">
                                    <label for="language" class="form-label">Language</label>
                                    <select name="language_id" id="language" class="form-select" required>
                                        <option value="">-- Select Language --</option>
                                        @foreach($languages as $language)
                                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Select a language for the category</small>
                                </div>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">SEO Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Meta Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title" class="form-control"
                                               placeholder="e.g. Best Electronics category">
                                        <small class="text-muted">This will be used for SEO purposes.</small>
                                        <small class="text-muted">Keep it under 60 characters for best SEO results.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="meta_keyword" class="form-label">Meta Keywords <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword"
                                               placeholder="e.g. buy electronics, best gadgets">
                                        <small class="text-muted">These keywords will help in SEO.</small>
                                        <small class="text-muted">Separate keywords with commas.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control"
                                                  rows="3" placeholder="Brief description of the category"></textarea>
                                        <small class="text-muted">This will be used for SEO purposes.</small>
                                        <small class="text-muted">Keep it under 160 characters for best SEO results.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="enable" checked value="1">
                                            <label class="form-check-label text-success fw-bold" for="enable">
                                                <i class="fas fa-check-circle me-1"></i> Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="disable" value="0">
                                            <label class="form-check-label text-danger" for="disable">
                                                <i class="fas fa-times-circle me-1"></i> Inactive
                                            </label>
                                        </div>
                                    </div>
                                   <div class="col-md-6">
                                            <label class="form-label">Featured category <span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="top_category" id="not_top_category" value="0" checked>
                                                <label class="form-check-label" for="not_top_category">
                                                    Regular
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="top_category" id="top_category" value="1">
                                                <label class="form-check-label text-warning" for="top_category">
                                                    <i class="mdi mdi-star-outline"></i> Featured
                                                </label>
                                            </div>
                                        </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Category Image</label>
                                        <input type="file" name="image" id="image" class="form-control"
                                               accept=".jpg, .jpeg, .png, .gif, .webp">
                                        <small class="text-muted">Recommended size: 800x800px, max 2MB</small>
                                        <div class="mt-2 border p-2 text-center" id="image-preview">
                                            <img src="https://via.placeholder.com/200x200?text=Preview"
                                                 id="image-preview-placeholder"
                                                 class="img-fluid"
                                                 style="max-height: 200px; display: none;">
                                            <span class="text-muted" id="no-image-text">No image selected</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="reset" class="btn btn-light me-2">
                            <i class="fas fa-undo me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Create Category
                        </button>
                    </div>
                </form>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Slug generation from name
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    nameInput.addEventListener('input', function() {
        // Convert to lowercase, replace spaces with single hyphens, remove special chars
        const slug = nameInput.value
            .toLowerCase()
  .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, ' ')
                .replace(/-+/g, ' ');


        slugInput.value = slug;
    });

    // Image preview functionality
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview-placeholder');
    const noImageText = document.getElementById('no-image-text');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                imagePreview.src = event.target.result;
                imagePreview.style.display = 'block';
                noImageText.style.display = 'none';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
            noImageText.style.display = 'block';
        }
    });

    // Form validation
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
});
</script>
@endsection
