@extends('admin.layouts.datatable')
@section('title', 'Store List')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="header-title">Store Management</h4>
                        <p class="text-muted mb-0">
                            Manage all stores in the system. View, edit, or delete stores below.
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('admin.store.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus-circle-outline"></i> Add New Store
                        </a>
                    </div>
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-circle-outline me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-alert-circle-outline me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form id="deleteForm" action="{{ route('admin.store.deleteSelected') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-hover table-centered mb-0 dt-responsive nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 30px;">
                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                    </th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Network</th>
                                    <th>Language</th>
                                    <th>Status</th>
                                    <th>Created / updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input select-checkbox" name="ids[]" value="{{ $store->id }}">
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('uploads/stores/' . $store->image) }}"
                                                 class="rounded me-2"
                                                 alt="{{ $store->name }}"
                                                 width="40"
                                                 onerror="this.onerror=null;this.src='{{ asset('assets/images/no-image-found.png') }}'"
                                                 loading="lazy">
                                            <div>
                                                <h6 class="mb-0">{{ $store->name }}</h6>
                                                <small class="text-muted d-block">Created by {{ $store->user->name ?? 'N/A' }}</small>
                                                <small class="text-muted">Updated by {{ $store->updatedby->name ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><small>{{ $store->category->name ?? 'N/A' }}</small></td>
                                    <td><small>{{ $store->network->title  }}</small></td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $store->language ? $store->language->name : 'N/A' }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $store->status == '1' ? 'success' : 'danger' }}-subtle text-{{ $store->status == '1' ? 'success' : 'danger' }} rounded-pill">
                                            {{ $store->status == '1' ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div>
                                            <small class="fw-semibold" data-bs-toggle="tooltip" title="Created at: {{ $store->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
                                                <i class="mdi mdi-calendar-clock text-primary me-1"></i>
                                                {{ $store->created_at->setTimezone('Asia/Karachi')->format('M j, Y h:i A') }}
                                            </small>
                                            <br>
                                            <small class="text-muted" data-bs-toggle="tooltip" title="Last updated: {{ $store->updated_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
                                                <i class="mdi mdi-update text-info me-1"></i>
                                                Updated: {{ $store->updated_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
                                            </small>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.store.edit', $store->id) }}"
                                               class="btn btn-sm btn-outline-primary rounded-3 px-2"
                                               data-bs-toggle="tooltip"
                                               title="Edit Store">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>

                                            <form action="{{ route('admin.store.destroy', $store->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this store?')"
                                                        class="btn btn-sm btn-outline-danger rounded-3 px-2"
                                                        data-bs-toggle="tooltip"
                                                        title="Delete Store">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>

                                            <a href="{{ route('store.detail',['slug' =>Str::slug($store->slug)]) }}"
                                                target="_blank"
                                               class="btn btn-sm btn-outline-info rounded-3 px-2"
                                               data-bs-toggle="tooltip"
                                               title="View Store">
                                                <i class="mdi mdi-eye"></i>
                                            </a>

                                            <a href="{{ route('admin.store.show', ['slug' => Str::slug($store->slug)]) }}"
                                               class="btn btn-sm btn-outline-success rounded-3 px-2"
                                               data-bs-toggle="tooltip"
                                               title="Edit Coupons">
                                                <i class="mdi mdi-tag"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>

                <div class="mt-3">
                    <button id="deleteSelected" class="btn btn-danger">
                        <i class="mdi mdi-delete"></i> Delete Selected
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Select all checkboxes
            $('#selectAll').click(function() {
                $('.select-checkbox').prop('checked', this.checked);
            });

            // Delete selected button click
            $('#deleteSelected').click(function(e) {
                e.preventDefault();

                const selectedCount = $('.select-checkbox:checked').length;
                if (selectedCount > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to delete ${selectedCount} store(s). This action cannot be undone!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete them!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#deleteForm').submit();
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'No Selection',
                        text: 'Please select at least one store to delete.',
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                    });
                }
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection

@section('styles')
<style>
    .table th {
        white-space: nowrap;
        vertical-align: middle;
    }
    .table td {
        vertical-align: middle;
    }
    .img-thumbnail {
        padding: 2px;
        border: 1px solid #dee2e6;
        object-fit: cover;
    }
    .badge {
        font-size: 0.75em;
        font-weight: 500;
        padding: 4px 8px;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        min-width: 32px;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    .alert {
        border-radius: 8px;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .header-title {
        position: relative;
        padding-bottom: 10px;
    }
    .header-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: #727cf5;
    }
    @media (max-width: 767.98px) {
        .table-responsive {
            border: 0;
        }
        .table thead {
            display: none;
        }
        .table tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
        .table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem;
            border-bottom: 1px solid #dee2e6;
        }
        .table td:before {
            content: attr(data-label);
            font-weight: 600;
            margin-right: 1rem;
        }
        .table td:last-child {
            border-bottom: 0;
        }
        .d-flex.gap-1 {
            flex-wrap: wrap;
            gap: 0.5rem !important;
        }
    }
</style>
@endsection
