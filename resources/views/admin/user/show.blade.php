@extends('admin.layouts.master')
@section('title', $user->name . "'s Attendance")
@section('content')

@php
    use Carbon\Carbon;

    // Calculate present and absent counts
    $presentCount = 0;
    $absentCount = 0;
    $totalWorkingDays = 0;

    if ($selectedMonth) {
        foreach ($checkins as $entry) {
            if ($entry->check_in_at && $entry->check_out_at) {
                $presentCount++;
            } else {
                $absentCount++;
            }
        }

        // Calculate total working days in the selected month
        $startDate = Carbon::parse($selectedMonth)->startOfMonth();
        $endDate = Carbon::parse($selectedMonth)->endOfMonth();

        while ($startDate <= $endDate) {
            if (!$startDate->isWeekend()) {
                $totalWorkingDays++;
            }
            $startDate->addDay();
        }
    }
@endphp

<div class="container-fluid">
    <!-- Filter Section -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <form method="GET" class="mb-0">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label for="month" class="form-label text-muted small mb-1">Filter by Month</label>
                        <div class="input-group">
                            <input type="month" name="month" id="month" class="form-control" value="{{ request('month') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter mr-1"></i> Apply
                            </button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-sync-alt mr-1"></i> Reset
                        </a>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <div class="d-flex justify-content-md-end align-items-center">
                            <div class="me-3">
                                <span class="badge bg-success p-2">Present: {{ $presentCount }}</span>
                            </div>
                            <div>
                                <span class="badge bg-danger p-2">Absent: {{ $absentCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- User Profile Header -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-gradient-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <img src="{{ asset('uploads/user/'.$user->image) }}" alt="{{ $user->name }}"
                             class="rounded-circle border border-3 border-white" width="80" height="80">
                    </div>
                    <div>
                        <h4 class="mb-0">
                            <i class="fas fa-user-circle mr-2"></i> {{ $user->name }}
                        </h4>
                        <p class="mb-0">
                            <i class="fas fa-envelope mr-2"></i> {{ $user->email }}
                            <span class="mx-2">|</span>
                            <i class="fas fa-id-badge mr-2"></i> {{ $user->employee_id ?? 'N/A' }}
                        </p>
                    </div>
                </div>
                <div class="text-end">
                    <span class="badge bg-light text-primary fs-6 p-2">
                        <i class="fas fa-calendar-check mr-1"></i>
                        {{ $totalWorkingDays }} Work Days
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Records -->
    @if($selectedMonth)
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-gradient-info text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        {{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }} Attendance
                    </h5>
                    <div>
                        <span class="badge bg-white text-info fs-6 p-2">
                            <i class="fas fa-clock mr-1"></i>
                            Total Hours: {{ $totalHoursThisMonth ?? '0h 0m' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="datatable-buttons">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">Day</th>
                                <th class="text-center">Check-In</th>
                                <th class="text-center">Check-Out</th>
                                <th class="text-center">Duration</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $startDate = Carbon::parse($selectedMonth)->startOfMonth();
                                $endDate = Carbon::parse($selectedMonth)->endOfMonth();
                                $currentDate = $startDate->copy();

                                // Create a map of existing checkins for easy lookup
                                $checkinMap = [];
                                foreach ($checkins as $entry) {
                                    $date = Carbon::parse($entry->check_in_at ?? $entry->date)->format('Y-m-d');
                                    $checkinMap[$date] = $entry;
                                }
                            @endphp

                            @while($currentDate <= $endDate)
                                @php
                                    $dateKey = $currentDate->format('Y-m-d');
                                    $entry = $checkinMap[$dateKey] ?? null;
                                    $isWeekend = $currentDate->isWeekend();

                                    if ($entry) {
                                        $checkIn = $entry->check_in_at ? Carbon::parse($entry->check_in_at)->timezone('Asia/Karachi') : null;
                                        $checkOut = $entry->check_out_at ? Carbon::parse($entry->check_out_at)->timezone('Asia/Karachi') : null;
                                        $statusClass = $checkIn && $checkOut ? 'success' : ($checkIn ? 'warning' : 'danger');
                                    }
                                @endphp

                                <tr class="@if($isWeekend) table-secondary @endif">
                                    <td class="text-center">{{ $currentDate->format('M d, Y') }}</td>
                                    <td class="text-center">{{ $currentDate->format('D') }}</td>

                                    @if($entry)
                                        <td class="text-center text-success fw-bold">
                                            {{ $checkIn ? $checkIn->format('h:i A') : '--:-- --' }}
                                        </td>
                                        <td class="text-center text-danger fw-bold">
                                            {{ $checkOut ? $checkOut->format('h:i A') : '--:-- --' }}
                                        </td>
                                        <td class="text-center fw-bold">
                                            @if($checkIn && $checkOut)
                                                {{ $checkIn->diff($checkOut)->format('%Hh %Im') }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ $statusClass }}">
                                                @if($checkIn && $checkOut)
                                                    Present
                                                @elseif($checkIn)
                                                    Partial
                                                @else
                                                    Absent
                                                @endif
                                            </span>
                                        </td>
                                    @else
                                        <td class="text-center text-muted">--:-- --</td>
                                        <td class="text-center text-muted">--:-- --</td>
                                        <td class="text-center text-muted">N/A</td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ $isWeekend ? 'secondary' : 'danger' }}">
                                                {{ $isWeekend ? 'Weekend' : 'Absent' }}
                                            </span>
                                        </td>
                                    @endif
                                </tr>

                                @php $currentDate->addDay(); @endphp
                            @endwhile
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">
                            Showing {{ $currentDate->diffInDays($startDate) }} days
                        </small>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <small class="text-muted">
                            Last updated: {{ now()->format('M d, Y h:i A') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Grouped by month -->
        @foreach($checkins as $month => $entries)
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-gradient-info text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-calendar-alt mr-2"></i> {{ $month }}
                        </h5>
                        <div>
                            <span class="badge bg-white text-info fs-6 p-2">
                                <i class="fas fa-clock mr-1"></i>
                                Total Hours: {{ $monthlyHours[$month] ?? '0h 0m' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="datatable-buttons">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Day</th>
                                    <th class="text-center">Check-In</th>
                                    <th class="text-center">Check-Out</th>
                                    <th class="text-center">Duration</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entries as $entry)
                                    @php
                                        $checkIn = $entry->check_in_at ? Carbon::parse($entry->check_in_at)->timezone('Asia/Karachi') : null;
                                        $checkOut = $entry->check_out_at ? Carbon::parse($entry->check_out_at)->timezone('Asia/Karachi') : null;
                                        $isWeekend = $checkIn && $checkIn->isWeekend();
                                        $statusClass = $checkIn && $checkOut ? 'success' : ($checkIn ? 'warning' : 'danger');
                                    @endphp
                                    <tr class="@if($isWeekend) table-secondary @endif">
                                        <td class="text-center">{{ $checkIn ? $checkIn->format('M d, Y') : '—' }}</td>
                                        <td class="text-center">{{ $checkIn ? $checkIn->format('D') : '—' }}</td>
                                        <td class="text-center text-success fw-bold">
                                            {{ $checkIn ? $checkIn->format('h:i A') : '--:-- --' }}
                                        </td>
                                        <td class="text-center text-danger fw-bold">
                                            {{ $checkOut ? $checkOut->format('h:i A') : '--:-- --' }}
                                        </td>
                                        <td class="text-center fw-bold">
                                            @if($checkIn && $checkOut)
                                                {{ $checkIn->diff($checkOut)->format('%Hh %Im') }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ $statusClass }}">
                                                @if($checkIn && $checkOut)
                                                    Present
                                                @elseif($checkIn)
                                                    Partial
                                                @else
                                                    Absent
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">
                                Showing {{ $entries->count() }} records
                            </small>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <small class="text-muted">
                                {{ $month }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable with export buttons
        $('#datatable-buttons').DataTable({
            dom: '<"top"Bf>rt<"bottom"lip><"clear">',
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn btn-sm btn-outline-secondary',
                    text: '<i class="fas fa-copy mr-1"></i> Copy'
                },
                {
                    extend: 'csv',
                    className: 'btn btn-sm btn-outline-primary',
                    text: '<i class="fas fa-file-csv mr-1"></i> CSV'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-sm btn-outline-success',
                    text: '<i class="fas fa-file-excel mr-1"></i> Excel'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-sm btn-outline-danger',
                    text: '<i class="fas fa-file-pdf mr-1"></i> PDF'
                },
                {
                    extend: 'print',
                    className: 'btn btn-sm btn-outline-info',
                    text: '<i class="fas fa-print mr-1"></i> Print'
                }
            ],
            responsive: true,
            order: [[0, 'desc']],
            pageLength: 25,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records...",
            }
        });

        // Auto-select current month if no month is selected
        if(!$('#month').val()) {
            const now = new Date();
            const month = now.getFullYear() + '-' + String(now.getMonth() + 1).padStart(2, '0');
            $('#month').val(month);
        }
    });
</script>
@endsection
