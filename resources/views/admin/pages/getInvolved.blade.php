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


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="btn btn-primary">Our Impact</h2>
                                    @if (session()->has('success'))
                                        <div class="arlert alert-success">
                                            <button class="close" type="button" data-dismiss="alert">X</button>
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif

                                </div>
                                <!-- ./card-header -->
                                <div class="card-body">
                                    <form class="form" action="{{ route('saveInvol', $data->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Heading</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->title }}" name="title">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="projectinput4">Sub Heading</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->subTitle }}" name="subTitle">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-lg-6 col-sm-12">
                                                    <label>Heading back Image </label><br>
                                                    <label id="projectinput7" class="file center-block">
                                                        <img src="{{ asset('storage/images/impact') . $data->headerImage }}"
                                                            alt="" width="150px">
                                                    </label>
                                                </div>

                                                <div class="col-lg-6 col-sm-12">
                                                    <label>Change heading Image <br><span style="color: red">(This
                                                            image should be resized to 600KB pixels)</span></label>
                                                    <label id="projectinput7" class="file center-block">
                                                        <input type="file" id="image" name="headerImage">
                                                        <span class="file-custom"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="summernote" class="form-label">Volunteer with us</label> 
                                                    <textarea id="problem" rows="5" class="form-control" name="voluteer">{!! $data->voluteer !!}</textarea>
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="summernote" class="form-label">Give</label>
                                                    <textarea id="description" rows="5" class="form-control" name="give">{!! $data->give !!}</textarea>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                {{-- <div class="col-lg-6 col-sm-12"> --}}
                                                    <div class="col-lg-12">
                                                        <label for="summernote" class="form-label">Partner with us</label>
                                                        <textarea id="solution" rows="5" class="form-control" name="partner">{!! $data->partner !!}</textarea>
                                                    </div>
                                                {{-- </div> --}}
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-sm-12">
                                                            <label>Our annual report back Image </label><br>
                                                            <label id="projectinput7" class="file center-block">
                                                                <img src="{{ asset('storage/images/impact') . $data->videoBack }}"
                                                                    alt="" width="150px">
                                                            </label>
                                                        </div>
        
                                                        <div class="col-lg-6 col-sm-12">
                                                            <label>Change the annual report back Image <br><span style="color: red">(This
                                                                    image should be resized to 600KB pixels)</span></label>
                                                            <label id="projectinput7" class="file center-block">
                                                                <input type="file" id="image" name="videoBack">
                                                                <span class="file-custom"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
   

                                        </div>

                                        <div class="form-actions mt-5">
                                            <button type="submit" class="btn btn-primary text-black">
                                                <i class="fa fa-save"></i> Save Changes
                                            </button>

                                        </div>
                                    </form>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->


                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->


        </div>
        <!-- Content End -->


        @include('admin.includes.footer')

 @endsection