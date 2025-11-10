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

            <div class="container-fluid px-4">
                {{-- <h1 class="mt-4">Dashboard</h1> --}}

                <div class="row">
                    @if (session()->has('success'))
                        <div class="arlert alert-success">
                            <button class="close" type="button" data-dismiss="alert">X</button>
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="arlert alert-danger">
                            <button class="close" type="button" data-dismiss="alert">X</button>
                            {{ session()->get('error') }}
                        </div>
                    @endif
                </div>

                <div class="container-fluid px-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <!-- Blog Details -->
                            <form class="form" action="{{ route('updateBlog',$book->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <!-- Blog Title -->
                                        <div class="row mb-4">
                                            <ol class="breadcrumb mb-4">
                                                <li class="breadcrumb-item active">{{$book->title}}</li>
                                            </ol>
                                            <div class="col-lg-4 col-sm-12">
                                                <img src="{{ asset('storage/images/books/' . $book->cover_image) }}" alt="Book Cover Image" class="img-fluid rounded shadow" style="width: 200px;">
                                            </div>

                                            <div class="col-lg-6 col-sm-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h3 class="form-label" style="font-size: 1.25rem;">Release Date</h3>
                                                        <input type="text" name="title" class="form-control bg-light text-dark border-0" value="{{$book->release_date}}" readonly style="font-size: 1rem;">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h3 class="form-label" style="font-size: 1.25rem;">Reads</h3>
                                                        <input type="text" name="title" class="form-control bg-light text-dark border-0" value="{{$totalReaders}}" readonly style="font-size: 1rem;">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h3 class="form-label" style="font-size: 1.25rem;">Downloads</h3>
                                                        <input type="text" name="title" class="form-control bg-light text-dark border-0" value="{{$totalReaders ?? 'No Downloads'}}" readonly style="font-size: 1rem;">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h3 class="form-label" style="font-size: 1.25rem;">Comments</h3>
                                                        <input type="text" name="title" class="form-control bg-light text-dark border-0" value="{{$totalComments}}" readonly style="font-size: 1rem;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                
                                    <!-- Blog Description -->
                                    <div class="row mb-4">
                                        <div class="col-lg-6 col-sm-12">
                                            <h4 class="form-label">Book Description</h4>
                                            <p>
                                            {!!$book->description!!}
                                            </p>

                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <h4 class="form-label">PDF File</h4>
                                            <embed src="{{ asset('storage/images/books/' . $book->pdf_file) }}" type="application/pdf" width="100%" height="300px" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                
                    <!-- Comments Section -->
                    <div class="card mt-5">
                        <div class="card-header bg-light text-white">
                            <h5><span style="color: black">{{ $totalComments }}</span> Comments</h5>
                        </div>
                        <div class="card-body">
                            @if($comments->count() == 0)
                                <p class="text-muted">No comments yet.</p>
                            @else
                                @foreach($comments as $comment)
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="mb-1">{{ $comment->names }}</h6>
                                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                        <p class="mt-2 mb-0">{{ $comment->comment }}</p>
                
                                    
                
                                        <hr>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                

            </div>

        </div>
        <!-- Content End -->

        @include('admin.includes.footer')
 @endsection