@extends('layouts.frontbase')

@section('content')

<!-- Hero Section with Parallax Background -->
<section class="hero-section position-relative overflow-hidden">
    <div class="parallax-bg" data-parallax="scroll" data-image-src="{{ asset('img/carousel-1.jpg') }}" style="background-image: url('{{ asset('img/carousel-1.jpg') }}');"></div>
    <div class="hero-overlay"></div>
    <div class="container position-relative">
        <div class="row align-items-center min-vh-100 py-5">
            <div class="col-lg-8 col-md-10 mx-auto text-center text-white">
                @if($heroSection)
                    <h5 class="text-uppercase mb-3 animated fadeInDown" style="color: #06BBCC; font-weight: 600; letter-spacing: 2px;">
                        {{ $heroSection->subtitle ?? 'Welcome to' }}
                    </h5>
                    <h1 class="display-3 fw-bold mb-4 animated fadeInUp" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                        {{ $heroSection->title ?? 'La Claire Fontaine' }}
                    </h1>
                    <p class="lead mb-5 animated fadeInUp" style="font-size: 1.25rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                        {!! $heroSection->description ?? 'Empowering young people in East Africa to master the French language, embrace Francophone cultures, and access global academic and professional opportunities.' !!}
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3 animated fadeInUp">
                        @if($heroSection->primary_button_text)
                            <a href="{{ $heroSection->primary_button_link ?? route('courses.index') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-lg">
                                <i class="fas fa-graduation-cap me-2"></i>{{ $heroSection->primary_button_text }}
                            </a>
                        @endif
                        @if($heroSection->secondary_button_text)
                            <a href="{{ $heroSection->secondary_button_link ?? route('connect') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill shadow-lg">
                                <i class="fas fa-handshake me-2"></i>{{ $heroSection->secondary_button_text }}
                            </a>
                        @endif
                    </div>
                @else
                    <!-- Fallback Hero Content -->
                    <h5 class="text-uppercase mb-3 animated fadeInDown" style="color: #06BBCC; font-weight: 600; letter-spacing: 2px;">Open the World Through French</h5>
                    <h1 class="display-3 fw-bold mb-4 animated fadeInUp" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">La Claire Fontaine</h1>
                    <p class="lead mb-5 animated fadeInUp" style="font-size: 1.25rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                        Empowering young people in East Africa to master the French language, embrace Francophone cultures, and access global academic and professional opportunities.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3 animated fadeInUp">
                        <a href="{{ route('connect') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-lg">
                            <i class="fas fa-graduation-cap me-2"></i>Enroll in Courses
                        </a>
                        <a href="{{ route('connect') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill shadow-lg">
                            <i class="fas fa-handshake me-2"></i>Partner With Us
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="scroll-indicator text-center text-white position-absolute bottom-0 start-50 translate-middle-x mb-4">
        <i class="fas fa-chevron-down fa-2x animated bounce"></i>
    </div>
</section>

