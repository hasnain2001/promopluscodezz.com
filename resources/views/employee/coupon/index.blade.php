@extends('employee.layouts.master')
@section('title', 'Coupon List')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">
                            <i class="fas fa-tags me-2"></i>Coupon Management
                        </h4>
                        <a href="{{ route('employee.coupon.create') }}" class="btn btn-light btn-sm">
                            <i class="fa fa-plus me-1"></i> Add Coupon
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Filter Card -->
                    <div class="card mb-4 border-primary">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-filter me-2"></i>Filter Options
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="storeFilterForm" class="row g-3">
                                <div class="col-md-6">
                                    <label for="storeSelect" class="form-label">Filter by Store</label>
                                    <select name="store_id" id="storeSelect" class="form-select">
                                        <option value="">All Stores</option>
                                        @foreach ($stores as $store)
                                            <option value="{{ $store->id }}" {{ $selectedStore == $store->id ? 'selected' : '' }}>
                                                ({{ $store->name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 d-flex align-items-end">
                                    <button type="button" id="resetFilter" class="btn btn-outline-secondary">
                                        <i class="fas fa-sync-alt me-1"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Coupons Table -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-list me-2"></i>Coupons List
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="basic-datatable" class="table table-hover table-striped mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="5%">Sort</th>
                                            <th width="15%">Coupon Name</th>
                                            <th width="15%">Store name</th>
                                            <th width="10%">Type</th>
                                            <th width="10%">Status</th>
                                            <th width="15%">Created At</th>
                                            <th width="15%">Last Updated</th>
                                             <th width="100%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablecontents">
                                        @include('employee.coupon.partials.coupons', ['coupons' => $coupons])
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted small">
                                    Showing <span id="couponCount">{{ $coupons->count() }}</span> coupons
                                </div>
                                <div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script >

    document.addEventListener('DOMContentLoaded', function() {
        // Store filter functionality
        const storeSelect = document.getElementById('storeSelect');
        const tablecontents = document.getElementById('tablecontents');
        const couponCount = document.getElementById('couponCount');
        const resetFilter = document.getElementById('resetFilter');

        storeSelect.addEventListener('change', function() {
            const storeId = this.value;
            const url = "{{ route('employee.coupon.index') }}";
            const params = new URLSearchParams();

            if (storeId) {
                params.append('store_id', storeId);
            }

            // Show loading state
            tablecontents.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 mb-0">Loading coupons...</p>
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
                tablecontents.innerHTML = data.html;
                couponCount.textContent = document.querySelectorAll('#tablecontents tr[data-id]').length;

                // Initialize tooltips for new content
                if (window.bootstrap && window.bootstrap.Tooltip) {
                    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                    tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl);
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                tablecontents.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center text-danger py-4">
                            <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                            <p class="mb-0">Error loading coupons. Please try again.</p>
                        </td>
                    </tr>
                `;
            });
        });

        // Reset filter functionality
        resetFilter.addEventListener('click', function() {
            storeSelect.value = '';
            storeSelect.dispatchEvent(new Event('change'));
        });


    });
</script>

@endsection

@section('styles')
<style>
    .cursor-grab {
        cursor: grab;
    }
    .cursor-grab:active {
        cursor: grabbing;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .badge {
        font-size: 0.85em;
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }
    .table-dark {
        background-color: #2a3042;
    }
    .table-dark th {
        border-bottom: none;
    }
    .handle i {
        transition: transform 0.2s;
    }
    .handle:hover i {
        transform: scale(1.2);
    }
</style>
@endsection
