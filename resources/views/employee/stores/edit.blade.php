@extends('employee.layouts.app')
@section('title', 'Edit Store')
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
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="header-title mb-0"><i class="mdi mdi-pencil-outline me-2"></i>Edit Store</h4>
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

                <form action="{{ route('employee.store.update', $stores->id) }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="name" class="form-label">Store Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $stores->name) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="slug" class="form-label">URL Slug <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ url('/') }}/</span>
                                            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', $stores->slug) }}" required>
                                        </div>
                                        <div id="slug-message" class="form-text"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Short Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="2" >{{ $stores->description }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="url" class="form-label">Store Website URL <span class="text-danger">*</span></label>
                                        <input type="url" class="form-control" name="url" id="url" value=" {{$stores->url}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="destination_url" class="form-label">Affiliate Link <span class="text-danger">*</span></label>
                                        <input type="url" class="form-control" name="destination_url" id="destination_url" value="{{ old('destination_url', $stores->destination_url) }}" required>
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
                                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $stores->title) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_keyword" class="form-label">Meta Keywords <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ old('meta_keyword', $stores->meta_keyword) }}">
                                        <div class="form-text">Separate keywords with commas</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control" rows="2">{{ old('meta_description', $stores->meta_description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="card mb-3 border-primary">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0"><i class="mdi mdi-cog-outline me-1"></i> Store Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="enable" value="1" {{ old('status', $stores->status) == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label text-success" for="enable">
                                                    <i class="mdi mdi-check-circle-outline"></i> Enable
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="disable" value="0" {{ old('status', $stores->status) == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label text-danger" for="disable">
                                                    <i class="mdi mdi-close-circle-outline"></i> Disable
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Featured Store <span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="top_store" id="not_top_store" value="0" {{ old('top_store', $stores->top_store) == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="not_top_store">
                                                    Regular
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="top_store" id="top_store" value="1" {{ old('top_store', $stores->top_store) == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label text-warning" for="top_store">
                                                    <i class="mdi mdi-star-outline"></i> Featured
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="mb-3">
                                        <label for="network" class="form-label">Affiliate Network <span class="text-danger">*</span></label>
                                        <select name="network_id" id="network" class="form-select" required>
                                            <option value="" disabled {{ !$stores->network_id ? 'selected' : '' }}>-- Select Network --</option>
                                            @foreach ($networks as $network)
                                                <option value="{{ $network->id }}" {{ $stores->network_id == $network->id ? 'selected' : '' }}>
                                                    {{ $network->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-select" required>
                                            <option value="" disabled>-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $stores->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="language" class="form-label">Language <span class="text-danger">*</span></label>
                                        <select name="language_id" id="language" class="form-select">
                                            <option value="" disabled>-- Select Language --</option>
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->id }}"
                                                    {{ $stores->language_id == $language->id ? 'selected' : '' }}>
                                                    {{ $language->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Select the language for this store. This will help in categorizing and displaying the store correctly based on user preferences.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="about" class="form-label">About Store</label>
                                        <textarea name="about" id="about" class="form-control" rows="3">{{ old('about', $stores->about) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Store Logo</label>
                                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                        <div class="form-text">Recommended size: 300x300 pixels</div>
                                        @if($stores->image)
                                            <div class="mt-2">
                                                <input type="hidden" name="previous_image" value="{{ $stores->image }}">
                                                <img src="{{ asset('uploads/stores/' . $stores->image) }}" alt="Current Store Image" class="img-thumbnail" style="max-width: 200px;">
                                                <div class="form-check mt-2">
                                                    <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                                    <label class="form-check-label text-danger" for="remove_image">
                                                        Remove current image
                                                    </label>
                                                </div>
                                            </div>
                                        @else
                                            <p class="text-muted mt-2">No image uploaded</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- Full Width Content Editor -->
                    <div class="card border-primary">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">Store Content</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <textarea id="editor" name="content" >{!! $stores->content !!}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-3 text-center">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="mdi mdi-content-save"></i> Update Store
                        </button>
                        <a href="{{ route('employee.store.index') }}" class="btn btn-danger px-4 ms-2">
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
@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Auto-generate slug from name while typing
        document.getElementById('name').addEventListener('input', function() {
            const name = this.value.trim();
            const slugField = document.getElementById('slug');

            if (name && (!slugField.value || slugField.value === slugField.dataset.previousGenerated)) {
                const generatedSlug = name.toLowerCase()
                    .replace(/[^\w\s-]/g, '')  // Remove special chars
                    .replace(/\s+/g, '-')        // Replace spaces with -
                    .replace(/-+/g, '-');        // Replace multiple - with single -

                slugField.value = generatedSlug;
                slugField.dataset.previousGenerated = generatedSlug;
                checkSlugUniqueness(generatedSlug);
            }
        });

        // Check slug uniqueness when slug field changes
        document.getElementById('slug').addEventListener('input', function() {
            checkSlugUniqueness(this.value);
        });

        // Function to check slug uniqueness via AJAX
        function checkSlugUniqueness(slug) {
            const slugMessage = document.getElementById('slug-message');
            const storeId = '{{ $stores->id }}';

            if (slug.length < 3) {
                slugMessage.textContent = 'Slug is too short (min 3 characters)';
                slugMessage.style.color = 'red';
                return;
            }

            fetch(`/employee/store/check-slug?slug=${slug}&id=${storeId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.unique) {
                        slugMessage.textContent = 'Slug is available!';
                        slugMessage.style.color = 'green';
                    } else {
                        slugMessage.textContent = 'Slug is already in use!';
                        slugMessage.style.color = 'red';
                    }
                })
                .catch(error => {
                    slugMessage.textContent = 'Error checking slug availability';
                    slugMessage.style.color = 'red';
                });
        }

        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('image-preview');
                    if (!preview) {
                        const previewDiv = document.createElement('div');
                        previewDiv.id = 'image-preview-container';
                        previewDiv.innerHTML = `
                            <div class="mt-2">
                                <p class="mb-1">New Image Preview:</p>
                                <img id="image-preview" src="${event.target.result}" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        `;
                        e.target.parentNode.appendChild(previewDiv);
                    } else {
                        preview.src = event.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        // Toggle remove image checkbox visibility
        const removeImageCheckbox = document.getElementById('remove_image');
        if (removeImageCheckbox) {
            removeImageCheckbox.addEventListener('change', function() {
                const imagePreview = document.querySelector('img[alt="Current Store Image"]');
                if (this.checked) {
                    imagePreview.style.opacity = '0.5';
                    imagePreview.style.border = '2px solid red';
                } else {
                    imagePreview.style.opacity = '1';
                    imagePreview.style.border = '1px solid #dee2e6';
                }
            });
        }

        // Auto-generate meta fields if empty
        document.getElementById('name').addEventListener('blur', function() {
            const name = this.value.trim();
            const titleField = document.getElementById('title');
            const metaKeywordField = document.getElementById('meta_keyword');
            const metaDescriptionField = document.getElementById('meta_description');

            if (name) {
                if (!titleField.value) {
                    titleField.value = `${name} - Discounts, Coupons & Deals`;
                }

                if (!metaKeywordField.value) {
                    metaKeywordField.value = `${name}, coupons, discounts, deals, promo codes`;
                }

                if (!metaDescriptionField.value) {
                    metaDescriptionField.value = `Find the best ${name} coupons, promo codes and discounts. Save money with our verified ${name} deals.`;
                }
            }
        });
    });
</script>
@endsection

