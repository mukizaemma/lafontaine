<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::get('/logouts', [App\Http\Controllers\AdminController::class, 'logouts'])->name('logouts');
    Route::get('/Users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/Users/{id}', [App\Http\Controllers\AdminController::class, 'makeAdmin'])->name('makeAdmin');


    Route::get('/Comments', [App\Http\Controllers\AdminController::class, 'blogsComment'])->name('blogsComment');
    Route::post('/Comment/approve/{comment}', [App\Http\Controllers\AdminController::class, 'commentApprove'])->name('commentApprove');
    Route::get('/CommentDelete/{id}', [App\Http\Controllers\AdminController::class, 'destroyBlogComment'])->name('destroyBlogComment');

    Route::get('/Subscribers', [App\Http\Controllers\AdminController::class, 'subscribers'])->name('subscribers');
    Route::get('/Subscribers/{id}', [App\Http\Controllers\AdminController::class, 'destroySub'])->name('destroySub');

    Route::get('/getMessages', [App\Http\Controllers\AdminController::class, 'getMessages'])->name('getMessages');
    Route::get('/deleteMessages/{id}', [App\Http\Controllers\AdminController::class, 'deleteMessages'])->name('deleteMessages');

    Route::get('/admin/subscribers/export', [App\Http\Controllers\AdminController::class, 'exportSubscribers'])->name('exportSubscribers');

    
    Route::get('/setting',[App\Http\Controllers\SettingsController::class,'setting'])->name('setting');
    Route::post('/saveSetting',[App\Http\Controllers\SettingsController::class,'saveSetting'])->name('saveSetting');
    
    Route::get('/homePage',[App\Http\Controllers\SettingsController::class,'homePage'])->name('homePage');
    Route::post('/saveHome',[App\Http\Controllers\SettingsController::class,'saveHome'])->name('saveHome');
    
    Route::get('/aboutPage',[App\Http\Controllers\SettingsController::class,'aboutPage'])->name('aboutPage');
    Route::post('/saveAbout',[App\Http\Controllers\SettingsController::class,'saveAbout'])->name('saveAbout');
    
    Route::get('/getGirlChesse',[App\Http\Controllers\GirlChesseController::class,'getGirlChesse'])->name('getGirlChesse');
    Route::post('/saveGirlchess',[App\Http\Controllers\GirlChesseController::class,'saveGirlchess'])->name('saveGirlchess');
    
    Route::get('/getEvenings',[App\Http\Controllers\GirlChesseController::class,'getEvenings'])->name('getEvenings');
    Route::post('/saveEvenings',[App\Http\Controllers\GirlChesseController::class,'saveEvenings'])->name('saveEvenings');

    // Categories
    Route::get('/getGuests', [App\Http\Controllers\GuestsController::class, 'index'])->name('getGuests');
    Route::post('/postGuest', [App\Http\Controllers\GuestsController::class, 'store'])->name('postGuest');
    Route::get('/editGuest/{id}', [App\Http\Controllers\GuestsController::class, 'edit'])->name('editGuest');
    Route::post('/updateGuest/{id}', [App\Http\Controllers\GuestsController::class, 'update'])->name('updateGuest');
    Route::get('/deleteGuest/{id}', [App\Http\Controllers\GuestsController::class, 'destroy'])->name('deleteGuest');
    Route::post('/approveGuest/{id}', [App\Http\Controllers\GuestsController::class, 'approveGuest'])->name('approveGuest');

    Route::get('/impactPage',[App\Http\Controllers\SettingsController::class,'impactPage'])->name('impactPage');
    Route::post('/saveImpact',[App\Http\Controllers\SettingsController::class,'saveImpact'])->name('saveImpact');

    
    Route::get('/getTerms',[App\Http\Controllers\SettingsController::class,'getTerms'])->name('getTerms');
    Route::post('/saveTerms',[App\Http\Controllers\SettingsController::class,'saveTerms'])->name('saveTerms');
        
    // Categories
    Route::get('/getCategories', [App\Http\Controllers\CategoriesController::class, 'index'])->name('getCategories');
    Route::post('/postCategory', [App\Http\Controllers\CategoriesController::class, 'store'])->name('postCategory');
    Route::get('/editCategory/{id}', [App\Http\Controllers\CategoriesController::class, 'edit'])->name('editCategory');
    Route::post('/updateCategory/{id}', [App\Http\Controllers\CategoriesController::class, 'update'])->name('updateCategory');
    Route::get('/deleteCategory/{id}', [App\Http\Controllers\CategoriesController::class, 'destroy'])->name('deleteCategory');
        
    // BLogs
    Route::get('/getBlogs', [App\Http\Controllers\BlogsController::class, 'index'])->name('getBlogs');
    Route::post('/saveBlog', [App\Http\Controllers\BlogsController::class, 'store'])->name('saveBlog');
    Route::get('/blog/{id}', [App\Http\Controllers\BlogsController::class, 'edit'])->name('editBlog');
    Route::get('/blogView/{id}', [App\Http\Controllers\BlogsController::class, 'view'])->name('viewBlog');
    Route::post('/updateBlog/{id}', [App\Http\Controllers\BlogsController::class, 'update'])->name('updateBlog');
    Route::get('/deleteBlog/{id}', [App\Http\Controllers\BlogsController::class, 'destroy'])->name('deleteBlog');
    Route::get('/Blog/{blog}/publish', [App\Http\Controllers\BlogsController::class, 'publish'])->name('publishBlog');
    // Books
    Route::get('/getBooks', [App\Http\Controllers\BooksController::class, 'index'])->name('getBooks');
    Route::post('/saveBook', [App\Http\Controllers\BooksController::class, 'store'])->name('saveBook');
    Route::get('/book/{id}', [App\Http\Controllers\BooksController::class, 'edit'])->name('editBook');
    Route::get('/bookView/{id}', [App\Http\Controllers\BooksController::class, 'view'])->name('viewBook');
    Route::post('/updateBook/{id}', [App\Http\Controllers\BooksController::class, 'update'])->name('updateBook');
    Route::get('/deleteBook/{id}', [App\Http\Controllers\BooksController::class, 'destroy'])->name('deleteBook');
    Route::get('/book/{book}/publish', [App\Http\Controllers\BooksController::class, 'publish'])->name('publishBook');

    // Podcasts Categories
    Route::get('/podcastCategories', [App\Http\Controllers\PodcastCategoriesController::class, 'index'])->name('getPodcastCategories');
    Route::post('/postPodcastCategory', [App\Http\Controllers\PodcastCategoriesController::class, 'store'])->name('postPodcastCategory');
    Route::get('/editPodcastCategory/{id}', [App\Http\Controllers\PodcastCategoriesController::class, 'edit'])->name('editPodcastCategory');
    Route::post('/updatePodcastCategory/{id}', [App\Http\Controllers\PodcastCategoriesController::class, 'update'])->name('updatePodcastCategory');
    Route::get('/deletePodcastCategory/{id}', [App\Http\Controllers\PodcastCategoriesController::class, 'destroy'])->name('deletePodcastCategory');
    

    // Podcasts
    Route::get('/getPodcasts', [App\Http\Controllers\PodcastsController::class, 'index'])->name('getPodcasts');
    Route::post('/postPodcast', [App\Http\Controllers\PodcastsController::class, 'store'])->name('postPodcast');
    Route::get('/editPodcast/{id}', [App\Http\Controllers\PodcastsController::class, 'edit'])->name('editPodcast');
    Route::post('/updatePodcast/{id}', [App\Http\Controllers\PodcastsController::class, 'update'])->name('updatePodcast');
    Route::get('/deletePodcast/{id}', [App\Http\Controllers\PodcastsController::class, 'destroy'])->name('deletePodcast');
    


    // Programs
    Route::get('/getPrograms', [App\Http\Controllers\ProgramsController::class, 'index'])->name('getPrograms');
    Route::post('/storeProgram', [App\Http\Controllers\ProgramsController::class, 'store'])->name('storeProgram');
    Route::get('/editProgram/{id}', [App\Http\Controllers\ProgramsController::class, 'edit'])->name('editProgram');
    Route::post('/UpdateProgram/{id}', [App\Http\Controllers\ProgramsController::class, 'update'])->name('updateProgram');
    Route::get('/DeleteProgram/{id}', [App\Http\Controllers\ProgramsController::class, 'destroy'])->name('deleteProgram');
    // Projects
    Route::get('/getProjects', [App\Http\Controllers\ProjectsController::class, 'index'])->name('getProjects');
    Route::post('/storeProject', [App\Http\Controllers\ProjectsController::class, 'store'])->name('storeProject');
    Route::get('/EditProject/{id}', [App\Http\Controllers\ProjectsController::class, 'edit'])->name('editProject');
    Route::post('/UpdateProject/{id}', [App\Http\Controllers\ProjectsController::class, 'update'])->name('updateProject');
    Route::get('/DeleteProject/{id}', [App\Http\Controllers\ProjectsController::class, 'destroy'])->name('deleteProject');
    Route::get('/DeleteallProjects', [App\Http\Controllers\ProjectsController::class, 'deleteAllProjects'])->name('deleteAllProjects');

    
    // Images Gallery
    Route::get('/projectImage/{pid}',[App\Http\Controllers\ProjectImagesController::class,'projectImage'])->name('projectImage');
    Route::post('/savProjectImage/{pid}',[App\Http\Controllers\ProjectImagesController::class,'savProjectImage'])->name('savProjectImage');
    Route::get('/destroyProjectImage/{pid}/{id}',[App\Http\Controllers\ProjectImagesController::class,'destroyProjectImage'])->name('destroyProjectImage');

    Route::get('/getTestimonials', [App\Http\Controllers\TestimonailsController::class, 'index'])->name('getTestimonials');
    Route::post('/storeTestimonial', [App\Http\Controllers\TestimonailsController::class, 'store'])->name('storeTestimonial');
    Route::get('/EditTestimonial/{id}', [App\Http\Controllers\TestimonailsController::class, 'edit'])->name('editTestimonial');
    Route::post('/UpdateTestimonial/{id}', [App\Http\Controllers\TestimonailsController::class, 'update'])->name('updateTestimonial');
    Route::get('/DeleteTestimonial/{id}', [App\Http\Controllers\TestimonailsController::class, 'destroy'])->name('deleteTestimonial');

    Route::get('/staff',[App\Http\Controllers\TeamsController::class,'index'])->name('staff');
    Route::post('/saveStaff',[App\Http\Controllers\TeamsController::class,'store'])->name('saveStaff');
    Route::get('/editStaff/{id}',[App\Http\Controllers\TeamsController::class,'edit'])->name('editStaff');
    Route::post('/updateStaff/{id}',[App\Http\Controllers\TeamsController::class,'update'])->name('updateStaff');
    Route::get('/deleteStaff/{id}',[App\Http\Controllers\TeamsController::class,'destroy'])->name('deleteStaff');
   

    // Gallery
    Route::get('/slides', [App\Http\Controllers\SlidesController::class, 'index'])->name('slides');
    Route::post('/saveSlide', [App\Http\Controllers\SlidesController::class, 'store'])->name('saveSlide');
    Route::get('/editSlide/{id}', [App\Http\Controllers\SlidesController::class, 'edit'])->name('editSlide');
    Route::post('/updateSlide/{id}', [App\Http\Controllers\SlidesController::class, 'update'])->name('updateSlide');
    Route::get('/destroySlide/{id}', [App\Http\Controllers\SlidesController::class, 'destroy'])->name('destroySlide');

    // Images
    Route::get('/images', [App\Http\Controllers\ImagesController::class, 'index'])->name('images');
    Route::post('/saveImage', [App\Http\Controllers\ImagesController::class, 'store'])->name('saveImage');
    Route::get('/editImage/{id}', [App\Http\Controllers\ImagesController::class, 'edit'])->name('editImage');
    Route::post('/updateImage/{id}', [App\Http\Controllers\ImagesController::class, 'update'])->name('updateImage');
    Route::get('/destroyImage/{id}', [App\Http\Controllers\ImagesController::class, 'destroy'])->name('destroyImage');
    // Gallery
    Route::get('/getPartners', [App\Http\Controllers\PartnersController::class, 'index'])->name('getPartners');
    Route::post('/savePartner', [App\Http\Controllers\PartnersController::class, 'store'])->name('savePartner');
    Route::get('/editPartner/{id}', [App\Http\Controllers\PartnersController::class, 'edit'])->name('editPartner');
    Route::post('/updatePartner/{id}', [App\Http\Controllers\PartnersController::class, 'update'])->name('updatePartner');
    Route::get('/destroyPartner/{id}', [App\Http\Controllers\PartnersController::class, 'destroy'])->name('destroyPartner');

    // Gallery
    Route::get('/getImages', [App\Http\Controllers\SlidesController::class, 'getImages'])->name('getImages');
    Route::post('/saveGallery', [App\Http\Controllers\SlidesController::class, 'saveImage'])->name('saveGallery');
    Route::get('/editGallery/{id}', [App\Http\Controllers\SlidesController::class, 'editGallery'])->name('editGallery');
    Route::post('/updateGallery/{id}', [App\Http\Controllers\SlidesController::class, 'updateGallery'])->name('updateGallery');
    Route::get('/destroyImage/{id}', [App\Http\Controllers\SlidesController::class, 'destroyImage'])->name('destroyImage');
    
   
    // BLogs
    Route::get('/getEvents', [App\Http\Controllers\EventsController::class, 'index'])->name('getEvents');
    Route::post('/saveEvent', [App\Http\Controllers\EventsController::class, 'store'])->name('saveEvent');
    Route::get('/getEvent/{id}', [App\Http\Controllers\EventsController::class, 'edit'])->name('editEvent');
    Route::post('/updatEvente/{id}', [App\Http\Controllers\EventsController::class, 'update'])->name('updateEvent');
    Route::get('/deleteEvent/{id}', [App\Http\Controllers\EventsController::class, 'destroy'])->name('deleteEvent');
    Route::get('/Event/{event}/publish', [App\Http\Controllers\EventsController::class, 'publishEvent'])->name('publishEvent');
    
    // CMS Pages
    Route::resource('pages', App\Http\Controllers\Admin\PageController::class)->names([
        'index' => 'admin.pages.index',
        'create' => 'admin.pages.create',
        'store' => 'admin.pages.store',
        'show' => 'admin.pages.show',
        'edit' => 'admin.pages.edit',
        'update' => 'admin.pages.update',
        'destroy' => 'admin.pages.destroy',
    ]);

    // Hero Sections
    Route::resource('hero-sections', App\Http\Controllers\Admin\HeroSectionController::class)->names([
        'index' => 'admin.hero-sections.index',
        'create' => 'admin.hero-sections.create',
        'store' => 'admin.hero-sections.store',
        'show' => 'admin.hero-sections.show',
        'edit' => 'admin.hero-sections.edit',
        'update' => 'admin.hero-sections.update',
        'destroy' => 'admin.hero-sections.destroy',
    ]);

    // Courses
    Route::resource('courses', App\Http\Controllers\Admin\CourseController::class)->names([
        'index' => 'admin.courses.index',
        'create' => 'admin.courses.create',
        'store' => 'admin.courses.store',
        'show' => 'admin.courses.show',
        'edit' => 'admin.courses.edit',
        'update' => 'admin.courses.update',
        'destroy' => 'admin.courses.destroy',
    ]);

    // Course Registrations
    Route::resource('course-registrations', App\Http\Controllers\Admin\CourseRegistrationController::class)->names([
        'index' => 'admin.course-registrations.index',
        'create' => 'admin.course-registrations.create',
        'store' => 'admin.course-registrations.store',
        'show' => 'admin.course-registrations.show',
        'edit' => 'admin.course-registrations.edit',
        'update' => 'admin.course-registrations.update',
        'destroy' => 'admin.course-registrations.destroy',
    ]);
    Route::post('/course-registrations/{courseRegistration}/approve', [App\Http\Controllers\Admin\CourseRegistrationController::class, 'approve'])->name('admin.course-registrations.approve');
    Route::post('/course-registrations/{courseRegistration}/reject', [App\Http\Controllers\Admin\CourseRegistrationController::class, 'reject'])->name('admin.course-registrations.reject');

    // Authors
    Route::resource('authors', App\Http\Controllers\Admin\AuthorController::class)->names([
        'index' => 'admin.authors.index',
        'create' => 'admin.authors.create',
        'store' => 'admin.authors.store',
        'show' => 'admin.authors.show',
        'edit' => 'admin.authors.edit',
        'update' => 'admin.authors.update',
        'destroy' => 'admin.authors.destroy',
    ]);

    // Partnership Requests
    Route::resource('partnership-requests', App\Http\Controllers\Admin\PartnershipRequestController::class)->only(['index', 'show', 'edit', 'update', 'destroy'])->names([
        'index' => 'admin.partnership-requests.index',
        'show' => 'admin.partnership-requests.show',
        'edit' => 'admin.partnership-requests.edit',
        'update' => 'admin.partnership-requests.update',
        'destroy' => 'admin.partnership-requests.destroy',
    ]);
    Route::post('/partnership-requests/{partnershipRequest}/approve', [App\Http\Controllers\Admin\PartnershipRequestController::class, 'approve'])->name('admin.partnership-requests.approve');
    Route::post('/partnership-requests/{partnershipRequest}/reject', [App\Http\Controllers\Admin\PartnershipRequestController::class, 'reject'])->name('admin.partnership-requests.reject');

    // Contact Messages
    Route::resource('contact-messages', App\Http\Controllers\Admin\ContactMessageController::class)->only(['index', 'show', 'update', 'destroy'])->names([
        'index' => 'admin.contact-messages.index',
        'show' => 'admin.contact-messages.show',
        'update' => 'admin.contact-messages.update',
        'destroy' => 'admin.contact-messages.destroy',
    ]);

    // Media Library
    Route::resource('media', App\Http\Controllers\Admin\MediaController::class)->names([
        'index' => 'admin.media.index',
        'create' => 'admin.media.create',
        'store' => 'admin.media.store',
        'show' => 'admin.media.show',
        'destroy' => 'admin.media.destroy',
    ]);

    // Impact Stats
    Route::resource('impact-stats', App\Http\Controllers\Admin\ImpactStatController::class)->names([
        'index' => 'admin.impact-stats.index',
        'create' => 'admin.impact-stats.create',
        'store' => 'admin.impact-stats.store',
        'show' => 'admin.impact-stats.show',
        'edit' => 'admin.impact-stats.edit',
        'update' => 'admin.impact-stats.update',
        'destroy' => 'admin.impact-stats.destroy',
    ]);

});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Public CMS Pages
Route::get('/page/{slug}', [App\Http\Controllers\HomeController::class, 'showPage'])->name('page.show');

// Public Courses
Route::get('/courses', [App\Http\Controllers\HomeController::class, 'coursesIndex'])->name('courses.index');
Route::get('/courses/{id}', [App\Http\Controllers\HomeController::class, 'showCourse'])->name('courses.show');
Route::get('/topics/category/{slug}', [App\Http\Controllers\HomeController::class, 'categoryBlogs'])->name('categoryBlogs');

Route::get('/blog', [App\Http\Controllers\HomeController::class, 'blogs'])->name('blogs');
Route::get('/blogs', [App\Http\Controllers\HomeController::class, 'blogsAll'])->name('blogsAll');
Route::get('/topics/{slug}', [App\Http\Controllers\HomeController::class, 'blogsByCategory'])->name('blogsByCategory');
Route::get('/blogs/{slug}', [App\Http\Controllers\HomeController::class, 'singleBlog'])->name('singleBlog');
Route::post('/blogs/{id}/like', [App\Http\Controllers\HomeController::class, 'likeBlog'])->name('likeBlog');

Route::get('/category/{id}/podcasts', [App\Http\Controllers\HomeController::class, 'categoryPodcasts'])->name('categoryPodcasts');
Route::get('/podcast', [App\Http\Controllers\HomeController::class, 'podcasts'])->name('podcasts');
Route::get('/podcast/{slug}', [App\Http\Controllers\HomeController::class, 'podcast'])->name('podcast');

Route::get('/filter-projects', [App\Http\Controllers\HomeController::class, 'filterProjectsByProgram'])->name('filterProjectsByProgram');
Route::get('/programs', [App\Http\Controllers\HomeController::class, 'programs'])->name('programs');
Route::get('/program/{slug}', [App\Http\Controllers\HomeController::class, 'program'])->name('program');
Route::get('/connect', [App\Http\Controllers\HomeController::class, 'connect'])->name('connect');

Route::get('/about', [App\Http\Controllers\HomeController::class, 'aboutus'])->name('about');
Route::get('/books', [App\Http\Controllers\HomeController::class, 'books'])->name('books');
Route::get('/books/{slug}', [App\Http\Controllers\HomeController::class, 'book'])->name('bookOpen');
Route::post('/confirm-reading', [App\Http\Controllers\HomeController::class, 'confirmReading'])->name('confirmReading');
Route::get('/events/{slug}', [App\Http\Controllers\HomeController::class, 'event'])->name('event');
Route::get('/gallery', [App\Http\Controllers\HomeController::class, 'gallery'])->name('gallery');
Route::get('/girlChess', [App\Http\Controllers\HomeController::class, 'girlChess'])->name('girlChess');



// user sign up

Route::get('/getSignup', [App\Http\Controllers\HomeController::class, 'getSignup'])->name('getSignup');
Route::post('/Signup', [App\Http\Controllers\HomeController::class, 'signup'])->name('signup');
Route::get('/Signin', [App\Http\Controllers\HomeController::class, 'signin'])->name('signin');
Route::post('/userLogin', [App\Http\Controllers\HomeController::class, 'userLogin'])->name('userLogin');
Route::get('/admin/login', [App\Http\Controllers\HomeController::class, 'adminLogin'])->name('adminLogin');
Route::get('/logouts', [App\Http\Controllers\HomeController::class, 'logouts'])->name('logouts');
Route::post('/subscribe', [App\Http\Controllers\HomeController::class, 'subscribe'])->name('subscribe');

Route::post('/sendMessage', [App\Http\Controllers\HomeController::class, 'sendMessage'])->name('sendMessage');
Route::post('/sendComment', [App\Http\Controllers\HomeController::class, 'sendComment'])->name('sendComment');
Route::post('/bookComment', [App\Http\Controllers\HomeController::class, 'bookComment'])->name('bookComment');
Route::post('/registerNow', [App\Http\Controllers\HomeController::class, 'registerNow'])->name('registerNow');
Route::post('/testimony', [App\Http\Controllers\HomeController::class, 'testimony'])->name('testimony');

// Public Course Registration
Route::post('/courses/{course}/register', [App\Http\Controllers\Admin\CourseRegistrationController::class, 'store'])->name('courses.register');

// Public Partnership Request
Route::post('/partnership-request', function (Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'organization_name' => 'required|string|max:255',
        'contact_person' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'partnership_type' => 'required|in:School,University,NGO,Embassy,Investor',
        'message' => 'required|string',
    ]);

    App\Models\PartnershipRequest::create($validated);

    return redirect()->back()->with('success', 'Partnership request submitted successfully. We will contact you soon.');
})->name('partnership.request');

// Public Contact Message
Route::post('/contact', function (Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);
    
    $contactMessage = App\Models\ContactMessage::create($validated);
    
    // Send email notification
    try {
        Mail::to('info@lacfontaine.org')->send(new App\Mail\ContactMessageNotification($contactMessage));
    } catch (\Exception $e) {
        \Log::error('Failed to send contact message email: ' . $e->getMessage());
    }

    return redirect()->back()->with('success', 'Message sent successfully. We will get back to you soon.');
})->name('contact.submit');
