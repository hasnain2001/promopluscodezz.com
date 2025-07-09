@extends('employee.layouts.app')
@section('title', 'Employee Dashboard')
@section('styles')
<style>
    .hover-effect:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .hover-effect {
        transition: all 0.3s ease;
    }
</style>
@endsection
@section('content')
<!-- ============================================================== -->
<!-- Page content -->
<!-- ============================================================== -->
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">Employee Dashboard</h1>
                <div class="dropdown">
                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> Menu
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                               <button type="submit" class="dropdown-item" style="border: none; background: none; cursor: pointer;">Logout</button>
                            </form>
                            </li>
                    </ul>
                </div>
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
        <div class="card-body">
            <div class="alert alert-success">
                <h4 class="alert-heading">Welcome back, {{ Auth::user()->name }}!</h4>
                <p>You're logged in to your employee dashboard.</p>
            </div>

            <div class="row mt-4">
                <!-- Profile Card -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-person-fill text-primary fs-2"></i>
                                </div>
                                <div>
                                    <h5 class="card-title mb-1">Your Profile</h5>
                                    <p class="card-text text-muted mb-0">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Time Tracking Card -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-clock text-success fs-2"></i>
                                </div>
                                <div>
                                    <h5 class="card-title mb-1">Time Tracking</h5>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted">Start Time: <span id="startTime">{{ now()->setTimezone('Asia/Karachi')->format('h:i A') }}</span></small>
                                        <small class="text-muted">Online Duration: <span id="onlineTime">00:00:00</span></small>
                                        <small class="text-muted">Status: <span class="badge bg-success">Online</span></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Schedule Card -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Today's Schedule</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-clock-history text-info fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Working Hours</h6>
                                    <p class="mb-0 text-muted">10:30 AM - 6:30 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-hourglass-split text-warning fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Break Time</h6>
                                    <p class="mb-0 text-muted">1:00 PM - 2:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Time Progress -->
                    <div class="mt-3">
                        <h6>Today's Progress</h6>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                 role="progressbar"
                                 id="workProgress"
                                 style="width: 0%"
                                 aria-valuenow="0"
                                 aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted" id="progressText">0% of workday completed</small>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                {{-- <button class="btn btn-primary me-md-2" type="button" id="checkInBtn">
                    <i class="bi bi-check-circle"></i> Check In
                </button> --}}
                <livewire:check-in />



            </div>
        </div>

        <div class="card-footer bg-light">
            <small class="text-muted">Last login: {{ Auth::user()->last_login_at ? Auth::user()->last_login_at->diffForHumans() : 'First login' }}</small>
        </div>

    </div>
</div>
<livewire:task-manager />
<h2 class="text-2xl font-bold mb-4 text-dark">Start a Conversation</h2>
<div class="list-group">
    @foreach ($users as $user)
        <a href="{{ route('chat', $user->id) }}" class="list-group-item list-group-item-action d-flex align-items-center p-3 mb-2 rounded hover-effect">
            <div class="flex-shrink-0">
                @if ($user->image)
                    <img src="{{ asset('uploads/user/' . $user->image) }}" alt="{{ $user->name }}" class="rounded-circle me-3" width="50" height="50">
                @else
                    <img src="{{ asset('assets/images/users/user-5.jpg') }}" alt="{{ $user->name }}" class="rounded-circle me-3" width="50" height="50">
                @endif
            </div>
            <div class="flex-grow-1">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 me-2">{{ $user->name }}</h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary">{{ $user->role }}</span>
                </div>
                <small class="text-muted">Click to start chatting</small>
            </div>
            <div class="flex-shrink-0 text-primary">
                <i class="bi bi-chevron-right"></i>
            </div>
        </a>
    @endforeach
</div>



<!-- ============================================================== -->
<!-- End Page content -->


<!-- Toast Notification (hidden by default) -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="checkInToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <strong class="me-auto">Success</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Check-in recorded at <span id="toastTime"></span>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
    // Online time counter
    let startTime = new Date();
    let onlineTimeElement = document.getElementById('onlineTime');

    function updateOnlineTime() {
        let now = new Date();
        let diff = now - startTime;

        let hours = Math.floor(diff / (1000 * 60 * 60));
        let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((diff % (1000 * 60)) / 1000);

        onlineTimeElement.textContent =
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }

    setInterval(updateOnlineTime, 1000);

    // Workday progress calculation
    function updateWorkProgress() {
        const workStart = 8; // 8 AM
        const workEnd = 17; // 5 PM
        const now = new Date();
        const currentHour = now.getHours() + (now.getMinutes() / 60);

        if (currentHour < workStart) {
            document.getElementById('workProgress').style.width = '0%';
            document.getElementById('progressText').textContent = 'Workday not started yet';
        } else if (currentHour > workEnd) {
            document.getElementById('workProgress').style.width = '100%';
            document.getElementById('progressText').textContent = 'Workday completed';
        } else {
            const totalHours = workEnd - workStart;
            const completedHours = currentHour - workStart;
            const progress = (completedHours / totalHours) * 100;

            document.getElementById('workProgress').style.width = `${progress}%`;
            document.getElementById('progressText').textContent =
                `${Math.round(progress)}% of workday completed`;
        }
    }

    updateWorkProgress();
    setInterval(updateWorkProgress, 60000); // Update every minute

    // Check-in functionality
    document.getElementById('checkInBtn').addEventListener('click', function() {
        const now = new Date();
        const formattedTime = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });

        // In a real app, you would send this to your backend
        document.getElementById('startTime').textContent = formattedTime;
        startTime = now; // Reset online timer

        // Show toast notification
        const toast = new bootstrap.Toast(document.getElementById('checkInToast'));
        toast.show();
    });
</script>
@endsection
