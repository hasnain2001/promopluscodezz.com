@extends('layouts.welcome')

@section('title', 'Contact Us')
@section('description', 'Get in touch with us for any inquiries or support.')
@section('keywords', 'contact, support, inquiries')
@section('author', 'john doe')

@push('styles')

@endpush

@section('main')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card contact-card border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h1 class="h3 mb-0 text-center">@lang('contact.h1')</h1>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted text-center mb-4">@lang('contact.p1')</p>

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="name" class="form-label">@lang('contact.Name')</label>
                                <input type="text" class="form-control py-2" id="name" name="name" required placeholder="@lang('contact.Your name')">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">@lang('contact.Email')</label>
                                <input type="email" class="form-control py-2" id="email" name="email" required placeholder="your.email@example.com">
                            </div>
                        </div>

                       <div class="mb-4">
                            <label for="message" class="form-label">@lang('contact.Message')</label>
                            <textarea class="form-control py-2" id="message" name="message" rows="5" required placeholder="@lang('contact.Your name')"></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-submit btn-lg text-white py-2">
                                <i class="fas fa-paper-plane me-2"></i> @lang('contact.Send Message')
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marker-alt text-primary mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">@lang('contact.Our Location')</h5>
                            <p class="card-text text-muted">123 Main Street, City, Country</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-phone-alt text-primary mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">@lang('contact.Call Us')</h5>
                            <p class="card-text text-muted">+1 (123) 456-7890</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">@lang('contact.email us')</h5>
                            <p class="card-text text-muted">info@example.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


