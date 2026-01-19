@extends('layouts.frontbase')

@section('content')

<!-- Page Header -->
<section class="py-5 bg-primary text-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center bg-transparent mb-3">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('programs') }}" class="text-white">Programs</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">{{ $program->title }}</li>
                    </ol>
                </nav>
                @if($program->image)
                <img src="{{ asset('storage/images/programs/' . $program->image) }}" 
                     alt="{{ $program->title }}" 
                     class="img-fluid rounded shadow-lg mb-4" 
                     style="max-height: 400px;">
                @endif
                <h1 class="display-4 fw-bold mb-3">{{ $program->title }}</h1>
            </div>
        </div>
    </div>
</section>

<!-- Program Details -->
<section class="py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mb-5">
                <div class="program-content">
                    <h2 class="mb-4">Program Description</h2>
                    <div class="content-text mb-4">
                        {!! $program->description !!}
                    </div>
                    
                    @if($program->projects && $program->projects->count() > 0)
                    <div class="program-projects bg-light p-4 rounded mb-4">
                        <h4 class="mb-4">Program Projects</h4>
                        <div class="row g-3">
                            @foreach($program->projects as $project)
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $project->title }}</h6>
                                        @if($project->description)
                                            <p class="card-text small text-muted">{{ Str::limit(strip_tags($project->description), 100) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('filterProjectsByProgram', ['program' => $program->id]) }}" class="btn btn-primary">
                                View All Projects <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4">Program Information</h5>
                        <div class="mb-3">
                            @if($program->status)
                                <strong>Status:</strong>
                                <span class="badge bg-{{ $program->status === 'active' ? 'success' : 'secondary' }} ms-2">
                                    {{ ucfirst($program->status) }}
                                </span>
                            @endif
                        </div>
                        @if($program->projects && $program->projects->count() > 0)
                        <div class="mb-3">
                            <strong><i class="fas fa-project-diagram me-2 text-primary"></i>Projects:</strong>
                            <span class="ms-2">{{ $program->projects->count() }}</span>
                        </div>
                        @endif
                        <div class="text-center mt-4">
                            <a href="{{ route('programs') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-arrow-left me-2"></i>Back to Programs
                            </a>
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
    .content-text {
        line-height: 1.8;
        color: #555;
        font-size: 1.1rem;
    }
    
    .program-projects {
        border-left: 4px solid #06BBCC;
    }
</style>

@endsection
