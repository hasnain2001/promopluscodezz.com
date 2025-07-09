<div class="p-4 border rounded shadow-sm bg-white">
    @if (!$record)
        <button wire:click="checkIn" class="btn btn-primary btn-lg w-100 py-3">
            <i class="fas fa-sign-in-alt me-2"></i> Check In
        </button>

    @elseif (!$record->check_out_at)
        <div class="alert alert-info mb-3">
            <div class="d-flex align-items-center">
                <i class="fas fa-clock fa-2x me-3"></i>
                <div>
                    <h5 class="alert-heading mb-1">Checked In</h5>
                    <p class="mb-0">{{ \Carbon\Carbon::parse($record->check_in_at)->timezone('Asia/Karachi')->format('M d, Y h:i A') }}</p>
                </div>
            </div>
        </div>
        <button wire:click="checkOut" class="btn btn-danger btn-lg w-100 py-3">
            <i class="fas fa-sign-out-alt me-2"></i> Check Out
        </button>

    @elseif ($this->canCheckInAgain())
        <button wire:click="checkIn" class="btn btn-success btn-lg w-100 py-3">
            <i class="fas fa-redo me-2"></i> Check In Again
        </button>
    @else
        <div class="alert alert-warning">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle fa-2x me-3"></i>
                <div>
                    <h5 class="alert-heading mb-1">Already Checked Out</h5>
                    <p class="mb-0">You can check in again after 1 hours.</p>
                </div>
            </div>
        </div>
    @endif
</div>
