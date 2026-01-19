<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $setting->company ?? '' }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>La Claire Fontaine</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Services</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="{{ route('courses.index') }}" class="dropdown-item">Courses</a>
                        <a href="{{ route('books') }}" class="dropdown-item">Books & Publications</a>
                        <a href="{{ route('programs') }}" class="dropdown-item">Programs</a>
                    </div>
                </div>
                <a href="{{ route('courses.index') }}" class="nav-item nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">Courses</a>
                <a href="{{ route('books') }}" class="nav-item nav-link {{ request()->routeIs('books') ? 'active' : '' }}">Books</a>
                <a href="{{ route('connect') }}" class="nav-item nav-link {{ request()->routeIs('connect') ? 'active' : '' }}">Contact</a>
            </div>
            <a href="{{ route('courses.index') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Enroll Now<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->


    @yield('content')


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 col-md-6">
                    <h4 class="text-white mb-4">Quick Links</h4>
                    <div class="d-flex flex-column">
                        <a class="btn btn-link text-white-50 text-start px-0 mb-2" href="{{ route('home') }}" style="text-decoration: none;">Home</a>
                        <a class="btn btn-link text-white-50 text-start px-0 mb-2" href="{{ route('about') }}" style="text-decoration: none;">About Us</a>
                        <a class="btn btn-link text-white-50 text-start px-0 mb-2" href="{{ route('connect') }}" style="text-decoration: none;">Contact Us</a>
                        <a class="btn btn-link text-white-50 text-start px-0 mb-2" href="{{ route('books') }}" style="text-decoration: none;">Books</a>
                        <a class="btn btn-link text-white-50 text-start px-0 mb-2" href="{{ route('courses.index') }}" style="text-decoration: none;">Courses</a>
                        <a class="btn btn-link text-white-50 text-start px-0 mb-2" href="{{ route('programs') }}" style="text-decoration: none;">Programs</a>
                        <a class="btn btn-link text-white-50 text-start px-0 mb-2" href="{{ route('home') }}" style="text-decoration: none;">Privacy & Terms</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h4 class="text-white mb-4">Contact</h4>
                    
                    <!-- Phone Numbers with Call and WhatsApp Icons -->
                    <div class="mb-4">
                        <h6 class="text-white-50 mb-3" style="font-size: 0.9rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Phone Numbers</h6>
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <span class="text-white me-3" style="min-width: 150px;">+250781791424</span>
                                <a href="tel:+250781791424" class="btn btn-sm btn-outline-light me-2" title="Call" style="padding: 4px 10px;">
                                    <i class="fa fa-phone-alt"></i>
                                </a>
                                <a href="https://wa.me/250781791424" target="_blank" class="btn btn-sm btn-outline-light" title="WhatsApp" style="padding: 4px 10px;">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="text-white me-3" style="min-width: 150px;">+254715475270</span>
                                <a href="tel:+254715475270" class="btn btn-sm btn-outline-light me-2" title="Call" style="padding: 4px 10px;">
                                    <i class="fa fa-phone-alt"></i>
                                </a>
                                <a href="https://wa.me/254715475270" target="_blank" class="btn btn-sm btn-outline-light" title="WhatsApp" style="padding: 4px 10px;">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="text-white me-3" style="min-width: 150px;">+254112684191</span>
                                <a href="tel:+254112684191" class="btn btn-sm btn-outline-light me-2" title="Call" style="padding: 4px 10px;">
                                    <i class="fa fa-phone-alt"></i>
                                </a>
                                <a href="https://wa.me/254112684191" target="_blank" class="btn btn-sm btn-outline-light" title="WhatsApp" style="padding: 4px 10px;">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="text-white me-3" style="min-width: 150px;">+254721957842</span>
                                <a href="tel:+254721957842" class="btn btn-sm btn-outline-light me-2" title="Call" style="padding: 4px 10px;">
                                    <i class="fa fa-phone-alt"></i>
                                </a>
                                <a href="https://wa.me/254721957842" target="_blank" class="btn btn-sm btn-outline-light" title="WhatsApp" style="padding: 4px 10px;">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    @if($setting->email)
                        <div class="mb-3">
                            <h6 class="text-white-50 mb-2" style="font-size: 0.9rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Email</h6>
                            <p class="mb-0">
                                <a href="mailto:{{ $setting->email }}" class="text-white text-decoration-none">
                                    <i class="fa fa-envelope me-2"></i>{{ $setting->email }}
                                </a>
                            </p>
                        </div>
                    @endif
                    @if($setting->website)
                        <div class="mb-4">
                            <h6 class="text-white-50 mb-2" style="font-size: 0.9rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Website</h6>
                            <p class="mb-0">
                                <a href="{{ $setting->website }}" target="_blank" class="text-white text-decoration-none">
                                    <i class="fa fa-globe me-2"></i>{{ $setting->website }}
                                </a>
                            </p>
                        </div>
                    @endif
                    <div class="d-flex pt-2">
                        @if($setting->twitter)
                            <a class="btn btn-outline-light btn-social me-2" href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if($setting->facebook)
                            <a class="btn btn-outline-light btn-social me-2" href="{{ $setting->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($setting->linkedin)
                            <a class="btn btn-outline-light btn-social me-2" href="{{ $setting->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        @endif
                        @if($setting->instagram)
                            <a class="btn btn-outline-light btn-social me-2" href="{{ $setting->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if($setting->youtube)
                            <a class="btn btn-outline-light btn-social me-2" href="{{ $setting->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">{{$setting->company}}</a>, All rights reserved  © <script>document.write(new Date().getFullYear())</script> .

                        <!--/*** The author’s attribution link must remain intact in the template. ***/-->
                        <!--/*** If you wish to remove this credit link, please purchase the Pro Version . ***/-->
                        Designed By <a class="border-bottom" href="https://iremetech.com">Ireme Tech</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="{{ route('home') }}">Cookies</a>
                            <a href="{{ route('home') }}">Help</a>
                            <a href="{{ route('home') }}">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/250781791424" target="_blank" class="whatsapp-float" title="Chat with us on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <style>
        /* Floating WhatsApp Button Styles */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            left: 20px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }

        .whatsapp-float:hover {
            background-color: #20ba5a;
            transform: scale(1.1);
            color: #FFF;
            text-decoration: none;
        }

        .whatsapp-float i {
            margin-top: 0;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        /* Footer Quick Links Hover Effect */
        .footer .btn-link {
            transition: all 0.3s ease;
        }

        .footer .btn-link:hover {
            color: #06BBCC !important;
            padding-left: 8px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                font-size: 24px;
                bottom: 15px;
                left: 15px;
            }

            .footer .d-flex.align-items-center {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .footer .d-flex.align-items-center span {
                margin-bottom: 8px;
                min-width: auto !important;
            }
        }
    </style>
</body>

</html>