@extends('layouts.adminBase')

@section('content')
        <!-- Sidebar Start -->
@include('admin.includes.sidebar')
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('admin.includes.navbar')
            <!-- Navbar End -->

            <div class="container-fluid py-4">
                <div class="row justify-content-center">
                <div class="col-lg-11">
                        <div class="card border-0 shadow-lg rounded-4">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h4 class="fw-bold mb-0"><i class="fas fa-info-circle me-2"></i>About/Company Content Management</h4>
                            <a href="{{ route('slides') }}" class="btn btn-light btn-sm">Manage Landing Images</a>
                            </div>
            
                            <div class="card-body p-4">
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session()->get('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session()->get('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('saveAbout') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
            
                                <!-- Bootstrap Tabs -->
                                <ul class="nav nav-tabs mb-4" id="aboutTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab">Basic Info</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="identity-tab" data-bs-toggle="tab" data-bs-target="#identity" type="button" role="tab">Company Identity</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="streams-tab" data-bs-toggle="tab" data-bs-target="#streams" type="button" role="tab">Education Streams</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="experience-tab" data-bs-toggle="tab" data-bs-target="#experience" type="button" role="tab">Experience & Achievements</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab">Contact Info</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab">Images</button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="aboutTabsContent">
                                    <!-- Basic Info Tab -->
                                    <div class="tab-pane fade show active" id="basic" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Title</label>
                                                <input type="text" class="form-control" name="title" value="{{ $data->title ?? '' }}">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Subtitle</label>
                                                <input type="text" class="form-control" name="subTitle" value="{{ $data->subTitle ?? '' }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">About Us Content</label>
                                                <textarea class="form-control" name="aboutus" rows="10">{{ $data->aboutus ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Our Values</label>
                                                <textarea class="form-control" name="values" rows="10">{{ $data->values ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Company Identity Tab -->
                                    <div class="tab-pane fade" id="identity" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Company Identity Points (JSON Array)</label>
                                                <textarea class="form-control" name="company_identity" rows="10">{{ is_array($data->company_identity ?? null) ? json_encode($data->company_identity, JSON_PRETTY_PRINT) : ($data->company_identity ?? '[]') }}</textarea>
                                                <small class="text-muted">Format: ["A for-profit educational initiative", "Rooted in Christian values", "Focused on multilingual and multicultural excellence", "Designed for African realities with global standards"]</small>
                                            </div>
                                            </div>
                                        </div>
            
                                    <!-- Education Streams Tab -->
                                    <div class="tab-pane fade" id="streams" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Streams Title</label>
                                                <input type="text" class="form-control" name="streams_title" value="{{ $data->streams_title ?? '' }}" placeholder="e.g., Our Education Streams">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Education Streams (JSON Array)</label>
                                                <textarea class="form-control" name="education_streams" rows="15">{{ is_array($data->education_streams ?? null) ? json_encode($data->education_streams, JSON_PRETTY_PRINT) : ($data->education_streams ?? '[]') }}</textarea>
                                                <small class="text-muted">Format: [{"name": "University Stream", "description": "Focusing on higher education..."}, {"name": "Book Industry Stream", "description": "Dedicated to educational publishing..."}, ...]</small>
                                            </div>
                                        </div>
                                    </div>
            
                                    <!-- Experience & Achievements Tab -->
                                    <div class="tab-pane fade" id="experience" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Experience Title</label>
                                                <input type="text" class="form-control" name="experience_title" value="{{ $data->experience_title ?? '' }}" placeholder="e.g., Experience & Achievements in Higher Education">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Experience Content</label>
                                                <textarea class="form-control" name="experience_content" rows="12">{{ $data->experience_content ?? '' }}</textarea>
                                                <small class="text-muted">This is the main content describing your experience and achievements.</small>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Key Achievements (JSON Array)</label>
                                                <textarea class="form-control" name="achievements" rows="8">{{ is_array($data->achievements ?? null) ? json_encode($data->achievements, JSON_PRETTY_PRINT) : ($data->achievements ?? '[]') }}</textarea>
                                                <small class="text-muted">Format: ["Achievement 1", "Achievement 2", ...] or [{"title": "Achievement 1", "description": "..."}, ...]</small>
                                            </div>
                                            </div>
                                        </div>
            
                                    <!-- Contact Info Tab -->
                                    <div class="tab-pane fade" id="contact" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Phone 1</label>
                                                <input type="text" class="form-control" name="phone_1" value="{{ $data->phone_1 ?? '' }}" placeholder="e.g., +250781791424">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Phone 2</label>
                                                <input type="text" class="form-control" name="phone_2" value="{{ $data->phone_2 ?? '' }}" placeholder="e.g., +254715475270">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Phone 3</label>
                                                <input type="text" class="form-control" name="phone_3" value="{{ $data->phone_3 ?? '' }}" placeholder="e.g., +254112684191">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Phone 4</label>
                                                <input type="text" class="form-control" name="phone_4" value="{{ $data->phone_4 ?? '' }}" placeholder="e.g., +254721957842">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Website</label>
                                                <input type="text" class="form-control" name="website" value="{{ $data->website ?? '' }}" placeholder="e.g., https://lacfontaine.org">
                                            </div>
                                        </div>
                                    </div>
            
                                    <!-- Images Tab -->
                                    <div class="tab-pane fade" id="images" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label fw-bold">Header Image (Founder Image)</label>
                                                @if($data->headerImage)
                                                    <div class="mb-3">
                                                        <img src="{{ asset('storage/images/about') . $data->headerImage }}" class="img-fluid rounded shadow-sm" style="max-width: 300px;">
                                                    </div>
                                                @endif
                                                <input type="file" name="headerImage" class="form-control">
                                                <small class="text-muted">Recommended size: 800x600px</small>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <label class="form-label fw-bold">Background Image (Middle)</label>
                                                @if($data->backImage)
                                                    <div class="mb-3">
                                                        <img src="{{ asset('storage/images/about') . $data->backImage }}" class="img-fluid rounded shadow-sm" style="max-width: 300px;">
                                                    </div>
                                                @endif
                                                <input type="file" name="backImage" class="form-control">
                                                <small class="text-muted">Recommended size: 1920x600px</small>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <label class="form-label fw-bold">Back Image Text (Home Bottom Image)</label>
                                                @if($data->backImageText)
                                                    <div class="mb-3">
                                                        <img src="{{ asset('storage/images/about') . $data->backImageText }}" class="img-fluid rounded shadow-sm" style="max-width: 300px;">
                                                    </div>
                                                @endif
                                                <input type="file" name="backImageText" class="form-control">
                                                <small class="text-muted">Recommended size: 1200x400px</small>
                                            </div>
                                        </div>
            
                                        <!-- Vision & Mission in Images Tab -->
                                        <div class="row mt-4 pt-4 border-top">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Vision</label>
                                                <textarea class="form-control" name="vision" rows="6">{{ $data->vision ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Mission</label>
                                                <textarea class="form-control" name="mission" rows="6">{{ $data->mission ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
            
                                <div class="form-actions mt-4 pt-3 border-top">
                                    <button type="submit" class="btn btn-primary btn-lg admin-save-btn">
                                        <i class="fa fa-save me-2"></i>Save All Changes
                                    </button>
                                    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary btn-lg admin-preview-btn">
                                        <i class="fa fa-eye me-2"></i>Preview Website
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->

    <!-- Custom Hover Styles for Admin Page -->
    <style>
        /* Admin Tab Navigation Hover */
        #aboutTabs .nav-link:hover {
            background-color: #0d68bf !important;
            color: #fff !important;
            border-color: #0d68bf !important;
            transition: all 0.3s ease;
        }
        
        #aboutTabs .nav-link.active {
            background-color: #0d68bf !important;
            color: #fff !important;
            border-color: #0d68bf !important;
        }

        /* Admin Save Button Hover */
        .admin-save-btn:hover {
            background-color: #1e8113 !important;
            border-color: #1e8113 !important;
            color: #fff !important;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        /* Admin Preview Button Hover */
        .admin-preview-btn:hover {
            background-color: #0d68bf !important;
            border-color: #0d68bf !important;
            color: #fff !important;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        /* Manage Landing Images Button */
        .btn-light:hover {
            background-color: #0d68bf !important;
            border-color: #0d68bf !important;
            color: #fff !important;
            transition: all 0.3s ease;
        }
    </style>

    @include('admin.includes.footer')
@endsection
