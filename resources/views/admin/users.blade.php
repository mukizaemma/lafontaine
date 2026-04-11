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

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif

                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Users</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Names</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Login</th>
                                    <th scope="col" style="min-width: 220px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $u)
                                <tr>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>
                                        @if($u->role === 'super_admin')
                                            Super Admin
                                        @elseif($u->role === 'admin')
                                            Admin
                                        @elseif($u->role === 'editor')
                                            Editor
                                        @else
                                            Guest
                                        @endif
                                    </td>
                                    <td>
                                        @if($u->status === 'active')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Disabled</span>
                                        @endif
                                    </td>
                                    <td class="text-left">
                                        <div class="d-flex flex-column align-items-start">
                                            @if($u->role === 'guest')
                                                <a href="{{ route('makeAdmin', ['id' => $u->id]) }}" class="btn btn-info btn-sm mb-2">Make Admin</a>
                                            @endif

                                            @if(!$u->isSuperAdmin() && Auth::id() !== $u->id)
                                                <form action="{{ route('users.toggleLogin', $u) }}" method="post" class="m-0 mb-2">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm {{ $u->status === 'active' ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                                        {{ $u->status === 'active' ? 'Restrict login' : 'Allow login' }}
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('users.resetPassword', $u) }}" method="post" class="text-left border rounded p-2 bg-white m-0 mb-2" style="max-width: 100%;" onsubmit="return confirm('Update password for {{ $u->email }}?');">
                                                @csrf
                                                <div class="small text-muted mb-1">Set new password</div>
                                                <input type="password" name="password" class="form-control form-control-sm mb-1" required autocomplete="new-password" placeholder="New password">
                                                <input type="password" name="password_confirmation" class="form-control form-control-sm mb-1" required autocomplete="new-password" placeholder="Confirm password">
                                                <button type="submit" class="btn btn-secondary btn-sm">Update password</button>
                                            </form>

                                            @if(!$u->isSuperAdmin() && Auth::id() !== $u->id)
                                                <form action="{{ route('users.destroy', $u) }}" method="post" class="m-0" onsubmit="return confirm('Delete this user permanently?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Delete user</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->



            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">La Claire Fontaine</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://iremetech.com">Ireme Technologies</a>
                        </br>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        @include('admin.includes.footer')
 @endsection
