@extends('admin.layouts.app')
@section('title', 'Create User')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Create New User</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.user.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                                <label for="name">Full Name</label>
                                <div class="invalid-feedback">
                                    Please provide a valid name.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                                <label for="email">Email Address</label>
                                <div class="invalid-feedback">
                                    Please provide a valid email.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating position-relative">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <label for="password">Password</label>
                                <div class="invalid-feedback">
                                    Please provide a password.
                                </div>
                                <span class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                    <i class="fas fa-eye-slash toggle-password" onclick="togglePassword('password')"></i>
                                </span>
                            </div>
                            <div class="form-text">Minimum 8 characters</div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating position-relative">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="invalid-feedback">
                                    Passwords must match.
                                </div>
                                <span class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                    <i class="fas fa-eye-slash toggle-password" onclick="togglePassword('password_confirmation')"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <select class="form-select" id="role" name="role" required>
                                    <option value="" disabled selected>Select Role</option>
                                    <option value="admin">Administrator</option>
                                    <option value="employee">Employee</option>
                                    <option value="user">Standard User</option>
                                </select>
                                <label for="role">User Role</label>
                                <div class="invalid-feedback">
                                    Please select a role.
                                </div>
                            </div>
                            <div class="form-text">Choose the appropriate access level</div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-arrow-left me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-user-plus me-1"></i> Create User
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Password visibility toggle
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.nextElementSibling.querySelector('i');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    }
}

// Form validation
(function () {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>
@endsection

@section('styles')
<style>
.card {
    border-radius: 10px;
    overflow: hidden;
}
.card-header {
    padding: 1.5rem;
}
.form-floating {
    margin-bottom: 1rem;
}
.toggle-password {
    cursor: pointer;
    color: #6c757d;
}
.toggle-password:hover {
    color: #0d6efd;
}
</style>
@endsection
