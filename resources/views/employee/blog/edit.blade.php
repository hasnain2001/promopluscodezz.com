@extends('employee.layouts.app')
@section('title', 'Edit blog')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="header-title mb-0"><i class="mdi mdi-pencil-outline me-2"></i>Edit blog</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger border-0 alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Validation Errors:</strong>
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('employee.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="card mb-3 border-primary">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0"><i class="mdi mdi-information-outline me-1"></i> Basic Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">blog Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $blog->name) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="slug" class="form-label">URL Slug <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ url('/') }}/</span>
                                            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', $blog->slug) }}" required>
                                        </div>
                                        <div id="slug-message" class="form-text"></div>
                                    </div>

                                </div>
                            </div>

                            <div class="card border-primary">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0"><i class="mdi mdi-tag-outline me-1"></i> SEO Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Meta Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $blog->title) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_keyword" class="form-label">Meta Keywords <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ old('meta_keyword', $blog->meta_keyword) }}">
                                        <div class="form-text">Separate keywords with commas</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control" rows="2">{{ old('meta_description', $blog->meta_description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="card mb-3 border-primary">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0"><i class="mdi mdi-cog-outline me-1"></i> blog Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="enable" value="1" {{ old('status', $blog->status) == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label text-success" for="enable">
                                                    <i class="mdi mdi-check-circle-outline"></i> Enable
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="disable" value="0" {{ old('status', $blog->status) == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label text-danger" for="disable">
                                                    <i class="mdi mdi-close-circle-outline"></i> Disable
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Featured blog <span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="top_blog" id="not_top_blog" value="0" {{ old('top_blog', $blog->top_blog) == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="not_top_blog">
                                                    Regular
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="top_blog" id="top_blog" value="1" {{ old('top_blog', $blog->top_blog) == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label text-warning" for="top_blog">
                                                    <i class="mdi mdi-star-outline"></i> Featured
                                                </label>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-select" required>
                                            <option value="" disabled>-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" data-language="{{ $category->language_id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="language_id" class="form-label">Language <span class="text-danger">*</span></label>
                                        <select name="language_id" id="language_id" class="form-select" required>
                                            <option value="" disabled>-- Select Language --</option>
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->id }}" {{ old('language_id', $blog->language_id) == $language->id ? 'selected' : '' }}>
                                                    {{ $language->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                            <label for="store_id" class="form-label">store <span class="text-danger">*</span></label>
                                        <select name="store_id" id="store_id" class="form-select" required>
                                            <option value="" disabled>-- Select store --</option>
                                            @foreach ($stores as $store)
                                                <option value="{{ $store->id }}" {{ old('store_id', $blog->store_id) == $store->id ? 'selected' : '' }}>
                                                    {{ $store->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">blog Logo</label>
                                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                        <div class="form-text">Recommended size: 300x300 pixels</div>
                                        @if($blog->image)
                                            <div class="mt-2">
                                                <input type="hidden" name="previous_image" value="{{ $blog->image }}">
                                                <img src="{{ asset('uploads/blogs/' . $blog->image) }}" alt="{{ $blog->name }}" class="img-thumbnail" style="max-width: 200px;">
                                                {{-- <div class="form-check mt-2">
                                                    <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                                    <label class="form-check-label text-danger" for="remove_image">
                                                        Remove current image
                                                    </label>
                                                </div> --}}
                                            </div>
                                        @else
                                            <p class="text-muted mt-2">No image uploaded</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Description -->
                     <!-- Full Width Content Editor -->
                     <div class="card border-primary">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">blog Content</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <textarea id="editor" name="content" >{{ $blog->content }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-3 text-center">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="mdi mdi-content-save"></i> Update blog
                        </button>
                        <a href="{{ route('employee.blog.index') }}" class="btn btn-danger px-4 ms-2">
                            <i class="mdi mdi-close-circle"></i> Cancel
                        </a>
                        <button type="reset" class="btn btn-light px-4 ms-2">
                            <i class="mdi mdi-autorenew"></i> Reset
                        </button>
                    </div>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
@endsection

@section('styles')
<style>
    .card-header.bg-primary {
        color: white;
        border-bottom: none;
    }
    .card-header.bg-light {
        background-color: #f8f9fa !important;
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .card.border-primary {
        border: 1px solid #727cf5 !important;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .form-check-label.text-success {
        color: #0acf97 !important;
    }
    .form-check-label.text-danger {
        color: #fa5c7c !important;
    }
    .form-check-label.text-warning {
        color: #ffbc00 !important;
    }
    .input-group-text {
        background-color: #eef2f7;
    }
    .img-thumbnail {
        padding: 0.25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        max-width: 100%;
        height: auto;
    }
</style>
@endsection

@section('scripts')
    <script>

            document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category_id');
            const languageSelect = document.getElementById('language_id');

            categorySelect.addEventListener('change', function() {
                const selectedOption = categorySelect.options[categorySelect.selectedIndex];
                const languageId = selectedOption.getAttribute('data-language');
                if (languageId) {
                    for (let i = 0; i < languageSelect.options.length; i++) {
                        if (languageSelect.options[i].value == languageId) {
                            languageSelect.selectedIndex = i;
                            break;
                        }
                    }
                }
            });
        });
        // Auto-generate slug and website URL from name while typing
        document.getElementById('name').addEventListener('input', function() {
            const name = this.value.trim();
            const slugField = document.getElementById('slug');
            const urlField = document.getElementById('url');

            if (name) {
                // Generate slug from name
                const generatedSlug = name.toLowerCase()
                    .replace(/[^\w\s-]/g, '')  // Remove special chars
                    .replace(/\s+/g, ' ')      // Replace spaces with -
                    .replace(/--+/g, ' ');     // Replace multiple - with single -

                // Generate website URL (basic version)
                const currentUrl = window.location.origin;
                const generatedUrl = currentUrl + '/blog/' + generatedSlug;

                // Only update slug if the slug field is empty or matches the previously generated slug
                if (!slugField.value || slugField.value === slugField.dataset.previousGenerated) {
                    slugField.value = generatedSlug;
                    slugField.dataset.previousGenerated = generatedSlug;
                    checkSlugUniqueness(generatedSlug);
                }

                // Only update URL if the URL field is empty or matches the previously generated URL
                if (!urlField.value || urlField.value === urlField.dataset.previousGenerated) {
                    urlField.value = generatedUrl;
                    urlField.dataset.previousGenerated = generatedUrl;
                }
            }
        });

        // Check slug when user leaves the name field
        document.getElementById('name').addEventListener('blur', function() {
            const slugField = document.getElementById('slug');
            const urlField = document.getElementById('url');

            if (slugField.value) {
                checkSlugUniqueness(slugField.value);
            }
        });

        // Function to check slug uniqueness
        function checkSlugUniqueness(slug) {
            const slugMessage = document.getElementById('slug-message');
            if (slug.length < 3) {
                slugMessage.textContent = 'Slug is too short';
                slugMessage.style.color = 'red';
            } else {
                slugMessage.textContent = 'Slug looks good!';
                slugMessage.style.color = 'green';
            }
        }

        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#editor'), {
                // Editor configuration
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
