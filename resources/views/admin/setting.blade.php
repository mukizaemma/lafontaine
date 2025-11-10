@extends('layouts.adminBase')

@section('content')
    @include('admin.includes.sidebar') <!-- Sidebar Start -->

    <div class="content">
        @include('admin.includes.navbar') <!-- Navbar Start -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="btn btn-primary">Contacts Setting</h2>
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                        </div>

                        <div class="card-body">
                            <form action="{{ route('saveSetting', $data->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- General Information Section -->
                                <h4 class="mb-3">General Information</h4>
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <label for="company" class="form-label">Website Title</label>
                                        <input type="text" class="form-control" value="{{ $data->company }}" name="company">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" value="{{ $data->address }}" name="address">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" value="{{ $data->phone }}" name="phone">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" value="{{ $data->email }}" name="email">
                                    </div>
                                </div>

                                <!-- Social Media Section -->
                                {{-- <h4 class="mb-3">Social Media</h4>
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <label for="facebook" class="form-label">Facebook</label>
                                        <input type="text" class="form-control" value="{{ $data->facebook }}" name="facebook">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="instagram" class="form-label">Instagram</label>
                                        <input type="text" class="form-control" value="{{ $data->instagram }}" name="instagram">
                                    </div>
                                </div> --}}
                                {{-- <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <label for="twitter" class="form-label">Twitter</label>
                                        <input type="text" class="form-control" value="{{ $data->twitter }}" name="twitter">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="linkedin" class="form-label">LinkedIn</label>
                                        <input type="text" class="form-control" value="{{ $data->linkedin }}" name="linkedin">
                                    </div>
                                </div> --}}
                                {{-- <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <label for="youtube" class="form-label">YouTube</label>
                                        <input type="text" class="form-control" value="{{ $data->youtube }}" name="youtube">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="vision" class="form-label">Donation Link</label>
                                        <input type="text" class="form-control" value="{{ $data->vision }}" name="vision">
                                    </div>
                                </div> --}}

                                <!-- Logo Section -->
                                <h4 class="mb-3">Logo</h4>
                                <div class="row mb-4">
                                    <div class="col-lg-6 text-center">
                                        <label for="currentLogo" class="form-label">Current Logo</label>
                                        <div>
                                            <img src="{{ asset('storage/images') . $data->logo }}" alt="Logo" width="150px">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="logo" class="form-label">Change Logo</label>
                                        <input type="file" class="form-control" name="logo">
                                        <small class="text-danger">Image should be resized to 120x90 pixels</small>
                                    </div>
                                </div>

                                <!-- Additional Settings (Admin Only) -->
                                @if(Auth()->user()->email == "admin@iremetech.com")
                                    <h4 class="mb-3">Additional Settings</h4>
                                    <div class="row mb-4">
                                        <div class="col-lg-12">
                                            <label for="keywords" class="form-label">Keywords</label>
                                            <input type="text" class="form-control" value="{{ $data->keywords }}" name="keywords">
                                        </div>
                                    </div>

                                @endif

                                <!-- Submit Button -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
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

    @include('admin.includes.footer')
@endsection
