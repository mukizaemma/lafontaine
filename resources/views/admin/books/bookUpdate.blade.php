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
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Updating <strong>{{$book->title}}</strong></li>
                </ol>
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

                    <div class="card mb-4">

                        <div class="card-body">
                        <form class="form" action="{{ route('updateBook', $book->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="title" class="form-label">Book Title</label>
                                        <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $book->title) }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="author" class="form-label">Author</label>
                                        <input type="text" name="author" class="form-control" id="author" value="{{ old('author', $book->author) }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-4 col-sm-12">
                                        <label for="release_date" class="form-label">Release Date</label>
                                        <input type="date" name="release_date" class="form-control" id="release_date" value="{{ old('release_date', $book->release_date) }}">
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label for="credits" class="form-label">Credits</label>
                                        <input type="text" name="credits" class="form-control" id="credits" value="{{ old('credits', $book->credits) }}" placeholder="Enter credits (if any)">
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label for="donation_link" class="form-label">Donation Link</label>
                                        <input type="url" name="donation_link" class="form-control" id="donation_link" value="{{ old('donation_link', $book->donation_link) }}" placeholder="Enter donation link">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="description" class="form-label">Book Description</label>
                                        <textarea id="description" rows="5" class="form-control" name="description" placeholder="Write a short book description...">{{ old('description', $book->description) }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="cover_image" class="form-label">Cover Image</label>
                                        <input type="file" name="cover_image" class="form-control" id="cover_image" accept="image/*">
                                        @if($book->cover_image)
                                            <img src="{{ asset('storage/images/books/' . $book->cover_image) }}" alt="Current Cover" class="mt-2" style="width: 100px; height: auto;">
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="pdf_file" class="form-label">PDF File</label>
                                        <input type="file" name="pdf_file" class="form-control" id="pdf_file" accept="application/pdf">
                                        @if($book->pdf_file)
                                        <embed src="{{ asset('storage/images/books/' . $book->pdf_file) }}" type="application/pdf" width="100%" height="300px" />
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions mt-5">
                                <button type="submit" class="btn btn-primary text-black">
                                    <i class="fa fa-save"></i> Save Changes
                                </button>
                                <a href="{{ route('getBooks') }}" class="btn btn-light">Back to Books</a>
                            </div>
                        </form>

                        </div>
                    </div>


                </div>

            </div>

        </div>
        <!-- Content End -->

        @include('admin.includes.footer')
 @endsection