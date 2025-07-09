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
