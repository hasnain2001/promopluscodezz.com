@extends('layouts.welcome')
@section('title', 'Privacy Policy')
@section('description', 'Read our privacy policy to understand how we handle your data and protect your privacy.')
@section('keywords', 'privacy, policy, data protection')
@section('author', 'John Doe')
@section('main')
<div class="container py-1">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header with Gradient Background -->
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold text-gradient-primary mb-3">Privacy Policy</h1>
                <p class="lead text-muted">Last updated on {{ now()->format('F d, Y') }}</p>
            </div>

            <!-- Main Policy Card -->
            <div class="card border-0 shadow-lg overflow-hidden">
                <!-- Decorative Header -->
                <div class="card-header bg-gradient-primary py-2  text-dark">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-shield-alt fa-3x me-4"></i>
                        <h2 class="h3 mb-0 ">Your Data Protection</h2>
                    </div>
                </div>

                <!-- Policy Content -->
                <div class="card-body p-4 p-md-5">
                    <div class="alert alert-info bg-soft-info border-0 mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        This policy explains how we collect, use, and protect your information.
                    </div>

                    <!-- Policy Sections -->
                    <div class="privacy-content">
                        <!-- Section with Icon -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-lg bg-soft-primary rounded-circle me-3">
                                    <i class="fas fa-database text-primary"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-0">Information We Collect</h3>
                            </div>
                            <p class="ps-5">We may collect personal information such as your name, email address, and contact details when you interact with our website. This includes information provided when filling out forms, subscribing to newsletters, or making inquiries.</p>
                        </div>

                        <!-- Section with Icon -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-lg bg-soft-success rounded-circle me-3">
                                    <i class="fas fa-cogs text-success"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-0">How We Use Your Information</h3>
                            </div>
                            <ul class="ps-5">
                                <li class="mb-2">To respond to your inquiries and provide customer support.</li>
                                <li class="mb-2">To process transactions and deliver services.</li>
                                <li>To improve our website and services based on your feedback.</li>
                            </ul>
                            <p class="ps-5 mt-2">We <strong>do not sell</strong> your personal information to third parties.</p>
                        </div>

                        <!-- Section with Icon -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-lg bg-soft-warning rounded-circle me-3">
                                    <i class="fas fa-lock text-warning"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-0">Data Security</h3>
                            </div>
                            <p class="ps-5">We implement industry-standard security measures including encryption, secure servers, and access controls to protect your data. However, no method of transmission over the internet is 100% secure, and we recommend taking additional precautions when sharing sensitive information.</p>
                        </div>

                        <!-- Section with Icon -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-lg bg-soft-info rounded-circle me-3">
                                    <i class="fas fa-cookie-bite text-info"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-0">Cookies & Tracking</h3>
                            </div>
                            <p class="ps-5">We use cookies to enhance your browsing experience. You can manage cookie preferences in your browser settings. Essential cookies are required for the website to function properly.</p>
                        </div>

                        <!-- Section with Icon -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-lg bg-soft-danger rounded-circle me-3">
                                    <i class="fas fa-external-link-alt text-danger"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-0">Third-Party Links</h3>
                            </div>
                            <p class="ps-5">Our website may contain links to external sites. We are not responsible for their privacy practices. We recommend reviewing their policies before providing any personal information.</p>
                        </div>

                        <!-- Section with Icon -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-lg bg-soft-secondary rounded-circle me-3">
                                    <i class="fas fa-sync-alt text-secondary"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-0">Policy Updates</h3>
                            </div>
                            <p class="ps-5">We may update this policy periodically. Significant changes will be notified via email or a website notice. The "Last Updated" date at the top reflects the latest revision.</p>
                        </div>

                        <!-- Contact Section -->
                        <div class="bg-light p-4 rounded-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-lg bg-soft-primary rounded-circle me-3">
                                    <i class="fas fa-envelope text-primary"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-0">Contact Us</h3>
                            </div>
                            <p class="ps-5 mb-0">For questions about this policy, email us at <a href="mailto:privacy@example.com" class="text-primary">privacy@example.com</a> or write to our Data Protection Officer at 123 Privacy Lane, Data City.</p>
                        </div>
                    </div>

                    <!-- Back to Home Button -->
                    <div class="text-center mt-5">
                        <a href="{{ url(app()->getLocale() . '/') }}" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-arrow-left me-2"></i> Return to Homepage
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>
@endpush
