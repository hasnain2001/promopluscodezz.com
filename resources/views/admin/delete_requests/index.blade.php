@extends('admin.layouts.master')
@section('title', 'Delete Requests')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header bg-white">
                    <h3 class="card-title">
                        <i class="fas fa-trash-restore mr-2"></i>Store Delete Requests
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <!-- Session Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle fa-lg mr-3"></i>
                            <div>
                                <h5 class="mb-0">Success!</h5>
                                <p class="mb-0">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show m-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-lg mr-3"></i>
                            <div>
                                <h5 class="mb-0">Error!</h5>
                                <p class="mb-0">{{ session('error') }}</p>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show m-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-times-circle fa-lg mr-3"></i>
                            <div>
                                <h5 class="mb-0">Validation Errors</h5>
                                <ul class="mb-0 pl-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card-body pt-0">
                    @if($requests->isEmpty())
                        <div class="empty-state">
                            <div class="empty-state-icon bg-light">
                                <i class="fas fa-trash-alt"></i>
                            </div>
                            <h3 class="empty-state-title">No pending requests</h3>
                            <p class="empty-state-subtitle">
                                There are currently no store deletion requests to review.
                            </p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 25%">Store</th>
                                        <th style="width: 25%">Requested By</th>
                                        <th style="width: 20%">Requested At</th>
                                        <th style="width: 30%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                    <tr class="request-row">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="store-icon mr-3">
                                                    <i class="fas fa-store"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $request->store->name }}</h6>
                                                    <small class="text-muted">ID: {{ $request->store->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar mr-3">
                                                    <i class="fas fa-user-circle"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $request->employee->name ?? 'Unknown' }}</h6>
                                                    <small class="text-muted">{{ $request->employee->email ?? '' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="request-date">
                                                {{-- <div class="date-day">{{ $request->created_at->format('d M') }}</div> --}}
                                                <div class="date-time">{{ $request->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A')}}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start">
                                                <form action="{{ route('admin.delete.approve', $request->id) }}" method="POST" class="mr-2">
                                                    @csrf
                                                    <button type="submit" onclick="return confirmAction('approve')"
                                                        class="btn btn-success btn-pill btn-sm action-btn">
                                                        <i class="fas fa-check mr-1"></i> Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.delete.reject', $request->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" onclick="return confirmAction('reject')"
                                                        class="btn btn-danger btn-pill btn-sm action-btn">
                                                        <i class="fas fa-times mr-1"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                {{-- @if($requests->hasPages())
                <div class="card-footer clearfix bg-white">
                    <div class="float-right">
                        {{ $requests->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
                @endif --}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<!-- AdminLTE -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
<!-- Custom CSS -->
<style>
    .card-primary.card-outline {
        border-top: 3px solid #4e73df;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .empty-state {
        text-align: center;
        padding: 40px 0;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 32px;
        color: #4e73df;
    }

    .empty-state-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #4e73df;
    }

    .empty-state-subtitle {
        color: #6c757d;
        max-width: 500px;
        margin: 0 auto;
    }

    .request-row:hover {
        background-color: rgba(78, 115, 223, 0.05);
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }

    .store-icon, .avatar {
        width: 40px;
        height: 40px;
        background-color: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4e73df;
    }

    .request-date {
        display: flex;
        flex-direction: column;
    }

    .date-day {
        font-weight: 600;
    }

    .date-time {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .btn-pill {
        border-radius: 50px;
        padding: 0.25rem 1rem;
    }

    .action-btn {
        transition: all 0.2s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .alert {
        border-left: 4px solid;
    }

    .alert-success {
        border-left-color: #28a745;
    }

    .alert-danger {
        border-left-color: #dc3545;
    }

    .alert-info {
        border-left-color: #17a2b8;
    }

    .table thead th {
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        color: #6c757d;
    }
</style>
@endsection

@section('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmAction(action) {
        return Swal.fire({
            title: `Are you sure to ${action} this request?`,
            text: "This action cannot be undone",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Yes, ${action} it!`,
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            return result.isConfirmed;
        });
    }

    // Animation for alerts
    $(document).ready(function() {
        $('.alert').hide().fadeIn(500);

        // Close button for alerts
        $('[data-dismiss="alert"]').click(function() {
            $(this).closest('.alert').fadeOut(300, function() {
                $(this).remove();
            });
        });

        // Hover effect for table rows
        $('.request-row').hover(
            function() {
                $(this).css('transform', 'translateY(-1px)');
            },
            function() {
                $(this).css('transform', 'translateY(0)');
            }
        );
    });
</script>
@endsection
