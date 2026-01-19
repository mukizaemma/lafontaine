@extends('layouts.frontbase')

@section('content')

<!-- Page Header -->
<section class="py-5 bg-primary text-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Our Courses</h1>
                <p class="lead">Comprehensive French language programs for all levels</p>
            </div>
        </div>
    </div>
</section>

<!-- Courses Section -->
<section class="py-5">
    <div class="container py-5">
        @if($courses && $courses->count() > 0)
        <div class="row g-4">
            @foreach($courses as $course)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                <div class="course-item bg-white rounded shadow-sm h-100 p-4 position-relative overflow-hidden border">
                    <div class="course-badge position-absolute top-0 end-0 bg-primary text-white px-3 py-1 rounded-bottom-start">
                        {{ $course->category }}
                    </div>
                    <div class="mb-3">
                        <span class="badge bg-light text-primary mb-2">{{ $course->level }}</span>
                    </div>
                    <h4 class="mb-3">{{ $course->title }}</h4>
                    <p class="text-muted mb-3">{{ Str::limit($course->description, 150) }}</p>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        @if($course->duration)
                            <small class="text-muted"><i class="far fa-clock me-1"></i>{{ $course->duration }}</small>
                        @endif
                        @if($course->price)
                            <strong class="text-primary">${{ number_format($course->price, 2) }}</strong>
                        @else
                            <strong class="text-success">Free</strong>
                        @endif
                    </div>
                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-outline-primary w-100 mb-2">
                        View Details <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('courses.show', $course->id) }}#enrollment" class="btn btn-primary w-100">
                        Register Now <i class="fas fa-graduation-cap ms-2"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-graduation-cap fa-4x text-muted mb-4"></i>
            <h3 class="text-muted">No courses available at the moment</h3>
            <p class="text-muted">Please check back later for new courses.</p>
        </div>
        @endif
    </div>
</section>

<!-- Call to Action Section -->
@include('front.includes.cta')

<style>
    .course-item {
        transition: all 0.3s ease;
    }
    
    .course-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(6, 187, 204, 0.2) !important;
        border-color: #06BBCC !important;
    }
    
    .course-badge {
        font-size: 0.75rem;
        font-weight: 600;
    }
</style>

@endsection
