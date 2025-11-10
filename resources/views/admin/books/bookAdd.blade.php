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

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="col-6">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fa fa-plus"></i> Add New Book
                            </button>
                        </div>
                    
                        <div class="col-6 text-center">
                            <p class="mb-1 text-muted"><a href="{{ route('subscribers') }}">Total Readers</a> </p>
                            <h6 class="mb-0"><a href="{{ route('subscribers') }}" class="text-dark">{{ $totalReaders }}</a></h6>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <!-- Tabs for filtering -->
                        <ul class="nav nav-tabs mb-3" id="blogTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="latest-tab" data-bs-toggle="tab" data-bs-target="#latest" 
                                    type="button" role="tab" aria-controls="latest" aria-selected="true">
                                    Latest
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="views-tab" data-bs-toggle="tab" data-bs-target="#views" 
                                    type="button" role="tab" aria-controls="views" aria-selected="false">
                                    Most Read
                                </button>
                            </li>
                        </ul>
                    
                        <!-- Tab Contents -->
                        <div class="tab-content" id="blogTabContent">
                            <!-- Latest Books Tab -->
                            <div class="tab-pane fade show active" id="latest" role="tabpanel" aria-labelledby="latest-tab">
                                <div class="row">
                                    @foreach ($latestBooks as $rs)
                                        <div class="col-md-3 col-sm-6 mb-4">
                                            <div class="card book-card">
                                                <div class="card-img-container">
                                                    <img src="{{ asset('storage/images/books/' . $rs->cover_image) }}" class="card-img-top" alt="Book Cover">
                                                    <div class="card-overlay">
                                                        <a href="{{ route('viewBook', $rs->id) }}" class="btn btn-success btn-sm">View</a>
                                                        <a href="{{ route('editBook', $rs->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                        <form action="{{ route('deleteBook', $rs->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('GET')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure to delete this item?')">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">{{ \Carbon\Carbon::parse($rs->created_at)->format('d M Y') }}</small>
                                                        <small><i class="fa fa-eye"></i> {{ $rs->total_reads }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                    


                        </div>
                    </div>
                    
                </div>
                
                <!-- The Modal for adding new Event -->
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Adding New Book</h4>
                                <button type="button" class="btn-close text-black" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="form" action="{{ route('saveBook') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="title" class="form-label">Book Title</label>
                                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter book title" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="author" class="form-label">Author</label>
                                                <input type="text" name="author" class="form-control" id="author" placeholder="Enter author's name">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-4 col-sm-12">
                                                <label for="release_date" class="form-label">Release Date</label>
                                                <input type="date" name="release_date" class="form-control" id="release_date">
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <label for="credits" class="form-label">Credits</label>
                                                <input type="text" name="credits" class="form-control" id="credits" placeholder="Enter credits (if any)">
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <label for="donation_link" class="form-label">Donation Link</label>
                                                <input type="url" name="donation_link" class="form-control" id="donation_link" placeholder="Enter donation link">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="description" class="form-label">Book Description</label>
                                                <textarea id="description" rows="5" class="form-control" name="description" placeholder="Write a short book description..."></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-6 col-sm-12">
                                                <label for="cover_image" class="form-label">Cover Image</label>
                                                <input type="file" name="cover_image" class="form-control" id="cover_image" accept="image/*" required>
                                                <small class="text-muted">Only image files (JPG, PNG, GIF) are allowed.</small>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <label for="pdf_file" class="form-label">PDF File</label>
                                                <input type="file" name="pdf_file" class="form-control" id="pdf_file" accept="application/pdf" >
                                                <small class="text-muted">Only PDF files are allowed.</small>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="form-actions text-end mt-3">
                                        <button type="submit" class="btn btn-primary text-white">
                                            <i class="fa fa-save"></i> Save As Draft
                                        </button>
                                    </div>
                                </form>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger text-black"
                                    data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- Content End -->
        @include('admin.includes.footer')

<style>
.form-label {
    font-weight: 600;
    color: #333;
}

.form-control {
    border-radius: 6px;
    padding: 10px;
}

textarea {
    resize: none;
}

.form-actions .btn {
    padding: 10px 15px;
    border-radius: 6px;
}

input[type="file"] {
    cursor: pointer;
}

.book-card {
    border: none;
    overflow: hidden;
    position: relative;
    transition: transform 0.3s ease-in-out;
}

.book-card:hover {
    transform: scale(1.03);
}

.card-img-container {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
}

.card-img-top {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 8px;
}

.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}

.card-overlay a,
.card-overlay button {
    margin: 5px;
}

.book-card:hover .card-overlay {
    opacity: 1;
}

.card-body {
    padding: 8px 12px;
}

</style>
 @endsection