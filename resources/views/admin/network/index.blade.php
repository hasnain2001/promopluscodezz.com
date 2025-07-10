@extends('admin.layouts.datatable')
@section('title', 'Network List')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title mb-0 text-white">
                        <i class="fas fa-network-wired me-2"></i> Network Management
                    </h4>
                    <a href="{{ route('admin.network.create') }}" class="btn btn-light">
                        <i class="fas fa-plus me-1"></i> Add Network
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="mb-4">
                    <p class="text-muted mb-3">
                        <i class="fas fa-info-circle me-1"></i> The network data table displays all networks in the system. You can manage networks through this interface.
                    </p>
                </div>

                <div class="table-responsive">
                    <table id="basic-datatable" class="table table-hover table-striped dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Network Title</th>
                                <th>Audit Info</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($networks as $network)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="fw-semibold">{{ $network->title }}</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column small">
                                        <span class="text-muted">
                                            <i class="fas fa-user-plus me-1"></i>
                                            {{ $network->user->name ?? 'N/A'}}
                                        </span>
                                        <span class="text-muted">
                                            <i class="fas fa-user-edit me-1"></i>
                                            {{ $network->updatedby->name ?? 'N/A'}}
                                        </span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.network.edit', $network->id) }}"
                                           class="btn btn-outline-primary rounded-start"
                                           data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.network.destroy', $network->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this network?')"
                                                    class="btn btn-outline-danger rounded-end"
                                                    data-bs-toggle="tooltip" title="Delete">
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
            <!-- end card body-->
            <div class="card-footer bg-light">
                <div class="text-muted small">
                    <i class="fas fa-database me-1"></i> Total Networks: {{ $networks->count() }}
                </div>
            </div>
        </div>
        <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
@endsection

@section('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection
