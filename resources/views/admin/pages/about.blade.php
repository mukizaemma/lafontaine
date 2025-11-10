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


            <div class="container-fluid py-4">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card border-0 shadow-lg rounded-4">
                            <div class="card-header bg-light text-white d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold mb-0">Our Story</h4>
                                <a href="{{ route('slides') }}" class="btn btn-dark">Landing Background Image</a>
                            </div>
            
                            <div class="card-body p-4">
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session()->get('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif
            
                                <form action="{{ route('saveAbout', $data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
            
                                    <!-- Founder Section -->
                                    <div class="row align-items-center">
                                        <div class="col-lg-5 text-center">
                                            <label class="fw-bold text-secondary">Founder Image</label>
                                            <div class="border rounded-3 shadow-sm p-3 position-relative">
                                                <img src="{{ asset('storage/images/about') . $data->headerImage }}" class="img-fluid rounded" style="max-width: 200px;">
                                                <input type="file" name="headerImage" class="form-control mt-2">
                                            </div>
                                        </div>
            
                                        <div class="col-lg-7">
                                            <label for="welcomeMessage" class="fw-bold text-secondary">Founder Message</label>
                                            <textarea id="welcomeMessage" rows="5" class="form-control rounded-3" name="aboutus">{!! $data->aboutus !!}</textarea>
                                        </div>
                                    </div>
            
                                    <!-- Middle Background Image -->
                                    <div class="row mt-5 py-4 bg-light rounded-3 shadow-sm">
                                        <div class="col-lg-6 text-center">
                                            <label class="fw-bold text-secondary">Middle Background Image</label>
                                            <div class="border rounded-3 p-3 shadow-sm">
                                                <img src="{{ asset('storage/images/about') . $data->backImage }}" class="img-fluid rounded" style="max-width: 200px;">
                                            </div>
                                        </div>
            
                                        <div class="col-lg-6 text-center">
                                            <label class="fw-bold text-secondary">Change Middle Background Image</label>
                                            <input type="file" name="backImage" class="form-control">
                                        </div>
                                    </div>
            
                                    <!-- Home Bottom Section -->
                                    <div class="row mt-5 align-items-center">
                                        <div class="col-lg-4 text-center">
                                            <label class="fw-bold text-secondary">Home Page Bottom Image</label>
                                            <div class="border rounded-3 shadow-sm p-3">
                                                <img src="{{ asset('storage/images/about') . $data->backImageText }}" class="img-fluid rounded" style="max-width: 200px;">
                                                <input type="file" name="backImageText" class="form-control mt-2">
                                            </div>
                                        </div>
            
                                        <div class="col-lg-8">
                                            <label for="ourMission" class="fw-bold text-secondary">Home Bottom Text</label>
                                            <textarea id="ourMission" rows="5" class="form-control rounded-3" name="mission">{!! $data->mission !!}</textarea>
                                        </div>
                                    </div>
            
                                    <!-- Submit Button -->
                                    <div class="text-center mt-5">
                                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm">
                                            <i class="fa fa-save"></i> Update Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                
                <!-- /.container-fluid -->


        </div>
        <!-- Content End -->


        @include('admin.includes.footer')

 @endsection