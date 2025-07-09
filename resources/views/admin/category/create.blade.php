@extends('admin.layouts.app')
@section('title', 'Create category')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h4 class="header-title mb-0 d-flex align-items-center">
                        <i class="fas fa-folder-plus text-primary me-2"></i>
                        Create New Category
                    </h4>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        Fill in the details below to create a new product category.
                    </p>

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Error!</strong> Please fix the following issues:
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="e.g. Electronics" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Category Slug <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                                        <input type="text" name="slug" id="slug" class="form-control" placeholder="e.g. electronics" required>
                                        <button class="btn btn-outline-secondary" type="button" id="slug-generator">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">This will be used in URLs</small>
                                    <div id="slug-availability" class="mt-1"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Category Image</label>
                                    <div class="input-group">
                                        <input type="file" name="image" id="image" class="form-control" accept=".jpg, .jpeg, .png, .gif, .webp">
                                    </div>
                                    <small class="text-muted">Recommended size: 800x800px</small>
                                    <div class="mt-2" id="image-preview"></div>
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

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="enable" value="1" checked>
                                            <label class="form-check-label text-success" for="enable">
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
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="top_category" id="top_category" value="1">
                                        <label class="form-check-label" for="top_category">Featured Category</label>
                                    </div>
                                    <small class="text-muted">Show this category in featured sections</small>
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Meta title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="e.g. electronics, gadgets">
                                    <small class="text-muted">Separate title with commas</small>
                                </div>

                                <div class="mb-3">
                                    <label for="meta_keyword" class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" placeholder="e.g. buy electronics, best gadgets">
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" rows="3" placeholder="Brief description for search engines" style="resize: none;"></textarea>
                                    <small class="text-muted">Max 160 characters</small>
                                    <div class="text-end"><span id="meta-counter">0</span>/160</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="reset" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-undo me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
            $(document).ready(function() {
                // Debug: Verify jQuery is loaded
                console.log("jQuery version:", $.fn.jquery);

                // Debug: Verify route URL
                console.log("Slug check route:", '{{ route("admin.category.checkslug") }}');

                // Generate slug from name
                $('#name').on('input', function() {
                    console.log("Name input changed");
                    const name = $(this).val();
                    generateSlug(name);
                });

                // Manual slug generation button
                $('#slug-generator').click(function() {
                    console.log("Manual slug generation triggered");
                    generateSlug($('#name').val());
                });

                // Function to generate slug and check availability
                function generateSlug(name) {
                    if (!name) {
                        console.log("Empty name, skipping slug generation");
                        return;
                    }

                    // Generate slug
                    const slug = name.toLowerCase()
                        .replace(/[^\w\s-]/g, '') // Remove non-word chars
                        .replace(/[\s_-]+/g, ' ') // Replace spaces and underscores with -
                        .replace(/^-+|-+$/g, ''); // Trim - from start/end

                    console.log("Generated slug:", slug);

                    // Set slug value
                    $('#slug').val(slug);

                    // Check availability
                    checkSlugAvailability(slug);
                }

                // Check slug availability
                $('#slug').on('input', function() {
                    const slug = $(this).val();
                    console.log("Slug input changed:", slug);
                    checkSlugAvailability(slug);
                });

                function checkSlugAvailability(slug) {
                    if (!slug) {
                        console.log("Empty slug, clearing availability message");
                        $('#slug-availability').empty();
                        return;
                    }

                    console.log("Checking slug availability for:", slug);

                    $.ajax({
                        url: '{{ route("admin.category.checkslug") }}',
                        type: 'GET',
                        data: { slug: slug },
                        dataType: 'json',
                        success: function(response) {
                            console.log("Slug check response:", response);
                            if (response.available) {
                                $('#slug-availability').html('<span class="text-success"><i class="fas fa-check-circle"></i> Available</span>');
                            } else {
                                $('#slug-availability').html('<span class="text-danger"><i class="fas fa-exclamation-circle"></i> Already in use</span>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            console.error('Response:', xhr.responseText);
                            $('#slug-availability').html('<span class="text-warning"><i class="fas fa-exclamation-triangle"></i> Error checking availability</span>');
                        }
                    });
                }

                // Rest of your scripts...
            });
    </script>
@endsection
