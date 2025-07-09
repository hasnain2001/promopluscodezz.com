@extends('admin.layouts.datatable')
@section('title', 'Slider Management')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title mb-0 text-white">
                        <i class="fas fa-images me-2"></i> Slider Management
                    </h4>
                    <div>
                        <a href="{{ route('admin.slider.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i> Add New Slider
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="mb-4">
                    <p class="text-muted mb-3">
                        <i class="fas fa-info-circle me-1"></i> Manage all slider items displayed on your website.
                        You can sort, activate/deactivate, and edit each slider from this panel.
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-1"></i> Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="?status=active">Active Only</a></li>
                                <li><a class="dropdown-item" href="?status=inactive">Inactive Only</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('admin.slider.index') }}">Show All</a></li>
                            </ul>
                        </div>

                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fas fa-language me-1"></i> Language
                            </button>
                            <ul class="dropdown-menu">
                                @foreach($languages as $lang)
                                <li><a class="dropdown-item" href="?language={{ $lang->code }}">{{ $lang->name }}</a></li>
                                @endforeach
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="?">All Languages</a></li>
                            </ul>
                        </div>

                        <a href="{{ route('admin.slider.export') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-file-export me-1"></i> Export
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="basic-datatable" class="table table-hover table-striped dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Preview</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Link</th>
                                <th>Sort</th>
                                <th>Language</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($slider->image)
                                    <a href="{{ asset('uploads/slider/' . $slider->image) }}" data-fancybox="gallery">
                                        <img src="{{ asset('uploads/slider/' . $slider->image) }}"
                                             class="rounded me-2 img-thumbnail"
                                             alt="{{ $slider->title }}"
                                             width="60" height="40"
                                             style="object-fit: cover;">
                                    </a>
                                    @else
                                    <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $slider->title }}</div>
                                    <small class="text-muted">Created: {{ $slider->created_at->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    <form action="{{ route('admin.slider.toggle-status', $slider->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-xs p-0 border-0 bg-transparent">
                                            <span class="badge rounded-pill bg-{{ $slider->status ? 'success' : 'danger' }}">
                                                {{ $slider->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    @if($slider->link)
                                    <a href="{{ $slider->link }}" target="_blank" class="text-truncate d-block" style="max-width: 150px;">
                                        <i class="fas fa-external-link-alt me-1"></i> {{ parse_url($slider->link, PHP_URL_HOST) }}
                                    </a>
                                    @else
                                    <span class="text-muted">No link</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-primary rounded-pill">{{ $slider->sort_order }}</span>
                                </td>
                                <td>
                                    <span class="badge" style="background-color: {{ $slider->language->color ?? '#6c757d' }}; color: white;">
                                        {{ $slider->language->name }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                           class="btn btn-sm btn-outline-primary rounded-pill"
                                           data-bs-toggle="tooltip"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this slider?')"
                                                    class="btn btn-sm btn-outline-danger rounded-pill"
                                                    data-bs-toggle="tooltip"
                                                    title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Showing <strong>{{ $sliders->firstItem() }} - {{ $sliders->lastItem() }}</strong>
                        of <strong>{{ $sliders->total() }}</strong> sliders
                    </div>
                    {{ $sliders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.min.css" />
<style>
    .img-thumbnail {
        transition: transform 0.2s;
    }
    .img-thumbnail:hover {
        transform: scale(1.1);
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    .badge {
        font-weight: 500;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    $(document).ready(function() {
        // Initialize fancybox for image previews
        Fancybox.bind("[data-fancybox]", {
            // Options
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Initialize DataTable
        $('#basic-datatable').DataTable({
            responsive: true,
            dom: '<"top"f>rt<"bottom"lip><"clear">',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search sliders...",
            },
            columnDefs: [
                { orderable: false, targets: [1, 7] } // Disable sorting on image and actions columns
            ]
        });
    });
</script>
@endpush
