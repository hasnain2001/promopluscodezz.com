@extends('admin.layouts.app')
@section('title', 'Create Coupon')
@section('styles')
    <style>
        .card {
            border-radius: 10px;
            overflow: hidden;
        }

        .card-title {
            font-weight: 600;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-check:checked + .btn-outline-success {
            background-color: #198754;
            color: white;
        }

        .btn-check:checked + .btn-outline-danger {
            background-color: #dc3545;
            color: white;
        }

        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .form-switch .form-check-input {
            height: 1.5em;
            width: 2.5em;
        }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-primary">Create New Coupon</h4>
                <p class="text-muted font-14 mb-3">Fill in the details below to create a new coupon offer</p>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Error!</strong>
                        <ul class="mb-0 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                       @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle fa-2x me-3"></i>
                    <div>
                        <p class="mb-0">Success! {{ session('success') }}</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form name="CreateStore" id="CreateStore" method="POST" enctype="multipart/form-data" action="{{ route('admin.coupon.store') }}">
                    @csrf
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="card border-light shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-primary mb-3">Basic Information</h5>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Coupon Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="name" id="name"
                                               value="{{ old('name', request()->input('name')) }}" required
                                               placeholder="e.g. Summer Sale 2023">
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="description" class="form-control"
                                                  cols="20" rows="3" style="resize: none;"
                                                  placeholder="Brief description about the coupon offer">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="mb-3 form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="toggleCodeCheckbox"
                                               onchange="toggleCodeInput(this)" {{ old('code') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="toggleCodeCheckbox">Enable Custom Code</label>
                                    </div>

                                    <div class="mb-3" id="codeInputGroup">
                                        <label for="code" class="form-label">Coupon Code</label>
                                        <input type="text" class="form-control" name="code" id="code"
                                               value="{{ old('code') }}" placeholder="e.g. SUMMER20">
                                        <small class="text-muted">Leave blank to auto-generate</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="ending_date" class="form-label">Expiry Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="ending_date" id="ending_date"
                                               value="{{ old('ending_date') }}" required min="{{ date('Y-m-d') }}">
                                        <small id="dateError" class="text-danger" style="display: none;">Please select a future date.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="card border-light shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-primary mb-3">Store & Settings</h5>

                            <div class="mb-3">
                                <label for="store_id" class="form-label">Store <span class="text-danger">*</span></label>
                                <select name="store_id" id="store_id" class="form-select" onchange="updateDestinationAndLanguage()" required>
                                    <option value="" disabled {{ old('store_id') ? '' : 'selected' }}>-- Select Store --</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}"
                                                data-url="{{ $store->destination_url }}"
                                                data-language-id="{{ $store->language_id }}"
                                                {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                            {{ $store->slug }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="language_id" class="form-label">Language <span class="text-danger">*</span></label>
                                <select name="language_id" id="language_id" class="form-select" required>
                                    <option value="" disabled {{ old('language_id') ? '' : 'selected' }}>-- Select Language --</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}" {{ old('language_id') == $language->id ? 'selected' : '' }}>
                                            {{ $language->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                                    <div class="mb-3">
                                        <label class="form-label">Top Priority Rating <span class="text-danger">*</span></label>
                                        <div class="d-flex flex-wrap gap-2">
                                            @for ($i = 0; $i <= 10; $i++)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="top_coupons"
                                                           id="top_{{ $i }}" value="{{ $i }}"
                                                           {{ old('top_coupons') == $i ? 'checked' : ($i == 0 ? 'checked' : '') }}>
                                                    <label class="form-check-label" for="top_{{ $i }}">{{ $i }}</label>
                                                </div>
                                            @endfor
                                        </div>
                                        <small class="text-muted">Higher numbers appear first</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="status" id="enable" value="1" autocomplete="off" checked>
                                            <label class="btn btn-outline-success" for="enable">Active</label>

                                            <input type="radio" class="btn-check" name="status" id="disable" value="0" autocomplete="off">
                                            <label class="btn btn-outline-danger" for="disable">Inactive</label>
                                        </div>
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label class="form-label">Badge Type</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach (['never expire', 'featured', 'free shipping', 'coupon code', 'top deals', 'valentine'] as $auth)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="authentication"
                                                           id="{{ $auth }}" value="{{ $auth }}"
                                                           {{ old('authentication') === $auth ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="{{ $auth }}" >
                                                        {{ ucfirst(str_replace('_', ' ', $auth)) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.coupon.index') }}" class="btn btn-light px-4">
                                    <i class="uil uil-times me-1"></i> Cancel
                                </a>
                                <button type="reset" class="btn btn-secondary px-4">
                                    <i class="uil uil-redo me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="uil uil-check me-1"></i> Save Coupon
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
@endsection
@section('scripts')
<script>
    function updateDestinationAndLanguage() {
        const storeSelect = document.getElementById('store_id');
        const selectedOption = storeSelect.options[storeSelect.selectedIndex];
        const languageId = selectedOption.getAttribute('data-language-id');

        // Update language selection
        if (languageId) {
            const languageSelect = document.getElementById('language_id');
            languageSelect.value = languageId;
        }

        // Your existing code for updating destination URL would go here
        // ...
    }

    // Initialize the code input group based on checkbox state
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('toggleCodeCheckbox');
        toggleCodeInput(checkbox);

        // Date validation
        const dateInput = document.getElementById('ending_date');
        dateInput.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (selectedDate < today) {
                document.getElementById('dateError').style.display = 'block';
                this.value = '';
            } else {
                document.getElementById('dateError').style.display = 'none';
            }
        });

        // If there's a previously selected store (from old input), update the language
        const storeSelect = document.getElementById('store_id');
        if (storeSelect.value) {
            updateDestinationAndLanguage();
        }
    });

    function toggleCodeInput(checkbox) {
        const codeInputGroup = document.getElementById('codeInputGroup');
        if (checkbox.checked) {
            codeInputGroup.style.display = 'block';
        } else {
            codeInputGroup.style.display = 'none';
            document.getElementById('code').value = '';
        }
    }


</script>
@endsection
