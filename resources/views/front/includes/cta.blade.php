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
    .cta-pattern {
        background-image: 
            repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,.05) 10px, rgba(255,255,255,.05) 20px);
    }
</style>