<!-- Who We Are & Our Identity (Static for now) -->
<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="row g-5 align-items-start">
            <div class="col-lg-7 wow fadeInLeft" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-start text-primary pe-3">Who We Are</h6>
                <h1 class="mb-4">La Claire Fontaine</h1>
                <p class="content-text">
                    La Claire Fontaine is a duly registered company operating in Nairobi, Kenya, and Kigali, Rwanda. It is a
                    multidisciplinary educational and cultural enterprise structured around several strategic areas of
                    intervention, referred to as education streams, which include:
                </p>
                <ul class="content-text">
                    <li>The <strong>University Stream</strong>, focusing on higher education and academic training;</li>
                    <li>The <strong>Book Industry Stream</strong>, dedicated to educational publishing and content production;</li>
                    <li>The <strong>Laboratory Stream</strong>, centered on research, pedagogical innovation, and curriculum development;</li>
                    <li>The <strong>Spiritual Stream</strong>, promoting values-based education and character formation;</li>
                    <li>As well as other complementary educational and cultural initiatives.</li>
                </ul>

                <h3 class="mt-4">Our Identity</h3>
                <ul class="content-text">
                    <li>A for-profit educational initiative</li>
                    <li>Rooted in Christian values</li>
                    <li>Focused on multilingual and multicultural excellence</li>
                    <li>Designed for African realities with global standards</li>
                </ul>
            </div>
            <div class="col-lg-5 wow fadeInRight" data-wow-delay="0.2s">
                <div class="position-relative">
                    <img class="img-fluid rounded shadow-lg" src="{{ asset('img/about.jpg') }}" alt="La Claire Fontaine">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-25 rounded"
                         style="transform: translate(20px, 20px); z-index: -1;"></div>
                </div>
                <div class="mt-4 p-4 bg-light rounded shadow-sm">
                    <h5 class="mb-3 text-primary">Our Language Industry</h5>
                    <p class="mb-2"><strong>Where Language Becomes a Bridge Between Cultures</strong></p>
                    <p class="mb-1">Promoting French Education & Cultural Exchange in East Africa</p>
                    <p class="mb-1"><strong>An initiative of Happy Kids School (HKS)</strong></p>
                    <p class="mb-1">📍 Kigali (Rwanda) | Nairobi (Kenya)</p>
                    <p class="mb-1">🎓 Education • Culture • Francophonie</p>
                    <p class="mb-0">🌍 Serving Youth Across East Africa</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experience & Achievements (Static for now) -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-start text-primary pe-3">Experience & Achievements</h6>
                <h1 class="mb-4">Experience & Achievements in Higher Education</h1>
                <p class="content-text">
                    Over the past twenty years, La Claire Fontaine Ltd. has demonstrated strong institutional capacity in
                    supporting the establishment, strengthening, and accreditation of higher education institutions across
                    Africa. The company has consistently assisted universities in meeting national and regional regulatory
                    requirements, particularly in the areas of academic infrastructure, laboratory development, library
                    constitution, and quality assurance compliance.
                </p>
                <p class="content-text">
                    La Claire Fontaine has played a significant role in the successful establishment and operational readiness
                    of multiple higher learning institutions by providing comprehensive academic book collections, scientific
                    laboratory equipment, and fully developed university libraries. These interventions enabled the
                    institutions concerned to meet essential prerequisites for programme launch and institutional
                    accreditation.
                </p>
                <p class="content-text">
                    The company has also contributed substantively to the achievement of full national accreditation for higher
                    education institutions through the supply of certified laboratory equipment, programme-aligned academic
                    resources, and standardized library collections, in line with applicable regulatory frameworks.
                </p>
                <p class="content-text">
                    In addition, La Claire Fontaine has supported the strengthening and accreditation of academic programmes by
                    delivering specialized laboratory equipment and curriculum-aligned academic materials, thereby facilitating
                    compliance with national quality assurance standards.
                </p>
                <p class="content-text">
                    Throughout its engagements, La Claire Fontaine has maintained a reputation for professionalism, academic
                    integrity, and a deep understanding of higher education accreditation processes. Its support services are
                    grounded in international academic standards and are carefully adapted to the specific requirements of each
                    institution.
                </p>
                <p class="content-text mb-0">
                    Drawing on this extensive experience, La Claire Fontaine remains fully prepared to support future
                    university establishment and accreditation initiatives, including the provision of programme-specific
                    textbooks, laboratory equipment, complete university library collections, and accreditation advisory
                    services, in accordance with national higher education regulatory authorities.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Linguistic Offer & Courses (Static intro + dynamic list) -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center wow fadeInUp mb-5" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Our Language Industry</h6>
            <h1 class="mb-4">Promoting French Education & Cultural Exchange in East Africa</h1>
            <p class="lead">
                French is more than a language – it is a bridge between cultures, universities, and opportunities across continents.
            </p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <h4 class="mb-3">1. French Language Programs</h4>
                    <p class="mb-2">Structured learning pathways for:</p>
                    <ul class="content-text mb-2">
                        <li>Children</li>
                        <li>Youth</li>
                        <li>Professionals</li>
                        <li>Beginners to advanced learners</li>
                    </ul>
                    <ul class="content-text">
                        <li>Grammar &amp; vocabulary</li>
                        <li>Pronunciation &amp; communication</li>
                        <li>Academic &amp; business French</li>
                        <li>Public speaking in French</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <h4 class="mb-3">2. Culturally Enriched Learning</h4>
                    <p class="mb-2">Language taught with culture, not in isolation:</p>
                    <ul class="content-text">
                        <li>Francophone literature &amp; poetry</li>
                        <li>African stories in French</li>
                        <li>Film, music &amp; arts</li>
                        <li>Comparative cultural studies</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <h4 class="mb-3">3. Unique Educational Publications</h4>
                    <p class="mb-2">La Claire Fontaine has developed <strong>32 original pedagogical books</strong>, tailored to East African learners:</p>
                    <ul class="content-text">
                        <li>French grammar &amp; vocabulary</li>
                        <li>Pronunciation guides</li>
                        <li>Workbooks &amp; textbooks</li>
                        <li>Business French</li>
                        <li>Poetry &amp; literature</li>
                        <li>Children’s books</li>
                        <li>Multilingual (French–English–Swahili) resources</li>
                    </ul>
                </div>
            </div>
        </div>

        @if($courses && $courses->count() > 0)
        <div class="row g-4 mt-4">
            @foreach($courses as $course)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ 0.4 + ($loop->index * 0.1) }}s">
                <div class="course-item bg-white rounded shadow-sm h-100 p-4 position-relative overflow-hidden">
                    <div class="course-badge position-absolute top-0 end-0 bg-primary text-white px-3 py-1 rounded-bottom-start">
                        {{ $course->category }}
                    </div>
                    <div class="mb-3">
                        <span class="badge bg-light text-primary mb-2">{{ $course->level }}</span>
                    </div>
                    <h4 class="mb-3">{{ $course->title }}</h4>
                    <p class="text-muted mb-3">{{ Str::limit($course->description, 120) }}</p>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        @if($course->duration)
                            <small class="text-muted"><i class="far fa-clock me-1"></i>{{ $course->duration }}</small>
                        @endif
                        @if($course->price)
                            <strong class="text-primary">${{ number_format($course->price, 2) }}</strong>
                        @else
                            <strong class="text-success">Free</strong>
                        @endif
                    </div>
                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-outline-primary w-100 mb-2">
                        View Details <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('courses.show', $course->id) }}#enrollment" class="btn btn-primary w-100">
                        Register Now <i class="fas fa-graduation-cap ms-2"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('courses.index') }}" class="btn btn-outline-primary btn-lg">
                View All Courses <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Why French in East Africa? -->
<section class="py-5 position-relative overflow-hidden">
    <div class="parallax-bg-light" data-parallax="scroll" data-image-src="{{ asset('img/carousel-2.jpg') }}" style="background-image: url('{{ asset('img/carousel-2.jpg') }}');"></div>
    <div class="container position-relative py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto text-center text-white wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Why French in East Africa?</h6>
                <h1 class="mb-4 text-white">A Strategic Language for the Future</h1>
                <p class="lead mb-4">
                    French is spoken on five continents, is an official language of international diplomacy, and a gateway to
                    education, trade, tourism, and global institutions.
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="bg-white rounded p-4 shadow-sm h-100">
                    <h4 class="mb-3 text-primary">For East African Youth, French Creates Access To:</h4>
                    <ul class="content-text mb-0">
                        <li>Francophone universities</li>
                        <li>International careers</li>
                        <li>Regional and global mobility</li>
                        <li>Cultural literacy and dialogue</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="bg-white rounded p-4 shadow-sm h-100">
                    <h4 class="mb-3 text-primary">Our Impact So Far</h4>
                    <ul class="content-text mb-0">
                        <li>Hundreds of bilingual learners trained</li>
                        <li>Dozens of educators empowered</li>
                        <li>32 educational books produced</li>
                        <li>Strong partnerships in Rwanda &amp; Kenya</li>
                        <li>A growing Francophone education ecosystem</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Books Section -->
@if($books && $books->count() > 0)
<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center wow fadeInUp mb-5">
            <h6 class="section-title bg-white text-center text-primary px-3">Publications</h6>
            <h1 class="mb-5">Our Books & Resources</h1>
            <p class="lead">Explore our collection of French language learning materials and publications</p>
        </div>
        <div class="row g-4">
            @foreach($books->take(6) as $book)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                <div class="card shadow-sm h-100 border-0 book-card">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 300px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                            <i class="fas fa-book fa-4x text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge bg-primary">{{ $book->category ?? 'General' }}</span>
                            @if($book->level)
                                <span class="badge bg-info">{{ $book->level }}</span>
                            @endif
                        </div>
                        <h5 class="card-title mb-3">{{ $book->title }}</h5>
                        <p class="card-text text-muted flex-grow-1">{{ Str::limit($book->description, 100) }}</p>
                        <a href="{{ route('bookOpen', $book->slug) }}" class="btn btn-primary mt-auto">
                            View Details <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('books') }}" class="btn btn-outline-primary btn-lg">
                View All Books <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Methodology & Sustainability -->
<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-start text-primary pe-3">Methodology</h6>
                <h1 class="mb-4">An Integrated Learning Approach</h1>
                <p class="content-text">
                    Our pedagogy combines progressive language acquisition, cultural immersion, digital learning tools, and
                    local relevance with global standards.
                </p>
                <ul class="content-text">
                    <li>Many reference books already developed</li>
                    <li>Digital platforms and online courses</li>
                    <li>Continuous evaluation and improvement</li>
                </ul>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
                <h6 class="section-title bg-white text-start text-primary pe-3">Sustainability &amp; Growth</h6>
                <h1 class="mb-4">Built for Long-Term Impact</h1>
                <p class="content-text">
                    La Claire Fontaine is built for long-term impact through continuous feedback, regular curriculum updates,
                    and a strategic growth model.
                </p>
                <ul class="content-text mb-0">
                    <li>Continuous feedback from educators</li>
                    <li>Regular curriculum updates</li>
                    <li>Regional expansion planned (Zambia, Zimbabwe, South Africa)</li>
                    <li>A “train-the-trainer” model for scalability</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section (dynamic) -->
