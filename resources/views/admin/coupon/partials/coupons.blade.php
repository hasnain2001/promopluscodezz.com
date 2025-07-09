@if($coupons->isEmpty())
    <tr>
        <td colspan="9" class="text-center py-4">
            <div class="d-flex flex-column align-items-center text-muted">
                <i class="fas fa-tag fa-3x mb-3 opacity-25"></i>
                <h5 class="mb-1">No coupons found</h5>
                <p class="mb-0">Try adjusting your filters</p>
            </div>
        </td>
    </tr>
@else
    @foreach($coupons as $coupon)
    <tr class="row1 align-middle" data-id="{{ $coupon->id }}">
        <td class="fw-semibold">{{ $loop->iteration }}</td>
        <td class="text-center handle">
            <div class="cursor-grab bg-light rounded p-2 d-inline-block">
                <i class="fas fa-arrows-alt text-secondary"></i>
            </div>
        </td>
        <td>
            <div class="d-flex align-items-center">
                <i class="fas fa-tag text-primary me-2"></i>
                <span>{{ $coupon->name ?? 'null' }}</span>
            </div>
        </td>
        <td>
            <div class="d-flex align-items-center">
                <i class="fas fa-store text-info me-2"></i>
                <span>{{ $coupon->store->name }}</span>
            </div>
        </td>
        <td>
            @if ($coupon->code)
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10 px-3 py-2">
                    <i class="fas fa-code me-1"></i> Code
                </span>
            @else
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-10 px-3 py-2">
                    <i class="fas fa-percentage me-1"></i> Deal
                </span>
            @endif
        </td>
        <td>
            @if ($coupon->status == 1)
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-10 px-3 py-2">
                    <i class="fas fa-check-circle me-1"></i> Active
                </span>
            @else
                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10 px-3 py-2">
                    <i class="fas fa-times-circle me-1"></i> Inactive
                </span>
            @endif
        </td>
        <td>
            <div class="d-flex align-items-center text-muted">
                <i class="far fa-calendar-alt me-2"></i>
                <span>{{ $coupon->created_at->format('M d, Y h:i A') }}</span>
            </div>
        </td>
        <td>
            <div class="d-flex align-items-center text-muted">
                <i class="far fa-clock me-2"></i>
                <span>{{ $coupon->updated_at->format('M d, Y h:i A') }}</span>
            </div>
        </td>
        <td>
                 <div class="me-3">
                    <i class="fas fa-user-circle text-secondary me-1"></i>
                    <span>{{ $coupon->user->name }}</span>
                </div>
                  <div class="me-3">
                    <i class="fas fa-user-circle text-secondary me-1"></i>
                    <span>{{ $coupon->updatedby->name ?? 'Unknown' }}</span>
                </div>
        </td>
        <td>
            <div class="d-flex align-items-center">

                <div class="btn-group btn-group-sm">
                    <a href="{{ route('admin.coupon.edit', $coupon->id) }}"
                       class="btn btn-outline-primary rounded-start"
                       data-bs-toggle="tooltip" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('admin.coupon.destroy', $coupon->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this coupon?')"
                                class="btn btn-outline-danger rounded-end"
                                data-bs-toggle="tooltip" title="Delete">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </td>
    </tr>
    @endforeach
@endif
