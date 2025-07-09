@extends('admin.layouts.app')
@section('title')
    Update Coupon
@endsection
@section('content')
<style>
    .card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: none;
        border-radius: 8px;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #eee;
        padding: 15px 20px;
        border-radius: 8px 8px 0 0 !important;
    }

    .card-body {
        padding: 25px;
    }

    .form-control, .form-select {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 10px 15px;
        font-size: 14px;
        transition: all 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
    }

    .required-field::after {
        content: " *";
        color: #dc3545;
    }

    .btn {
        padding: 8px 20px;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .btn-primary:hover {
        background-color: #3a5ec4;
        border-color: #3a5ec4;
    }

    .btn-warning {
        background-color: #f6c23e;
        border-color: #f6c23e;
        color: #fff;
    }

    .btn-warning:hover {
        background-color: #e4b030;
        border-color: #e4b030;
    }

    .btn-secondary {
        background-color: #858796;
        border-color: #858796;
    }

    .btn-secondary:hover {
        background-color: #717384;
        border-color: #717384;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-check {
        margin-bottom: 10px;
    }

    .form-check-input {
        margin-top: 0.3em;
    }

    .form-group-inline {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .form-group-inline .form-check {
        margin-bottom: 0;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
        margin-left: 10px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 24px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .toggle-slider {
        background-color: #4e73df;
    }

    input:checked + .toggle-slider:before {
        transform: translateX(26px);
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #4e73df;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .auth-options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .auth-option {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #eee;
        transition: all 0.3s;
    }

    .auth-option:hover {
        background: #e9ecef;
        border-color: #ddd;
    }

    .auth-option.active {
        background: #e7f1ff;
        border-color: #4e73df;
    }

    .top-coupon-options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .top-coupon-option {
        display: flex;
        align-items: center;
    }

    @media (max-width: 768px) {
        .auth-options {
            grid-template-columns: 1fr;
        }

        .form-group-inline {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Coupon</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.coupon.index') }}">Coupons</a></li>
                        <li class="breadcrumb-item active">Update</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
       @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
    <section class="content">
        <div class="container-fluid">
            <form name="UpdateCoupon" id="UpdateCoupon" method="POST" action="{{ route('admin.coupon.update', $coupon->id) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Coupon Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name" class="required-field">Coupon Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $coupon->name) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="4" style="resize: none;">{{ old('description', $coupon->description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex align-items-center">
                                        <label class="mb-0 mr-2">Enable Custom Code:</label>
                                        <label class="toggle-switch">
                                            <input type="checkbox" id="toggleCodeCheckbox" onchange="toggleCodeInput(this)" {{ old('code', $coupon->code) ? 'checked' : '' }}>
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">Leave disabled to auto-generate code</small>
                                </div>

                                <div class="form-group" id="codeInputGroup" style="{{ old('code', $coupon->code) ? '' : 'display: none;' }}">
                                    <label for="code">Custom Code</label>
                                    <input type="text" class="form-control" name="code" id="code" value="{{ old('code', $coupon->code) }}">
                                </div>

                                <div class="form-group">
                                    <label for="ending_date" class="required-field">Expiration Date</label>
                                    <input type="date" class="form-control" name="ending_date" id="ending_date"
                                           value="{{ old('ending_date', \Carbon\Carbon::parse($coupon->ending_date)->format('Y-m-d')) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Settings</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="form-group-inline">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="status" id="enable" value="1" {{ old('status', $coupon->status) == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label text-success" for="enable">
                                                <i class="fas fa-check-circle mr-1"></i> Enabled
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="status" id="disable" value="0" {{ old('status', $coupon->status) == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label text-danger" for="disable">
                                                <i class="fas fa-times-circle mr-1"></i> Disabled
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Top Coupon Priority</label>
                                    <div class="top-coupon-options">
                                        @for ($i = 0; $i <= 5; $i++)
                                            <div class="top-coupon-option">
                                                <input type="radio" class="form-check-input" name="top_coupon" id="top_{{ $i }}" value="{{ $i }}"
                                                       {{ old('top_coupon', $coupon->top_coupons) == $i ? 'checked' : '' }}>
                                                <label class="form-check-label ml-1" for="top_{{ $i }}">
                                                    @if($i == 0) None @else {{ $i }} @endif
                                                </label>
                                            </div>
                                        @endfor
                                    </div>
                                    <small class="form-text text-muted">Higher numbers appear first</small>
                                </div>

                                {{-- <div class="form-group">
                                    <label>Coupon Type</label>
                                    <div class="auth-options">
                                        @php
                                            $authOptions = [
                                                'never expire' => 'Never Expire',
                                                'featured' => 'Featured',
                                                'free shipping' => 'Free Shipping',
                                                'coupon code' => 'Coupon Code',
                                                'top deals' => 'Top Deals',
                                                'valentine' => 'Valentine'
                                            ];
                                        @endphp

                                        @foreach ($authOptions as $value => $label)
                                            <div class="auth-option {{ old('authentication', $coupon->authentication) === $value ? 'active' : '' }}">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="authentication"
                                                           id="{{ $value }}" value="{{ $value }}"
                                                           {{ old('authentication', $coupon->authentication) === $value ? 'checked' : '' }}
                                                           onchange="toggleOtherInputVisibility(false)">
                                                    <label class="form-check-label" for="{{ $value }}">{{ $label }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Store Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="store_id" class="required-field">Store</label>
                                            <select name="store_id" id="store_id" class="form-select" onchange="updateDestinationAndLanguage()">
                                                <option value="" disabled selected>Select a store</option>
                                                @foreach($stores as $store)
                                                    <option value="{{ $store->id }}"
                                                            data-url="{{ $store->destination_url }}"
                                                            data-language-id="{{ $store->language_id }}"
                                                            {{ old('store_id', $coupon->store_id) == $store->id ? 'selected' : '' }}>
                                                        {{ $store->name }} ({{ $store->slug }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="language_id">Language</label>
                                            <select name="language_id" id="language_id" class="form-select">
                                                <option value="" disabled selected>Select a language</option>
                                                @foreach($languages as $language)
                                                    <option value="{{ $language->id }}"
                                                            {{ old('language_id', $coupon->language_id) == $language->id ? 'selected' : '' }}>
                                                        {{ $language->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                 </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i class="fas fa-save mr-1"></i> Save Changes
                                </button>
                                <button type="reset" class="btn btn-warning mr-2">
                                    <i class="fas fa-undo mr-1"></i> Reset
                                </button>
                                <a href="{{ route('admin.coupon.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times mr-1"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize code input toggle
        initializeCodeInput();

        // Highlight active authentication option
        const authOptions = document.querySelectorAll('.auth-option');
        authOptions.forEach(option => {
            option.addEventListener('click', function() {
                authOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                const radio = this.querySelector('input[type="radio"]');
                if (radio) radio.checked = true;
            });
        });
    });

    function updateDestinationAndLanguage() {
        const storeSelect = document.getElementById('store_id');
        const selectedOption = storeSelect.options[storeSelect.selectedIndex];

        if (selectedOption.value) {
            const destinationUrl = selectedOption.getAttribute('data-url') || '';
            const languageId = selectedOption.getAttribute('data-language-id') || '';

            document.getElementById('destination_url').value = destinationUrl;

            const languageSelect = document.getElementById('language_id');
            if (languageId && languageSelect) {
                languageSelect.value = languageId;
            }
        }
    }

    function toggleCodeInput(checkboxElement) {
        const codeInputGroup = document.getElementById('codeInputGroup');
        codeInputGroup.style.display = checkboxElement.checked ? 'block' : 'none';

        if (!checkboxElement.checked) {
            document.getElementById('code').value = '';
        }
    }

    function initializeCodeInput() {
        const codeInput = document.getElementById('code');
        if (codeInput && codeInput.value.trim() !== '') {
            document.getElementById('toggleCodeCheckbox').checked = true;
            document.getElementById('codeInputGroup').style.display = 'block';
        }
    }

    function toggleOtherInputVisibility(showOther) {
        const otherInputGroup = document.getElementById('otherInputGroup');
        const otherAuthentication = document.getElementById('otherAuthentication');

        if (showOther) {
            otherInputGroup.style.display = 'block';
            otherAuthentication.focus();
        } else {
            otherInputGroup.style.display = 'none';
            otherAuthentication.value = '';
        }
    }
</script>
@endsection
