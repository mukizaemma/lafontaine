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
                    <li class="breadcrumb-item active">Updating <strong>{{$post->title}}</strong></li>
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
                            <form class="form" action="{{ route('updateBlog',$post->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row mb-3 justify-content-center align-items-center text-center">
                                        <div class="col-lg-4 col-sm-12">
                                            <label for="category_id" class="form-label">Topics</label>
                                            <select name="category_id" id="category_id" class="form-select">
                                                <option value="" disabled selected>{{ $post->category->name ?? 'Select a topic' }}</option>
                                                @foreach($categories as $categ)
                                                    <option value="{{ $categ->id }}">{{ $categ->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-8 col-sm-12">
                                            <label for="title" class="form-label">Publication Title</label>
                                            <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}">
                                        </div>
                                    </div>
                                    

                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="summernote" class="form-label">Description</label>
                                            <textarea id="Blogs" rows="5" class="form-control" name="body">{!!$post->body!!}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <!-- Cover Image Preview & Upload -->
                                        <div class="col-lg-4 col-sm-12 text-center">
                                            <label for="image" class="form-label fw-bold">Cover Image</label>
                                            <div class="border p-2 rounded shadow-sm">
                                                <img src="{{ asset('storage/images/blogs/' . $post->image) }}" alt="Cover Image" class="img-fluid rounded mb-2" style="max-width: 150px;">
                                                <input type="file" name="image" class="form-control mt-2" id="image">
                                            </div>
                                        </div>
                                    
                                        <!-- Publish Status -->
                                        <div class="col-lg-4 col-sm-12">
                                            <label class="form-label fw-bold">Publish Status</label>
                                            <div class="border p-3 rounded shadow-sm">
                                                <div class="form-check">
                                                    <input type="radio" id="publish" name="status" value="Published" class="form-check-input" {{ $post->status == 'Published' ? 'checked' : '' }}>
                                                    <label for="publish" class="form-check-label text-success fw-semibold">Publish (This won't send notifications)</label>
                                                </div>
                                                <div class="form-check mt-2">
                                                    <input type="radio" id="unpublish" name="status" value="Unpublished" class="form-check-input" {{ $post->status == 'Unpublished' ? 'checked' : '' }}>
                                                    <label for="unpublish" class="form-check-label text-danger fw-semibold">Unpublish</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="form-actions mt-5">
                                    <button type="submit" class="btn btn-primary text-black">
                                        <i class="fa fa-save"></i> Save Changes
                                    </button>

                                    <a href="{{ route('getBlogs') }}" class="btn btn-light">Back to Blogs</a>


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