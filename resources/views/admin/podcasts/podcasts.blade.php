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
                
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Podcasts</h6>
                        <div class="col-dm3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NewProduct">
                                Add New Podcast
                              </button>
                              <a href="{{ route('getPodcastCategories') }}" class="btn btn-light">Categories</a>
                        </div>
                        {{-- <a href="">Show All</a> --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Podcast Title</th>
                                    <th scope="col">Cover Image</th>
                                    <th scope="col">Audio File</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($podcasts as $rs)
                                <tr>
                                    <td><a href="{{ route('editPodcast',['id'=>$rs->id]) }}">{{ $rs->title }}</a></td>
                                    <td><img src="{{ asset('storage/images/podcasts/' .$rs->image) }}" alt="" width="120px"></td>
                                    <td>
                                        @if($rs->audio_url)
                                        <!-- HTML5 Audio player -->
                                        <audio controls>
                                            <source src="{{ asset('storage/audio/podcasts/' . $rs->audio_url) }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                        
                                        @else
                                        <span>No audio available</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Display number of downloads and download button -->
                                        {{-- <a href="{{ asset('storage/audio/' . $rs->audio_url) }}" class="btn btn-primary">
                                            <i class="fa fa-download"></i> Download ({{ $rs->downloads }})
                                        </a> --}}
                                        <p>{!! $rs->short_body !!}</p>
                                    </td>
                                    {{-- <td style="background-color: #f8f9fa; color: #343a40; padding: 10px; border-radius: 5px; text-align: center;">
                                        <i class="fa fa-eye" style="margin-right: 5px;"></i>{{ $rs->views }}
                                        <i class="fa fa-heart" style="margin-left: 15px; margin-right: 5px;"></i>{{ $rs->likes }}
                                    </td> --}}
                                    <td>
                                        <div class="bg-light rounded">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('editPodcast',['id'=>$rs->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('editPodcast',['id'=>$rs->id]) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('deletePodcast',['id'=>$rs->id]) }}" class="btn btn-warning" onclick="return confirm('Are you sure to delete this podcast?')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>

        </div>
        <!-- Content End -->


        <!-- The Modal -->
        <div class="modal fade" id="NewProduct">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Adding New Podcast</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <form class="form" action="{{ route('postPodcast') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-lg-3 col-sm-12">
                                    <label for="podcastcategory_id" class="form-label">Podcast Category</label>
                                    <select name="podcastcategory_id" id="podcastcategory_id" required ="">
                                        <option value="" disabled selected>-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>                      
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-9 col-sm-12">
                                    <label for="title" class="form-label">Podcast Title</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Podcast Title" required>
                                </div>
                                {{-- <div class="col-lg-3 col-sm-12">
                                    <label for="audio_url" class="form-label">Audio URL</label>
                                    <input type="text" name="audio_url" class="form-control" id="audio_url" placeholder="Enter Audio URL" required>
                                </div> --}}
                            </div>
                    
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="description" class="form-label">Podcast Description</label>
                                    <textarea id="description" rows="5" class="form-control" name="description" placeholder="Enter Podcast Description"></textarea>
                                </div>
                            </div>
                    
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="image" class="form-label">Podcast Audio</label>
                                    <div class="input-group">
                                        <input type="file" name="audio_url" class="form-control" id="image" accept="audio/*">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="image" class="form-label">Podcast Cover Image</label>
                                    <div class="input-group">
                                        <input type="file" name="image" class="form-control" id="image" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary text-black">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </form>
                    
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
        
            </div>
            </div>
        </div>
        @include('admin.includes.footer')
 @endsection