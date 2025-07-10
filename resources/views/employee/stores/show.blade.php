@extends('employee.layouts.master')
@section('title', 'Store Details')
@section('content')
<main class="container-fluid px-0">
    <div class="content-wrapper">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="bg-light rounded-3 px-3 py-2 mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('employee.store.index') }}">Stores</a></li>
                <li class="breadcrumb-item"><a href="{{ route('employee.coupon.index') }}">Coupons</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">{{ $store->name }}</li>
            </ol>
        </nav>

        <!-- Store Header Section -->
        <section class="store-header mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img class="img-thumbnail rounded-circle me-3" src="{{ asset('uploads/stores/' . $store->image) }}" style="width:80px; height:80px; object-fit:cover;" loading="lazy" alt="{{ $store->name }}">
                            <div>
                                <h1 class="h3 mb-0">{{ $store->name }}</h1>
                                <div class="text-muted">
                                    <span class="me-2"><i class="fas fa-globe"></i>
                                       <a href="{{ route('store.detail',['slug' =>Str::slug($store->slug)]) }}"
                                                target="_blank"
                                               class=" rounded-3 px-2"
                                               data-bs-toggle="tooltip"
                                               title="View Store">
                                         {{ $store->url }}
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="action-buttons">
                            <a href="{{ route('employee.store.edit', $store->id) }}" class="btn btn-outline-primary btn-sm me-2">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <form action="{{ route('employee.store.destroy', $store->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure to delete this store?')" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt me-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Store Meta Information -->
                    <div class="store-meta row g-3">
                        <div class="col-md-6">
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-info">
                                    <i class="fas fa-network-wired me-1"></i> {{ $store->network->title ?? 'N/A' }}
                                </span>
                                <span class="badge bg-secondary">
                                    <i class="fas fa-list me-1"></i> {{ $store->category->name ?? 'N/A' }}
                                </span>
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-language me-1"></i> {{ $store->language->name ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-wrap justify-content-md-end gap-2">
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-calendar-plus me-1"></i> Created: {{ $store->created_at->format('M d, Y h:i A') }}
                                </span>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-calendar-check me-1"></i> Updated: {{ $store->updated_at->format('M d, Y h:i A') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-primary">
                                    <i class="fas fa-user me-1"></i> Created by: {{ $store->user->name }}
                                </span>
                                <span class="badge bg-secondary">
                                    <i class="fas fa-user-edit me-1"></i> Updated by: {{ $store->updatedby->name ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Coupons Section -->
        <section class="coupons-section">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h2 class="h5 mb-0">
                        <i class="fas fa-tags text-primary me-2"></i> Coupons
                    </h2>
                    <a href="{{ route('employee.coupon.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle me-1"></i> Add New Coupon
                    </a>
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle fa-2x me-3"></i>
                        <div>
                            <strong>Success!</strong> {{ session('success') }}
                            @if(isset($store->name))
                                <span class="text-primary">({{ $store->name }})</span>
                            @endif
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th width="40px">#</th>
                                    <th width="40px">Sort</th>
                                    <th>Coupon Details</th>
                                    <th width="120px">Type</th>
                                    <th width="100px">Status</th>
                                    <th width="180px">Author</th>
                                    <th width="180px">Dates</th>
                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tablecontents">
                                @foreach ($coupons as $coupon)
                                <tr class="row1" data-id="{{ $coupon->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="handle"><i class="fas fa-arrows-alt text-muted"></i></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <img src="{{ asset('uploads/stores/' . $coupon->store->image) }}" alt="{{ $coupon->store->name }}" class="rounded-circle" width="40" height="40">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">{{ $coupon->name ?: 'N/A' }}</h6>
                                                @if($coupon->code)
                                                <small class="text-muted">Code: <span class="text-primary">{{ $coupon->code }}</span></small>
                                                @endif
                                                <div>
                                                    <small class="badge bg-black">{{ $coupon->store->name }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($coupon->code)
                                            <span class="badge bg-primary">
                                                <i class="fas fa-code me-1"></i> Code
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                <i class="fas fa-percentage me-1"></i> Deal
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($coupon->status == 1)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i> Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times-circle me-1"></i> Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <span class="avatar-title rounded-circle bg-info text-white">
                                                    {{ substr($coupon->user->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $coupon->user->name }}</div>
                                                <small class="text-muted">{{ $coupon->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <small class="text-muted d-block">
                                                <i class="far fa-calendar-alt me-1"></i>
                                                {{ $coupon->created_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-sync-alt me-1"></i>
                                                {{ $coupon->updated_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('employee.coupon.edit', $coupon->id) }}" class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('employee.coupon.destroy', $coupon->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this coupon?')" data-bs-toggle="tooltip" title="Delete">
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


                <div class="card-footer bg-white">
                   total {{ $coupons->count() }}
                </div>

            </div>
        </section>
    </div>
</main>
@endsection



@section('scripts')
<script>
    $(function() {
        // Enable tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Make table rows sortable
        $("#tablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {
            var order = [];
            $('tr.row1').each(function(index,element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('employee.coupon.update-order') }}",
                data: {
                    order: order,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status == "success") {
                        console.log(response);
                    } else {
                        console.log(response);
                    }
                }
            });
        }
    });
</script>
@endsection
