@extends('admin.layouts.datatable')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>Categories Management</h2>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="language_filter">Filter by Language:</label>
                                <select class="form-control" id="language_filter" name="language_id">
                                    <option value="">All Languages</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}" {{ $selectedLanguage == $language->id ? 'selected' : '' }}>
                                            {{ $language->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button id="filter-btn" class="btn btn-primary">Filter</button>
                            <button id="reset-btn" class="btn btn-secondary ml-2">Reset</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('admin.category.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Add New Category
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>image</th>
                                    <th>Language</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Last Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="categories-container">
                                @include('admin.category.partials.categories', ['categories' => $categories])
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const languageFilter = document.getElementById('language_filter');
    const filterBtn = document.getElementById('filter-btn');
    const resetBtn = document.getElementById('reset-btn');
    const categoriesContainer = document.getElementById('categories-container');

    // Function to load categories via AJAX
    function loadCategories(languageId) {
        const url = "{{ route('admin.category.index') }}";
        const params = new URLSearchParams();

        if (languageId) {
            params.append('language_id', languageId);
        }

        // Show loading state
        categoriesContainer.innerHTML = `
            <tr>
                <td colspan="8" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 mb-0">Loading categories...</p>
                </td>
            </tr>
        `;

        fetch(`${url}?${params.toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            categoriesContainer.innerHTML = data.html;
        })
        .catch(error => {
            console.error('Error:', error);
            categoriesContainer.innerHTML = `
                <tr>
                    <td colspan="8" class="text-center text-danger py-4">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                        <p class="mb-0">Error loading categories. Please try again.</p>
                    </td>
                </tr>
            `;
        });
    }

    // Filter button click handler
    filterBtn.addEventListener('click', function() {
        const languageId = languageFilter.value;
        loadCategories(languageId);
    });

    // Reset button click handler
    resetBtn.addEventListener('click', function() {
        languageFilter.value = '';
        loadCategories('');
    });

    // Optional: Auto-filter when language selection changes
    languageFilter.addEventListener('change', function() {
        const languageId = this.value;
        loadCategories(languageId);
    });
});
</script>
@endsection
