@extends('layouts.frontbase')

@section('content')

<!-- Page Header -->
<section class="py-5 bg-primary text-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Contact Us</h1>
                <p class="lead">Get in touch with us. We'd love to hear from you!</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mb-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <h2 class="mb-4">Send us a Message</h2>
                        
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('full_name') is-invalid @enderror" 
                                           id="full_name" 
                                           name="full_name" 
                                           value="{{ old('full_name') }}" 
                                           required>
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('subject') is-invalid @enderror" 
                                       id="subject" 
                                       name="subject" 
                                       value="{{ old('subject') }}" 
                                       required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror" 
                                          id="message" 
                                          name="message" 
                                          rows="6" 
                                          required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg px-5 py-3">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4">Contact Information</h5>
                        @if($setting)
                            <!-- Phone Numbers with Call and WhatsApp Icons -->
                            <div class="mb-4">
                                <strong class="d-block mb-3"><i class="fas fa-phone text-primary me-2"></i>Phone Numbers</strong>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="me-3" style="min-width: 150px; font-weight: 500;">+250781791424</span>
                                        <a href="tel:+250781791424" class="btn btn-sm btn-outline-primary me-2" title="Call" style="padding: 4px 10px;">
                                            <i class="fa fa-phone-alt"></i>
                                        </a>
                                        <a href="https://wa.me/250781791424" target="_blank" class="btn btn-sm btn-outline-primary" title="WhatsApp" style="padding: 4px 10px;">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="me-3" style="min-width: 150px; font-weight: 500;">+254715475270</span>
                                        <a href="tel:+254715475270" class="btn btn-sm btn-outline-primary me-2" title="Call" style="padding: 4px 10px;">
                                            <i class="fa fa-phone-alt"></i>
                                        </a>
                                        <a href="https://wa.me/254715475270" target="_blank" class="btn btn-sm btn-outline-primary" title="WhatsApp" style="padding: 4px 10px;">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="me-3" style="min-width: 150px; font-weight: 500;">+254112684191</span>
                                        <a href="tel:+254112684191" class="btn btn-sm btn-outline-primary me-2" title="Call" style="padding: 4px 10px;">
                                            <i class="fa fa-phone-alt"></i>
                                        </a>
                                        <a href="https://wa.me/254112684191" target="_blank" class="btn btn-sm btn-outline-primary" title="WhatsApp" style="padding: 4px 10px;">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="me-3" style="min-width: 150px; font-weight: 500;">+254721957842</span>
                                        <a href="tel:+254721957842" class="btn btn-sm btn-outline-primary me-2" title="Call" style="padding: 4px 10px;">
                                            <i class="fa fa-phone-alt"></i>
                                        </a>
                                        <a href="https://wa.me/254721957842" target="_blank" class="btn btn-sm btn-outline-primary" title="WhatsApp" style="padding: 4px 10px;">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            @if($setting->email)
                            <div class="mb-4">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                <strong>Email:</strong>
                                <p class="mb-0 mt-1">
                                    <a href="mailto:{{ $setting->email }}" class="text-decoration-none">{{ $setting->email }}</a>
                                </p>
                            </div>
                            @endif
                            @if($setting->website)
                            <div class="mb-4">
                                <i class="fas fa-globe text-primary me-2"></i>
                                <strong>Website:</strong>
                                <p class="mb-0 mt-1">
                                    <a href="{{ $setting->website }}" target="_blank" class="text-decoration-none">{{ $setting->website }}</a>
                                </p>
                            </div>
                            @endif
                        @endif
                        
                        <div class="mt-4">
                            <h6 class="mb-3">Follow Us</h6>
                            <div class="d-flex gap-2">
                                @if($setting && $setting->facebook)
                                <a href="{{ $setting->facebook }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                @endif
                                @if($setting && $setting->twitter)
                                <a href="{{ $setting->twitter }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                @endif
                                @if($setting && $setting->instagram)
                                <a href="{{ $setting->instagram }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                @endif
                                @if($setting && $setting->linkedin)
                                <a href="{{ $setting->linkedin }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
@include('front.includes.cta')

<style>
    @media (max-width: 768px) {
        .contact-info .d-flex.align-items-center {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .contact-info .d-flex.align-items-center span {
            margin-bottom: 8px;
            min-width: auto !important;
        }
    }
</style>

@endsection