@if($blogs && $blogs->count() > 0)
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center wow fadeInUp mb-5">
            <h6 class="section-title bg-white text-center text-primary px-3">Latest News</h6>
            <h1 class="mb-5">From Our Blog</h1>
        </div>
        <div class="row g-4">
            @foreach($blogs->take(3) as $blog)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                <div class="card shadow-sm h-100 border-0">
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <small class="text-muted"><i class="far fa-calendar me-1"></i>{{ $blog->created_at->format('M d, Y') }}</small>
                            @if($blog->category)
                                <span class="badge bg-primary">{{ $blog->category->name }}</span>
                            @endif
                        </div>
                        <h5 class="card-title mb-3">{{ $blog->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit(strip_tags($blog->body), 100) }}</p>
                        <a href="{{ route('singleBlog', $blog->slug) }}" class="btn btn-link text-primary p-0">
                            Read More <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('blogsAll') }}" class="btn btn-outline-primary btn-lg">
                View All Posts <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Call to Action Section -->
<section class="py-5 bg-primary text-white position-relative overflow-hidden">
    <div class="cta-pattern position-absolute top-0 start-0 w-100 h-100 opacity-10"></div>
    <div class="container position-relative py-5">
        <div class="row align-items-center">
            <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
                <h2 class="display-5 fw-bold mb-3">Ready to Start Your French Learning Journey?</h2>
                <p class="lead mb-0">Join thousands of students who are mastering French with La Claire Fontaine</p>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <a href="{{ route('courses.index') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow-lg me-2 mb-2">
                    <i class="fas fa-graduation-cap me-2"></i>Enroll Now
                </a>
                <a href="{{ route('connect') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill shadow-lg mb-2">
                    <i class="fas fa-handshake me-2"></i>Partner With Us
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    /* Hero Section with Parallax */
    .hero-section {
        min-height: 100vh;
        position: relative;
    }
    
    .parallax-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 120%;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        z-index: 1;
    }
    
    .parallax-bg-light {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        z-index: 1;
        opacity: 0.3;
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(24, 29, 56, 0.85) 0%, rgba(6, 187, 204, 0.75) 100%);
        z-index: 2;
    }
    
    .hero-section .container {
        position: relative;
        z-index: 3;
    }
    
    /* Scroll Indicator */
    .scroll-indicator {
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0) translateX(-50%);
        }
        40% {
            transform: translateY(-10px) translateX(-50%);
        }
        60% {
            transform: translateY(-5px) translateX(-50%);
        }
    }
    
    /* Course Cards */
    .course-item {
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }
    
    .course-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(6, 187, 204, 0.2) !important;
        border-color: #06BBCC;
    }
    
    .course-badge {
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    /* Impact Stats */
    .impact-stat-card {
        transition: all 0.3s ease;
    }
    
    .impact-stat-card:hover {
        transform: translateY(-10px) scale(1.05);
        box-shadow: 0 15px 35px rgba(255, 255, 255, 0.3) !important;
    }
    
    /* Book Cards */
    .book-card {
        transition: all 0.3s ease;
    }
    
    .book-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
    }
    
    /* CTA Pattern */
    .cta-pattern {
        background-image: 
            repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,.05) 10px, rgba(255,255,255,.05) 20px);
    }
    
    /* Content Text Styling */
    .content-text {
        line-height: 1.8;
        color: #555;
    }
    
    .content-text h1, .content-text h2, .content-text h3 {
        color: #181d38;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .content-text p {
        margin-bottom: 1rem;
    }
    
    .content-text ul, .content-text ol {
        margin-left: 1.5rem;
        margin-bottom: 1rem;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .parallax-bg, .parallax-bg-light {
            background-attachment: scroll;
        }
        
        .hero-section {
            min-height: 80vh;
        }
        
        .display-3 {
            font-size: 2.5rem;
        }
    }
</style>

<script>
    // Parallax Effect
    $(window).scroll(function() {
        const scrolled = $(window).scrollTop();
        const parallax = $('.parallax-bg');
        const speed = scrolled * 0.5;
        parallax.css('transform', 'translateY(' + speed + 'px)');
    });
    
    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(event) {
        const target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 1000);
        }
    });
</script>

@endsection
