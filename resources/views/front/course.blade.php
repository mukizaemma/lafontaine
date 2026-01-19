@extends('layouts.frontbase')

@section('content')

<!-- Page Header -->
<section class="py-5 bg-primary text-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <span class="badge bg-light text-primary mb-3">{{ $course->category }} • {{ $course->level }}</span>
                <h1 class="display-4 fw-bold mb-3">{{ $course->title }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center bg-transparent mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-white">Courses</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">{{ $course->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Course Details -->
<section class="py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mb-5">
                <div class="course-content">
                    <h2 class="mb-4">Course Description</h2>
                    <div class="content-text mb-4">
                        {!! nl2br(e($course->description)) !!}
                    </div>
                    
                    <div class="course-info bg-light p-4 rounded mb-4">
                        <h4 class="mb-4">Course Information</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <strong><i class="fas fa-tag me-2 text-primary"></i>Category:</strong>
                                <span class="ms-2">{{ $course->category }}</span>
                            </div>
                            <div class="col-md-6">
                                <strong><i class="fas fa-signal me-2 text-primary"></i>Level:</strong>
                                <span class="ms-2">{{ $course->level }}</span>
                            </div>
                            @if($course->duration)
                            <div class="col-md-6">
                                <strong><i class="far fa-clock me-2 text-primary"></i>Duration:</strong>
                                <span class="ms-2">{{ $course->duration }}</span>
                            </div>
                            @endif
                            @if($course->price)
                            <div class="col-md-6">
                                <strong><i class="fas fa-dollar-sign me-2 text-primary"></i>Price:</strong>
                                <span class="ms-2">${{ number_format($course->price, 2) }}</span>
                            </div>
                            @else
                            <div class="col-md-6">
                                <strong><i class="fas fa-gift me-2 text-success"></i>Price:</strong>
                                <span class="ms-2 text-success">Free</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <a href="{{ route('courses.register', $course->id) }}" class="btn btn-primary btn-lg px-5 py-3">
                            <i class="fas fa-graduation-cap me-2"></i>Register for This Course
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                    <div id="enrollment" class="card shadow-sm border-0 sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4">Course Registration</h5>
                        
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

                        <form action="{{ route('courses.register', $course->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" 
                                       value="{{ old('full_name') }}" required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                       value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Country <span class="text-danger">*</span></label>
                                <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" 
                                       value="{{ old('country') }}" required>
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Motivation <span class="text-danger">*</span></label>
                                <textarea name="motivation" class="form-control @error('motivation') is-invalid @enderror" 
                                          rows="4" required>{{ old('motivation') }}</textarea>
                                @error('motivation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane me-2"></i>Submit Registration
                            </button>
                        </form>
                    </div>
                </div>
                
                @if($relatedCourses && $relatedCourses->count() > 0)
                <div class="mt-5">
                    <h5 class="mb-4">Related Courses</h5>
                    @foreach($relatedCourses as $related)
                    <div class="card shadow-sm mb-3 border-0">
                        <div class="card-body">
                            <h6 class="card-title">{{ $related->title }}</h6>
                            <p class="card-text small text-muted">{{ Str::limit($related->description, 80) }}</p>
                            <a href="{{ route('courses.show', $related->id) }}" class="btn btn-sm btn-outline-primary">
                                View Details
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
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
    
    .course-info {
        border-left: 4px solid #06BBCC;
    }
</style>

@endsection
