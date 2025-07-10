@extends('layouts.welcome')
@section('title', 'Imprint')
@section('description', 'Get in touch with us for any inquiries or support.')
@section('keywords', 'imprint, support, inquiries')
@section('author', 'John Doe')
@section('main')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center rounded-top-4 py-4">
                    <h1 class="h3 mb-0"><i class="fas fa-info-circle me-2"></i>Imprint</h1>
                </div>
                <div class="card-body px-4 py-2">
                    <p class="text-muted text-center mb-5">Here you can find our company details and legal information.</p>

                    <div class="mb-4">
                        <h5 class="fw-semibold text-dark"><i class="fas fa-building me-2"></i></h5>
                        <p class="mb-0">Example Company Ltd.</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-semibold text-dark"><i class="fas fa-map-marker-alt me-2"></i>Address</h5>
                        <p class="mb-0">3000 Hoffman Dr, Plano, Tx USA</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-semibold text-dark"><i class="fas fa-envelope me-2"></i>Contact Information</h5>
                        <p class="mb-1">Email: <a href="mailto:contactcut2coupon@gmail.com" class="text-decoration-none">contactcut2coupon@gmail.com</a></p>
                        <p class="mb-0">Phone: +123 456 7890</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-semibold text-dark"><i class="fas fa-briefcase me-2"></i>Legal Information</h5>
                        <p class="mb-1">Managing Director: John Doe</p>
                        <p class="mb-1">Commercial Register: Example City, HRB 123456</p>
                        <p class="mb-0">VAT ID: DE123456789</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-semibold text-dark"><i class="fas fa-exclamation-circle me-2"></i>Disclaimer</h5>
                        <p class="mb-0">The information provided on this website is for general informational purposes only. We make no warranties about the completeness, reliability, or accuracy of this information. Any action taken based on the information is strictly at your own risk.</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-semibold text-dark"><i class="fas fa-copyright me-2"></i>Copyright</h5>
                        <p class="mb-0">© 2023 Example Company Ltd. All rights reserved.</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-semibold text-dark"><i class="fas fa-link me-2"></i>Links to Other Websites</h5>
                        <p class="mb-0">Our website may contain links to external websites. We have no control over the content of those sites and do not necessarily endorse their views.</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-semibold text-dark"><i class="fas fa-sync-alt me-2"></i>Changes to This Imprint</h5>
                        <p class="mb-0">We reserve the right to update or change our imprint at any time. Updates will be posted on this page with an updated effective date.</p>
                    </div>

                    <div class="text-center mt-5">
                        <a href="{{ url(app()->getLocale() . '/') }}" class="btn btn-outline-primary px-4">
                            <i class="fas fa-home me-2"></i>Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
