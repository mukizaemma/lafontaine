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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0"><i class="fas fa-home me-2"></i>Homepage Content Management</h3>
                        </div>
                        <div class="card-body">
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

                            <form action="{{ route('saveHome') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                
                                <!-- Bootstrap Tabs -->
                                <ul class="nav nav-tabs mb-4" id="contentTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="hero-tab" data-bs-toggle="tab" data-bs-target="#hero" type="button" role="tab">Hero Section</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab">About French Stream</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="vision-mission-tab" data-bs-toggle="tab" data-bs-target="#vision-mission" type="button" role="tab">Vision & Mission</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="why-french-tab" data-bs-toggle="tab" data-bs-target="#why-french" type="button" role="tab">Why French</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="linguistic-tab" data-bs-toggle="tab" data-bs-target="#linguistic" type="button" role="tab">Linguistic Offer</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="methodology-tab" data-bs-toggle="tab" data-bs-target="#methodology" type="button" role="tab">Methodology</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="impact-tab" data-bs-toggle="tab" data-bs-target="#impact" type="button" role="tab">Impact</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="sustainability-tab" data-bs-toggle="tab" data-bs-target="#sustainability" type="button" role="tab">Sustainability</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="partnership-tab" data-bs-toggle="tab" data-bs-target="#partnership" type="button" role="tab">Partnership</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="legacy-tab" data-bs-toggle="tab" data-bs-target="#legacy" type="button" role="tab">Legacy Fields</button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="contentTabsContent">
                                    <!-- Hero Section Tab -->
                                    <div class="tab-pane fade show active" id="hero" role="tabpanel">
                                            <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Hero Title</label>
                                                <input type="text" class="form-control" name="hero_title" value="{{ $data->hero_title ?? '' }}" placeholder="e.g., Open the World Through French">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Hero Subtitle</label>
                                                <input type="text" class="form-control" name="hero_subtitle" value="{{ $data->hero_subtitle ?? '' }}" placeholder="e.g., La Claire Fontaine">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Hero Description</label>
                                                <textarea class="form-control" name="hero_description" rows="3">{{ $data->hero_description ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Button 1 Text</label>
                                                <input type="text" class="form-control" name="hero_button_text_1" value="{{ $data->hero_button_text_1 ?? '' }}" placeholder="e.g., Enroll Now">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Button 1 Link</label>
                                                <input type="text" class="form-control" name="hero_button_link_1" value="{{ $data->hero_button_link_1 ?? '' }}" placeholder="e.g., /connect">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Button 2 Text</label>
                                                <input type="text" class="form-control" name="hero_button_text_2" value="{{ $data->hero_button_text_2 ?? '' }}" placeholder="e.g., Partner With Us">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Button 2 Link</label>
                                                <input type="text" class="form-control" name="hero_button_link_2" value="{{ $data->hero_button_link_2 ?? '' }}" placeholder="e.g., /connect">
                                            </div>
                                                    </div>
                                                </div>

                                    <!-- About French Stream Tab -->
                                    <div class="tab-pane fade" id="about" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">About Stream Title</label>
                                                <input type="text" class="form-control" name="about_stream_title" value="{{ $data->about_stream_title ?? '' }}">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">About Stream Content</label>
                                                <textarea class="form-control" name="about_stream_content" rows="8">{{ $data->about_stream_content ?? '' }}</textarea>
                                                <small class="text-muted">You can use line breaks for paragraphs.</small>
                                            </div>
                                                    </div>
                                                </div>

                                    <!-- Vision & Mission Tab -->
                                    <div class="tab-pane fade" id="vision-mission" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Vision Title</label>
                                                <input type="text" class="form-control" name="vision_title" value="{{ $data->vision_title ?? '' }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Mission Title</label>
                                                <input type="text" class="form-control" name="mission_title" value="{{ $data->mission_title ?? '' }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Vision Content</label>
                                                <textarea class="form-control" name="vision_content" rows="6">{{ $data->vision_content ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Mission Content</label>
                                                <textarea class="form-control" name="mission_content" rows="6">{{ $data->mission_content ?? '' }}</textarea>
                                            </div>
                                        </div>
                                                </div>

                                    <!-- Why French Tab -->
                                    <div class="tab-pane fade" id="why-french" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Why French Title</label>
                                                <input type="text" class="form-control" name="why_french_title" value="{{ $data->why_french_title ?? '' }}">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Why French Subtitle</label>
                                                <textarea class="form-control" name="why_french_subtitle" rows="3">{{ $data->why_french_subtitle ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Why French Points (JSON Array)</label>
                                                <textarea class="form-control" name="why_french_points" rows="8">{{ is_array($data->why_french_points ?? null) ? json_encode($data->why_french_points, JSON_PRETTY_PRINT) : ($data->why_french_points ?? '[]') }}</textarea>
                                                <small class="text-muted">Format: [{"title": "Spoken on five continents", "description": "..."}, ...]</small>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Benefits for East African Youth (JSON Array)</label>
                                                <textarea class="form-control" name="why_french_benefits" rows="6">{{ is_array($data->why_french_benefits ?? null) ? json_encode($data->why_french_benefits, JSON_PRETTY_PRINT) : ($data->why_french_benefits ?? '[]') }}</textarea>
                                                <small class="text-muted">Format: ["Benefit 1", "Benefit 2", ...] or [{"text": "Benefit 1"}, ...]</small>
                                            </div>
                                                </div>
                                            </div>
                                            
                                    <!-- Linguistic Offer Tab -->
                                    <div class="tab-pane fade" id="linguistic" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Linguistic Offer Title</label>
                                                <input type="text" class="form-control" name="linguistic_title" value="{{ $data->linguistic_title ?? '' }}">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">French Language Programs (JSON)</label>
                                                <textarea class="form-control" name="linguistic_programs" rows="8">{{ is_array($data->linguistic_programs ?? null) ? json_encode($data->linguistic_programs, JSON_PRETTY_PRINT) : ($data->linguistic_programs ?? '[]') }}</textarea>
                                                <small class="text-muted">Format: [{"title": "Program Name", "description": "...", "items": ["Item 1", "Item 2"]}, ...]</small>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Publications (JSON Array)</label>
                                                <textarea class="form-control" name="linguistic_publications" rows="6">{{ is_array($data->linguistic_publications ?? null) ? json_encode($data->linguistic_publications, JSON_PRETTY_PRINT) : ($data->linguistic_publications ?? '[]') }}</textarea>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Teacher Training Info (JSON)</label>
                                                <textarea class="form-control" name="linguistic_training" rows="4">{{ is_array($data->linguistic_training ?? null) ? json_encode($data->linguistic_training, JSON_PRETTY_PRINT) : ($data->linguistic_training ?? '[]') }}</textarea>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Cultural Exchange Info (JSON)</label>
                                                <textarea class="form-control" name="linguistic_exchange" rows="4">{{ is_array($data->linguistic_exchange ?? null) ? json_encode($data->linguistic_exchange, JSON_PRETTY_PRINT) : ($data->linguistic_exchange ?? '[]') }}</textarea>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Cultural Events (JSON)</label>
                                                <textarea class="form-control" name="linguistic_events" rows="4">{{ is_array($data->linguistic_events ?? null) ? json_encode($data->linguistic_events, JSON_PRETTY_PRINT) : ($data->linguistic_events ?? '[]') }}</textarea>
                                            </div>
                                                </div>
                                            </div>                                                

                                    <!-- Methodology Tab -->
                                    <div class="tab-pane fade" id="methodology" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Methodology Title</label>
                                                <input type="text" class="form-control" name="methodology_title" value="{{ $data->methodology_title ?? '' }}">
                                                </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Methodology Content</label>
                                                <textarea class="form-control" name="methodology_content" rows="4">{{ $data->methodology_content ?? '' }}</textarea>
                                                </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Methodology Points (JSON Array)</label>
                                                <textarea class="form-control" name="methodology_points" rows="6">{{ is_array($data->methodology_points ?? null) ? json_encode($data->methodology_points, JSON_PRETTY_PRINT) : ($data->methodology_points ?? '[]') }}</textarea>
                                                <small class="text-muted">Format: [{"title": "Point 1", "description": "..."}, ...] or ["Point 1", "Point 2", ...]</small>
                                            </div>
                                                        </div>
                                                </div>

                                    <!-- Impact Tab -->
                                    <div class="tab-pane fade" id="impact" role="tabpanel">
                                                    <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Impact Section Title</label>
                                                <input type="text" class="form-control" name="impact_section_title" value="{{ $data->impact_section_title ?? '' }}">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Impact Statistics (JSON Array)</label>
                                                <textarea class="form-control" name="impact_stats" rows="12">{{ is_array($data->impact_stats ?? null) ? json_encode($data->impact_stats, JSON_PRETTY_PRINT) : ($data->impact_stats ?? '[]') }}</textarea>
                                                <small class="text-muted">Format: [{"value": "32", "title": "Educational Books", "description": "..."}, ...]</small>
                                            </div>
                                        </div>
                                                    </div>
    
                                    <!-- Sustainability Tab -->
                                    <div class="tab-pane fade" id="sustainability" role="tabpanel">
                                                    <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Sustainability Title</label>
                                                <input type="text" class="form-control" name="sustainability_title" value="{{ $data->sustainability_title ?? '' }}">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Sustainability Content</label>
                                                <textarea class="form-control" name="sustainability_content" rows="4">{{ $data->sustainability_content ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Sustainability Points (JSON Array)</label>
                                                <textarea class="form-control" name="sustainability_points" rows="6">{{ is_array($data->sustainability_points ?? null) ? json_encode($data->sustainability_points, JSON_PRETTY_PRINT) : ($data->sustainability_points ?? '[]') }}</textarea>
                                                <small class="text-muted">Format: [{"title": "Point 1", "description": "..."}, ...]</small>
                                            </div>
                                                    </div>
                                                </div>

                                    <!-- Partnership Tab -->
                                    <div class="tab-pane fade" id="partnership" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Partnership Title</label>
                                                <input type="text" class="form-control" name="partnership_title" value="{{ $data->partnership_title ?? '' }}">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Partnership Content</label>
                                                <textarea class="form-control" name="partnership_content" rows="4">{{ $data->partnership_content ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Partnership Benefits (JSON Array)</label>
                                                <textarea class="form-control" name="partnership_benefits" rows="8">{{ is_array($data->partnership_benefits ?? null) ? json_encode($data->partnership_benefits, JSON_PRETTY_PRINT) : ($data->partnership_benefits ?? '[]') }}</textarea>
                                                <small class="text-muted">Format: ["Benefit 1", "Benefit 2", ...] or [{"text": "Benefit 1"}, ...]</small>
                                            </div>
                                        </div>
                                        </div>

                                    <!-- Legacy Fields Tab -->
                                    <div class="tab-pane fade" id="legacy" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Heading</label>
                                                <input type="text" class="form-control" name="heading" value="{{ $data->heading ?? '' }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Sub Heading</label>
                                                <input type="text" class="form-control" name="subHeading" value="{{ $data->subHeading ?? '' }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                @if($data->welcomeImage)
                                                    <label class="form-label">Current Welcome Image</label><br>
                                                    <img src="{{ asset('storage/images/home') . $data->welcomeImage }}" alt="" width="150px" class="mb-2">
                                                @endif
                                                <label class="form-label">Change Welcome Image</label>
                                                <input type="file" class="form-control" name="welcomeImage">
                                            </div>
                                            @if(Auth()->user()->email=="admin@iremetech.com")
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Welcome Video URL</label>
                                                <input type="text" class="form-control" name="welcomeVideo" value="{{ $data->welcomeVideo ?? '' }}">
                                            </div>
                                            @endif
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Problem</label>
                                                <textarea class="form-control" name="problem" rows="5">{{ $data->problem ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Solution</label>
                                                <textarea class="form-control" name="solution" rows="5">{{ $data->solution ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Work Quote</label>
                                                <input type="text" class="form-control" name="workQuote" value="{{ $data->workQuote ?? '' }}">
                                                <label class="form-label mt-2">Video URL for Work</label>
                                                <input type="text" class="form-control" name="videoUrl" value="{{ $data->videoUrl ?? '' }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                @if($data->workBackImage)
                                                    <label class="form-label">Current Work Background Image</label><br>
                                                    <img src="{{ asset('storage/images/home') . $data->workBackImage }}" alt="" width="150px" class="mb-2">
                                                @endif
                                                <label class="form-label">Change Work Background Image</label>
                                                <input type="file" class="form-control" name="workBackImage">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Impact Title</label>
                                                <input type="text" class="form-control" name="impactTitle" value="{{ $data->impactTitle ?? '' }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Impact Quote</label>
                                                <textarea class="form-control" name="impactQuote" rows="3">{{ $data->impactQuote ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                @if($data->impactImmage)
                                                    <label class="form-label">Current Impact Image</label><br>
                                                    <img src="{{ asset('storage/images/home') . $data->impactImmage }}" alt="" width="150px" class="mb-2">
                                                @endif
                                                <label class="form-label">Change Impact Image</label>
                                                <input type="file" class="form-control" name="impactImmage">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions mt-4 pt-3 border-top">
                                    <button type="submit" class="btn btn-primary btn-lg admin-save-btn">
                                        <i class="fa fa-save me-2"></i>Save All Changes
                                    </button>
                                    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary btn-lg admin-preview-btn">
                                        <i class="fa fa-eye me-2"></i>Preview Homepage
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
        #contentTabs .nav-link:hover {
            background-color: #0d68bf !important;
            color: #fff !important;
            border-color: #0d68bf !important;
            transition: all 0.3s ease;
        }
        
        #contentTabs .nav-link.active {
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
    </style>

    @include('admin.includes.footer')
@endsection
