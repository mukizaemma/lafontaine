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

            <div class="container-fluid pt-4 px-4">
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

                <div class="bg-light rounded p-4">
                    <h2><strong>Updating</strong> {{ $podcast->title }}</h2>

                    <div class="container py-4">
                        <div class="card border-0 shadow-lg rounded-4">
                            <div class="card-body">
                                <h2 class="fw-bold text-primary mb-4">Edit Podcast Category</h2>
                    
                                <form action="{{ route('updatePodcastCategory', $podcast->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                    
                                    <!-- Category Name -->
                                    <div class="mb-3">
                                        <label for="title" class="form-label fw-semibold">Category Name</label>
                                        <input type="text" name="title" class="form-control rounded-3" id="title" value="{{ $podcast->title }}">
                                    </div>
                    
                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label fw-semibold">Description</label>
                                        <textarea id="description" rows="5" class="form-control rounded-3" name="description">{!! $podcast->description !!}</textarea>
                                    </div>
                    
                                    <!-- Featured Image -->
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-6 text-center">
                                            <label class="form-label fw-semibold">Current Featured Image</label>
                                            <div class="border rounded-3 shadow-sm p-3">
                                                <img src="{{ asset('storage/images/podcasts/' . $podcast->image) }}" alt="Podcast Image" class="img-fluid rounded" style="max-width: 180px;">
                                            </div>
                                        </div>
                    
                                        <div class="col-lg-6">
                                            <label for="image" class="form-label fw-semibold">Change Featured Image</label>
                                            <input type="file" name="image" class="form-control rounded-3">
                                        </div>
                                    </div>
                    
                                    <!-- Buttons -->
                                    <div class="d-flex justify-content-between mt-4">
                                        <a href="{{ route('getPodcastCategories') }}" class="btn btn-secondary px-4 py-2 rounded-3">
                                            <i class="fa fa-arrow-left"></i> Back to Categories
                                        </a>
                                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm">
                                            <i class="fa fa-save"></i> Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
        <!-- Content End -->


        @include('admin.includes.footer')

 @endsection