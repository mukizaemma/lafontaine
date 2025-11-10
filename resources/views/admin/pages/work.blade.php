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
                                    <h2 class="btn btn-primary">Our Work</h2>
                                    @if (session()->has('success'))
                                        <div class="arlert alert-success">
                                            <button class="close" type="button" data-dismiss="alert">X</button>
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif

                                </div>
                                <!-- ./card-header -->
                                <div class="card-body">
                                    <form class="form" action="{{ route('saveWork', $data->id) }}" method="POST"
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
                                                    <label>Our work back Image </label><br>
                                                    <label id="projectinput7" class="file center-block">
                                                        <img src="{{ asset('storage/images/work') . $data->headerImage }}"
                                                            alt="" width="150px">
                                                    </label>
                                                </div>

                                                <div class="col-lg-6 col-sm-12">
                                                    <label>Change Our work back Image <br><span style="color: red">(This
                                                            image should be resized to 600KB pixels)</span></label>
                                                    <label id="projectinput7" class="file center-block">
                                                        <input type="file" id="image" name="headerImage">
                                                        <span class="file-custom"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            {{-- <div class="row mt-5">
                                                <div class="col-lg-4 col-sm-12">
                                                    <label for="summernote" class="form-label">Quote</label>
                                                    <textarea id="problem" rows="5" class="form-control" name="quote">{!! $data->quote !!}</textarea>
                                                </div>
                                                <div class="col-lg-8 col-sm-12">
                                                    <label for="summernote" class="form-label">Work Description if any</label>
                                                    <textarea id="solution" rows="5" class="form-control" name="description">{!! $data->description !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-lg-6 col-sm-12">
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <div class="row">
                                                        <label>Our work background Image </label><br>
                                                        <label id="projectinput7" class="file center-block">
                                                            <img src="{{ asset('storage/images/home') . $data->workBackImage }}"
                                                                alt="" width="150px">
                                                        </label>
                                                    </div>
    
                                                    <div class="row">
                                                        <label>Change Work back Image <br><span style="color: red">(Max. 600KB pixels)</span></label>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="image" name="workBackImage">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div> --}}
    

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