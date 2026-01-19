@extends('layouts.frontbase')

@section('content')

<!-- Page Header -->
<section class="py-5 bg-primary text-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Our Programs</h1>
                <p class="lead">Comprehensive educational programs designed to transform lives</p>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section class="py-5">
    <div class="container py-5">
        @if($programs && $programs->count() > 0)
        <div class="row g-4">
            @foreach($programs as $program)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                <div class="program-item bg-white rounded shadow-sm h-100 p-4 position-relative overflow-hidden border">
                    @if($program->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/images/programs/' . $program->image) }}" 
                             alt="{{ $program->title }}" 
                             class="w-100 rounded" 
                             style="height: 250px; object-fit: cover;">
                    </div>
                    @endif
                    <h4 class="mb-3">{{ $program->title }}</h4>
                    @if($program->description)
                        <p class="text-muted mb-3">{{ Str::limit(strip_tags($program->description), 150) }}</p>
                    @endif
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        @if($program->projects && $program->projects->count() > 0)
                            <small class="text-muted">
                                <i class="fas fa-project-diagram me-1"></i>{{ $program->projects->count() }} Projects
                            </small>
                        @endif
                        @if($program->status)
                            <span class="badge bg-{{ $program->status === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($program->status) }}
                            </span>
                        @endif
                    </div>
                    <a href="{{ route('program', $program->slug) }}" class="btn btn-outline-primary w-100 mb-2">
                        View Details <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    @if($program->projects && $program->projects->count() > 0)
                    <a href="{{ route('filterProjectsByProgram', ['program' => $program->id]) }}" class="btn btn-primary w-100">
                        View Projects <i class="fas fa-folder-open ms-2"></i>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-clipboard-list fa-4x text-muted mb-4"></i>
            <h3 class="text-muted">No programs available at the moment</h3>
            <p class="text-muted">Please check back later for new programs.</p>
        </div>
        @endif
    </div>
</section>

<!-- Call to Action Section -->
@include('front.includes.cta')

<style>
    .program-item {
        transition: all 0.3s ease;
    }
    
    .program-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(6, 187, 204, 0.2) !important;
        border-color: #06BBCC !important;
    }
</style>

@endsection
