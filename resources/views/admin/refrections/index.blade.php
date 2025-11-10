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
                    <li class="breadcrumb-item active">Recent Ministry Refrections</li>
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

                <div class="card mb-4">
                    <div class="card-header">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i
                                class="fa fa-plus"></i> Add New Refrection</button>

                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Cover Image</th>
                                    <th>Title</th>
                                    {{-- <th>Galerie</th> --}}
                                    <th style="width:300px;">Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($refrections as $rs)
                                    <tr>
                                        <td><img src="{{ asset('storage/images/refrections/' . $rs->image) }}" alt="" width="150px"></td>
                                        <td><a href="{{ route('editBlog', $rs->id) }}">{{ $rs->title }}</a></td>

                                        {{-- <td>
                                            <a href="{{route('image.index', ['pid' =>$rs->id])}}" onclick="return !window.open(this.href, '', 'top=50 left=100 width=1100, height=700')">
                                                <img src="assets/admin/assets/img/gallery.png" alt="" width="90px">
                                                </a> 
                                        </td> --}}
                                        {{-- <td>{!! $rs->body !!}</td> --}}
                                        <td>{!! \Illuminate\Support\Str::limit(strip_tags($rs->body), 100) !!}</td>
                                        <td >
                                            <div class="btn-btn-group ">
                                                @if ($rs->publish === "No")

                                                <a href="{{ route('publishBlog', $rs->id) }}" class="btn btn-primary text-black" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    Publish
                                                </a>

                                                @else
                                                <span class="btn btn-secondary">Published</span>
                                                @endif
                                                <a href="{{ route('editBlog', $rs->id) }}" class="btn btn-primary text-black" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <form action="{{ route('deleteBlog', $rs->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger text-black" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure to delete this item?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- The Modal for adding new Event -->
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Adding New Refrection</h4>
                                <button type="button" class="btn-close text-black" data-bs-dismiss="modal">X</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="form" action="{{ route('saveBlog') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="row mb-3">
                                            <div class="col-lg-12">
                                                <label for="title" class="form-label">Refrection Title</label>
                                                <input type="text" name="title" class="form-control"
                                                    id="title" placeholder="Title" required="">
                                            </div>
                                            {{-- <div class="col-lg-3 col-sm-12">
                                                <label for="title" class="form-label">Author</label>
                                                <input type="text" name="author" class="form-control"
                                                    id="title" placeholder="Author" required="">
                                            </div> --}}
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="summernote" class="form-label">Refrection Content</label>
                                                <textarea id="Blogs" rows="5" class="form-control" name="body" required=""></textarea>
                                            </div>
                                        </div>

                                        <div class="row"> 
                                            <div class="col-lg-6 col-sm-12">
                                                <label for="image" class="form-label">Cover Image<br> <span
                                                        style="color: red">(This Image should compressed to 600X400
                                                        pixels and less than 400KB)</span></label>
                                                <div class="input-group">

                                                    <input type="file" name="image" class="form-control"
                                                        id="image">

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary text-black">
                                            <i class="fa fa-save"></i> Save Draft
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


 @endsection