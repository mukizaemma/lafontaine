<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        {{-- <a href="{{ route('home') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-secondary"><i class="fa fa-hashtag me-2"></i>
            Site
            </h3>
        </a> --}}
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('storage/images') . ($setting->logo ?? '') }}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ $setting->company }}</h6>
                {{-- <span>Admin</span> --}}
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('dashboard') }}" class="nav-item nav-link active"><i class="fas fa-grip-horizontal me-2"></i>Dashboard</a>
            
            <a href="{{ route('homePage') }}" class="nav-item nav-link"><i class="fas fa-home me-2"></i>Homepage Content</a>
            <a href="{{ route('aboutPage') }}" class="nav-item nav-link"> <i class="fas fa-info-circle me-2"></i>About/Company Content</a>
            <a href="{{ route('getPrograms') }}" class="nav-item nav-link"> <i class="fa fa-clipboard me-2"></i>Programs</a>
            <a href="{{ route('getBlogs') }}" class="nav-item nav-link"> <i class="fa fa-tags me-2"></i>Articles</a>
            <a href="{{ route('getBooks') }}" class="nav-item nav-link"> <i class="fa fa-book me-2"></i>Books</a>

            <a href="{{ route('subscribers') }}" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Readers</a>
            <a href="{{ route('setting') }}" class="nav-item nav-link"> <i class="fas fa-hashtag me-2"></i>Settings</a>

            @if(Auth::user()->email == 'admin@iremetech.com' )
            <a href="{{ route('users') }}" class="nav-item nav-link"><i class="fa fa-users me-2"></i> Users</a>
            @endif
        </div>
    </nav>
</div>