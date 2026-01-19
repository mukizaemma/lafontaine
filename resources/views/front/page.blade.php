@extends('layouts.frontbase')

@section('content')

<!-- Page Header -->
<section class="py-5 bg-primary text-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">{{ $page->title }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center bg-transparent mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">{{ $page->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Page Content -->
<section class="py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="page-content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
@include('front.includes.cta')

<style>
    .page-content {
        line-height: 1.8;
        color: #555;
        font-size: 1.1rem;
    }
    
    .page-content h1 {
        color: #181d38;
        font-size: 2.5rem;
        margin-top: 2rem;
        margin-bottom: 1.5rem;
        font-weight: 700;
    }
    
    .page-content h2 {
        color: #181d38;
        font-size: 2rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .page-content h3 {
        color: #181d38;
        font-size: 1.5rem;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .page-content p {
        margin-bottom: 1.5rem;
        color: #555;
    }
    
    .page-content ul, .page-content ol {
        margin-left: 2rem;
        margin-bottom: 1.5rem;
    }
    
    .page-content li {
        margin-bottom: 0.5rem;
    }
    
    .page-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 2rem 0;
    }
    
    .page-content blockquote {
        border-left: 4px solid #06BBCC;
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        color: #666;
    }
    
    .page-content a {
        color: #06BBCC;
        text-decoration: none;
    }
    
    .page-content a:hover {
        text-decoration: underline;
    }
</style>

@endsection
