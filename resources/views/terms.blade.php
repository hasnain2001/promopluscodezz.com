@extends('layouts.welcome')
@section('title', 'Terms and Conditions | ' . config('app.name'))
@section('description', 'Read our terms and conditions to understand your rights and responsibilities while using our services.')
@section('keywords', 'terms, conditions, user agreement')
@section('author', 'John Doe')
@section('main')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-primary text-white text-center py-2">
                    <div class="icon-lg bg-white bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h1 class="h2 mb-2 fw-bold">Terms and Conditions</h1>
                    <p class="mb-0 opacity-75">Last updated: {{ date('F j, Y') }}</p>
                </div>
                <div class="card-body px-lg-5 py-4">
                    <div class="alert alert-info bg-light-primary border-0 mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle me-3 fs-4 text-primary"></i>
                            <p class="mb-0">By accessing or using our services, you agree to be bound by these terms. Please read them carefully.</p>
                        </div>
                    </div>

                    <div class="terms-content">
                        <section class="term-section mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h2 class="h4 mb-0 fw-bold">1. Acceptance of Terms</h2>
                            </div>
                            <div class="ps-5">
                                <p>By accessing or using our website or services, you confirm that you have read, understood, and agree to be bound by these Terms and Conditions. If you do not agree with any part of these terms, you must not use our services.</p>
                            </div>
                        </section>

                        <section class="term-section mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-user-lock"></i>
                                </div>
                                <h2 class="h4 mb-0 fw-bold">2. User Responsibilities</h2>
                            </div>
                            <div class="ps-5">
                                <p>You are solely responsible for:</p>
                                <ul class="list-styled">
                                    <li>Maintaining the confidentiality of your account credentials</li>
                                    <li>All activities that occur under your account</li>
                                    <li>Providing accurate and current information</li>
                                    <li>Complying with all applicable laws and regulations</li>
                                </ul>
                                <p>You agree to notify us immediately of any unauthorized access to or use of your account.</p>
                            </div>
                        </section>

                        <section class="term-section mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-ban"></i>
                                </div>
                                <h2 class="h4 mb-0 fw-bold">3. Prohibited Activities</h2>
                            </div>
                            <div class="ps-5">
                                <p>When using our services, you must not:</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-hover border-0 mb-3">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <i class="fas fa-exclamation-triangle text-danger me-3 mt-1"></i>
                                                    <div>
                                                        <h5 class="h6 mb-1">Illegal Activities</h5>
                                                        <p class="small mb-0">Use our services for any unlawful purpose</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-hover border-0 mb-3">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <i class="fas fa-user-secret text-danger me-3 mt-1"></i>
                                                    <div>
                                                        <h5 class="h6 mb-1">Unauthorized Access</h5>
                                                        <p class="small mb-0">Attempt to gain unauthorized system access</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-hover border-0 mb-3">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <i class="fas fa-bug text-danger me-3 mt-1"></i>
                                                    <div>
                                                        <h5 class="h6 mb-1">Harmful Content</h5>
                                                        <p class="small mb-0">Post harmful, offensive, or infringing content</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-hover border-0 mb-3">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <i class="fas fa-network-wired text-danger me-3 mt-1"></i>
                                                    <div>
                                                        <h5 class="h6 mb-1">Service Disruption</h5>
                                                        <p class="small mb-0">Disrupt or interfere with service performance</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="term-section mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h2 class="h4 mb-0 fw-bold">4. Intellectual Property</h2>
                            </div>
                            <div class="ps-5">
                                <p>All content, features, and functionality on our platform, including text, graphics, logos, and software, are the exclusive property of {{ config('app.name') }} and are protected by international copyright, trademark, and other intellectual property laws.</p>
                                <div class="alert alert-light border mt-3">
                                    <p class="mb-0"><i class="fas fa-lightbulb text-warning me-2"></i> You may not reproduce, distribute, or create derivative works without our express written permission.</p>
                                </div>
                            </div>
                        </section>

                        <section class="term-section mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <h2 class="h4 mb-0 fw-bold">5. Disclaimer of Warranties</h2>
                            </div>
                            <div class="ps-5">
                                <div class="card border-danger bg-light-danger">
                                    <div class="card-body">
                                        <p class="mb-0"><i class="fas fa-info-circle me-2"></i> Our services are provided "as is" and "as available" without warranties of any kind. We do not guarantee that our services will be uninterrupted, secure, or error-free. Your use of our services is at your sole risk.</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="term-section mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-hand-paper"></i>
                                </div>
                                <h2 class="h4 mb-0 fw-bold">6. Limitation of Liability</h2>
                            </div>
                            <div class="ps-5">
                                <p>To the maximum extent permitted by law, {{ config('app.name') }} shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses.</p>
                                <div class="bg-light rounded p-3 mt-3">
                                    <h5 class="h6 mb-2 fw-semibold">In no event shall our total liability exceed:</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 me-3">
                                            <i class="fas fa-dollar-sign me-1"></i>100
                                        </div>
                                        <span class="small">or the amount you paid us in the last 12 months, whichever is greater.</span>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="term-section mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-globe-americas"></i>
                                </div>
                                <h2 class="h4 mb-0 fw-bold">7. Governing Law</h2>
                            </div>
                            <div class="ps-5">
                                <p>These Terms shall be governed by and construed in accordance with the laws of [Your Country/State], without regard to its conflict of law provisions.</p>
                                <div class="d-flex align-items-start bg-light-primary rounded p-3 mt-3">
                                    <i class="fas fa-gavel text-primary mt-1 me-3"></i>
                                    <div>
                                        <p class="mb-0 small">Any legal suit, action, or proceeding arising out of or related to these Terms shall be instituted exclusively in the courts located in [Your Jurisdiction].</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="term-section mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-sync-alt"></i>
                                </div>
                                <h2 class="h4 mb-0 fw-bold">8. Changes to Terms</h2>
                            </div>
                            <div class="ps-5">
                                <div class="card border-warning bg-light-warning">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <i class="fas fa-bell text-warning me-3 mt-1"></i>
                                            <div>
                                                <p class="mb-1 fw-semibold">We may modify these Terms at any time.</p>
                                                <p class="mb-0 small">When we do, we will revise the "last updated" date at the top of this page. Your continued use of our services after such modifications constitutes your acceptance of the new Terms.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="term-section">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-md bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h2 class="h4 mb-0 fw-bold">9. Contact Us</h2>
                            </div>
                            <div class="ps-5">
                                <p>For questions about these Terms, please contact us:</p>
                                <div class="d-flex flex-wrap gap-3">
                                    <a href="mailto:legal@example.com" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-envelope me-2"></i>Email Us
                                    </a>
                                    <a href="{{ url('contact') }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-phone-alt me-2"></i>Contact Form
                                    </a>
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-map-marker-alt me-2"></i>Our Office
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="text-center mt-5 pt-3 border-top">
                        <a href="{{ url(app()->getLocale() . '/') }}" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-home me-2"></i>Back to Homepage
                        </a>
                        <button onclick="window.print()" class="btn btn-outline-secondary px-4 py-2 ms-2">
                            <i class="fas fa-print me-2"></i>Print Terms
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card-header.bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }

    .icon-lg {
        width: 60px;
        height: 60px;
    }

    .icon-md {
        width: 40px;
        height: 40px;
    }

    .term-section {
        position: relative;
        padding-left: 15px;
    }

    .term-section:before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, #4e73df, #224abe);
        border-radius: 3px;
    }

    .list-styled {
        list-style: none;
        padding-left: 0;
    }

    .list-styled li {
        position: relative;
        padding-left: 25px;
        margin-bottom: 10px;
    }

    .list-styled li:before {
        content: "•";
        color: #4e73df;
        font-size: 1.5rem;
        position: absolute;
        left: 0;
        top: -5px;
    }

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }

    @media print {
        .btn, .alert {
            display: none !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth scrolling to all sections
        document.querySelectorAll('.term-section h2').forEach(heading => {
            heading.style.cursor = 'pointer';
            heading.addEventListener('click', function() {
                this.parentElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });

        // Print button functionality
        document.querySelector('[onclick="window.print()"]').addEventListener('click', function() {
            window.print();
        });
    });
</script>
@endpush
