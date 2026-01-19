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
                        <li class="breadcrumb-item"><a href="{{ route('books') }}" class="text-white">Books</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">{{ $book->title }}</li>
                    </ol>
                </nav>
                @if($book->cover_image)
                <img src="{{ asset('storage/images/books/' . $book->cover_image) }}" 
                     alt="{{ $book->title }}" 
                     class="img-fluid rounded shadow-lg mb-4" 
                     style="max-height: 400px;">
                @endif
                <h1 class="display-4 fw-bold mb-3">{{ $book->title }}</h1>
                @if($book->author)
                    <p class="lead"><i class="fas fa-user me-2"></i>{{ $book->author }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Book Details -->
<section class="py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mb-5">
                <div class="book-content">
                    <h2 class="mb-4">Book Description</h2>
                    <div class="content-text mb-4">
                        {!! $book->description !!}
                    </div>
                    
                    <div class="book-info bg-light p-4 rounded mb-4">
                        <h4 class="mb-4">Book Information</h4>
                        <div class="row g-3">
                            @if($book->author)
                            <div class="col-md-6">
                                <strong><i class="fas fa-user me-2 text-primary"></i>Author:</strong>
                                <span class="ms-2">{{ $book->author }}</span>
                            </div>
                            @endif
                            @if($book->category)
                            <div class="col-md-6">
                                <strong><i class="fas fa-tag me-2 text-primary"></i>Category:</strong>
                                <span class="ms-2">{{ $book->category }}</span>
                            </div>
                            @endif
                            @if($book->level)
                            <div class="col-md-6">
                                <strong><i class="fas fa-signal me-2 text-primary"></i>Level:</strong>
                                <span class="ms-2">{{ $book->level }}</span>
                            </div>
                            @endif
                            @if($book->language)
                            <div class="col-md-6">
                                <strong><i class="fas fa-language me-2 text-primary"></i>Language:</strong>
                                <span class="ms-2">{{ $book->language }}</span>
                            </div>
                            @endif
                            @if($book->published_year)
                            <div class="col-md-6">
                                <strong><i class="far fa-calendar me-2 text-primary"></i>Published:</strong>
                                <span class="ms-2">{{ $book->published_year }}</span>
                            </div>
                            @endif
                            @if($book->isbn)
                            <div class="col-md-6">
                                <strong><i class="fas fa-barcode me-2 text-primary"></i>ISBN:</strong>
                                <span class="ms-2">{{ $book->isbn }}</span>
                            </div>
                            @endif
                            @if($book->reads)
                            <div class="col-md-6">
                                <strong><i class="fas fa-eye me-2 text-primary"></i>Reads:</strong>
                                <span class="ms-2">{{ number_format($book->reads) }}</span>
                            </div>
                            @endif
                            @if($book->downloads)
                            <div class="col-md-6">
                                <strong><i class="fas fa-download me-2 text-primary"></i>Downloads:</strong>
                                <span class="ms-2">{{ number_format($book->downloads) }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    @if($book->pdf_file)
                    <div class="text-center mb-4">
                        <form action="{{ route('confirmReading') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control form-control-lg" 
                                       placeholder="Enter your email to read" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg px-5 py-3">
                                <i class="fas fa-book-reader me-2"></i>Read Book
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-4">
                @if($relatedBooks && $relatedBooks->count() > 0)
                <div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4">Related Books</h5>
                        @foreach($relatedBooks->take(3) as $related)
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                @if($related->cover_image)
                                <img src="{{ asset('storage/images/books/' . $related->cover_image) }}" 
                                     alt="{{ $related->title }}" 
                                     class="img-fluid rounded mb-2"
                                     style="max-height: 150px; width: 100%; object-fit: cover;">
                                @endif
                                <h6 class="card-title">{{ $related->title }}</h6>
                                @if($related->description)
                                    <p class="card-text small text-muted">{{ Str::limit(strip_tags($related->description), 80) }}</p>
                                @endif
                                <a href="{{ route('bookOpen', $related->slug) }}" class="btn btn-sm btn-outline-primary">
                                    View Details
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
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
    
    .book-info {
        border-left: 4px solid #06BBCC;
    }
</style>

@endsection
