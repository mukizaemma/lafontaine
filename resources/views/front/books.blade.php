@extends('layouts.frontbase')

@section('content')

<!-- Page Header -->
<section class="py-5 bg-primary text-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Books & Publications</h1>
                <p class="lead">Explore our collection of French language learning resources</p>
            </div>
        </div>
    </div>
</section>

<!-- Books Section -->
<section class="py-5">
    <div class="container py-5">
        @if($books && $books->count() > 0)
        <div class="row g-4">
            @foreach($books as $book)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                <div class="book-item bg-white rounded shadow-sm h-100 overflow-hidden border">
                    @if($book->cover_image)
                    <div class="book-image-container position-relative">
                        <img src="{{ asset('storage/images/books/' . $book->cover_image) }}" 
                             alt="{{ $book->title }}" 
                             class="w-100" 
                             style="height: 300px; object-fit: cover;">
                        <div class="book-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                            <a href="{{ route('bookOpen', $book->slug) }}" class="btn btn-light btn-lg">
                                <i class="fas fa-book-open me-2"></i>Read More
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="p-4">
                        <div class="mb-2">
                            @if($book->category)
                                <span class="badge bg-primary me-2">{{ $book->category }}</span>
                            @endif
                            @if($book->level)
                                <span class="badge bg-secondary">{{ $book->level }}</span>
                            @endif
                        </div>
                        <h4 class="mb-3">{{ $book->title }}</h4>
                        @if($book->author)
                            <p class="text-muted mb-2"><i class="fas fa-user me-2"></i>{{ $book->author }}</p>
                        @endif
                        @if($book->description)
                            <p class="text-muted mb-3">{{ Str::limit(strip_tags($book->description), 120) }}</p>
                        @endif
                        <div class="d-flex justify-content-between align-items-center">
                            @if($book->published_year)
                                <small class="text-muted"><i class="far fa-calendar me-1"></i>{{ $book->published_year }}</small>
                            @endif
                            @if($book->reads)
                                <small class="text-muted"><i class="fas fa-eye me-1"></i>{{ number_format($book->reads) }} reads</small>
                            @endif
                        </div>
                        <a href="{{ route('bookOpen', $book->slug) }}" class="btn btn-primary w-100 mt-3">
                            View Details <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-book fa-4x text-muted mb-4"></i>
            <h3 class="text-muted">No books available at the moment</h3>
            <p class="text-muted">Please check back later for new publications.</p>
        </div>
        @endif
    </div>
</section>

<!-- Call to Action Section -->
@include('front.includes.cta')

<style>
    .book-item {
        transition: all 0.3s ease;
    }
    
    .book-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(6, 187, 204, 0.2) !important;
        border-color: #06BBCC !important;
    }
    
    .book-image-container {
        overflow: hidden;
    }
    
    .book-overlay {
        background: rgba(6, 187, 204, 0.9);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .book-item:hover .book-overlay {
        opacity: 1;
    }
    
    .book-image-container img {
        transition: transform 0.3s ease;
    }
    
    .book-item:hover .book-image-container img {
        transform: scale(1.1);
    }
</style>

@endsection
