@extends('layouts.frontbase')

@section('content')

<!-- Page Header -->
<section class="py-5 bg-primary text-white position-relative" style="background: linear-gradient(135deg, #06BBCC 0%, #181d38 100%);">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">About Us</h1>
                <p class="lead">Discover our mission, vision, and commitment to French language education</p>
            </div>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container py-5">
        <!-- About the French Stream -->
        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <div class="about-section mb-5">
                    <h2 class="section-title mb-4">About the French Stream</h2>
                    <div class="about-content">
                        <p class="lead mb-4">
                            La Claire Fontaine is a flagship educational and cultural program developed by Scholars. Since 1997, the Company has been shaping holistic, faith-based and internationally minded learners in Rwanda and Kenya. La Claire Fontaine extends this mission by positioning French as a powerful language of education, diplomacy, culture, and opportunity in East Africa.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <h2 class="section-title mb-5 text-center">Vision & Mission</h2>
                
                <!-- Vision Section -->
                <div class="vision-mission-card mb-5">
                    <div class="card-header-custom">
                        <h3 class="mb-0">
                            <i class="fas fa-eye text-primary me-3"></i>Vision
                        </h3>
                    </div>
                    <div class="card-body-custom">
                        <p class="mb-0">
                            To become, by 2030, a leading multilingual educational and cultural network in East Africa, where French, English, and Kiswahili unlock global citizenship.
                        </p>
                    </div>
                </div>

                <!-- Mission Section -->
                <div class="vision-mission-card">
                    <div class="card-header-custom">
                        <h3 class="mb-0">
                            <i class="fas fa-bullseye text-primary me-3"></i>Mission
                        </h3>
                    </div>
                    <div class="card-body-custom">
                        <p class="mb-3">To educate and train young people who are:</p>
                        <ul class="mission-list">
                            <li><i class="fas fa-check-circle text-primary me-2"></i>Fluent in French</li>
                            <li><i class="fas fa-check-circle text-primary me-2"></i>Culturally aware</li>
                            <li><i class="fas fa-check-circle text-primary me-2"></i>Ethically grounded</li>
                            <li><i class="fas fa-check-circle text-primary me-2"></i>Ready to lead across borders</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if($staff && $staff->count() > 0)
        <div class="row mb-5">
            <div class="col-lg-12">
                <h2 class="text-center mb-5">Our Team</h2>
                <div class="row g-4">
                    @foreach($staff as $member)
                    <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                        <div class="team-member text-center">
                            @if($member->image)
                            <img src="{{ asset('storage/images/team/' . $member->image) }}" 
                                 alt="{{ $member->name }}" 
                                 class="img-fluid rounded-circle mb-3" 
                                 style="width: 200px; height: 200px; object-fit: cover;">
                            @else
                            <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 200px; height: 200px;">
                                <i class="fas fa-user fa-4x text-white"></i>
                            </div>
                            @endif
                            <h5>{{ $member->name }}</h5>
                            @if($member->position)
                                <p class="text-muted">{{ $member->position }}</p>
                            @endif
                            @if($member->bio)
                                <p class="small">{{ Str::limit($member->bio, 100) }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @if($images && $images->count() > 0)
        <div class="row mb-5">
            <div class="col-lg-12">
                <h2 class="text-center mb-5">Gallery</h2>
                <div class="row g-3">
                    @foreach($images->take(6) as $image)
                    <div class="col-lg-4 col-md-6">
                        <div class="gallery-item overflow-hidden rounded">
                            <img src="{{ asset('storage/images/slides/' . $image->image) }}" 
                                 alt="Gallery Image" 
                                 class="img-fluid w-100" 
                                 style="height: 250px; object-fit: cover; transition: transform 0.3s ease;">
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('gallery') }}" class="btn btn-outline-primary">
                        View Full Gallery <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        @endif

        @if($events && $events->count() > 0)
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center mb-5">Recent Events</h2>
                <div class="row g-4">
                    @foreach($events as $event)
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm border-0 h-100">
                            @if($event->image)
                            <img src="{{ asset('storage/images/events/' . $event->image) }}" 
                                 alt="{{ $event->title }}" 
                                 class="card-img-top" 
                                 style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                @if($event->date)
                                    <p class="text-muted small">
                                        <i class="far fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}
                                    </p>
                                @endif
                                @if($event->description)
                                    <p class="card-text">{{ Str::limit(strip_tags($event->description), 100) }}</p>
                                @endif
                                <a href="{{ route('event', $event->slug) }}" class="btn btn-sm btn-outline-primary">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Call to Action Section -->
@include('front.includes.cta')

<style>
    .section-title {
        color: #181d38;
        font-weight: 700;
        font-size: 2.5rem;
    }

    .about-content {
        line-height: 1.8;
        color: #555;
        font-size: 1.1rem;
    }

    .about-content .lead {
        font-size: 1.25rem;
        color: #333;
        font-weight: 400;
    }

    .vision-mission-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 2rem;
    }

    .vision-mission-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(6, 187, 204, 0.15);
    }

    .card-header-custom {
        background: linear-gradient(135deg, #06BBCC 0%, #181d38 100%);
        color: white;
        padding: 1.5rem 2rem;
    }

    .card-header-custom h3 {
        color: white;
        font-size: 1.75rem;
        font-weight: 600;
        margin: 0;
    }

    .card-body-custom {
        padding: 2rem;
    }

    .card-body-custom p {
        color: #555;
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 1rem;
    }

    .mission-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mission-list li {
        padding: 12px 0;
        font-size: 1.1rem;
        color: #555;
        border-bottom: 1px solid #f0f0f0;
        transition: padding-left 0.3s ease;
    }

    .mission-list li:last-child {
        border-bottom: none;
    }

    .mission-list li:hover {
        padding-left: 10px;
        color: #06BBCC;
    }

    .mission-list li i {
        font-size: 1rem;
    }
    
    .gallery-item:hover img {
        transform: scale(1.1);
    }
    
    .team-member {
        padding: 1.5rem;
        transition: transform 0.3s ease;
    }
    
    .team-member:hover {
        transform: translateY(-10px);
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 2rem;
        }

        .card-header-custom h3 {
            font-size: 1.5rem;
        }

        .card-header-custom,
        .card-body-custom {
            padding: 1.5rem;
        }
    }
</style>

@endsection
