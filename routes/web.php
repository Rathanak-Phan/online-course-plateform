<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/courses', [\App\Http\Controllers\PublicCourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [\App\Http\Controllers\PublicCourseController::class, 'show'])->name('courses.show');
Route::get('/verify-certificate/{hash}', [\App\Http\Controllers\CertificateController::class, 'verify'])->name('certificates.verify');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Role-based Route Groups
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [\App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
    

    Route::post('/courses/{course}/enroll', [\App\Http\Controllers\EnrollmentController::class, 'enroll'])->name('courses.enroll');
    
    // Stripe Payments
    Route::post('/checkout/{course}', [\App\Http\Controllers\PaymentController::class, 'checkout'])->name('checkout');
    Route::get('/payment/success', [\App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/fake/{course}', [\App\Http\Controllers\PaymentController::class, 'fakePayment'])->name('payment.fake');
    Route::post('/payment/fake/{course}/process', [\App\Http\Controllers\PaymentController::class, 'processFakePayment'])->name('payment.fake.process');
    
    // Reviews
    Route::post('/courses/{course}/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Learning
    Route::get('/my-courses', [\App\Http\Controllers\Student\CourseController::class, 'index'])->name('student.courses.index');
    Route::get('/student/courses/{course}/learn/{lesson?}', [\App\Http\Controllers\Student\CourseController::class, 'learn'])->name('student.courses.learn');
    Route::post('/student/courses/{course}/lessons/{lesson}/complete', [\App\Http\Controllers\Student\CourseController::class, 'completeLesson'])->name('student.courses.complete-lesson');
    Route::get('/student/courses/{course}/certificate', [\App\Http\Controllers\Student\CourseController::class, 'downloadCertificate'])->name('student.courses.certificate');
    Route::get('/student/certificates', [\App\Http\Controllers\Student\CourseController::class, 'certificates'])->name('student.certificates');
    Route::delete('/student/courses/{course}/unenroll', [\App\Http\Controllers\Student\CourseController::class, 'unenroll'])->name('student.courses.unenroll');

    // Wishlist
    Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('student.wishlist');
    Route::post('/wishlist/{course}/toggle', [\App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

Route::middleware(['auth', 'role:instructor'])->prefix('instructor')->name('instructor.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Instructor\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/students', [\App\Http\Controllers\Instructor\DashboardController::class, 'students'])->name('students');
    Route::get('/earnings', [\App\Http\Controllers\Instructor\DashboardController::class, 'earnings'])->name('earnings');
    Route::get('/reviews', [\App\Http\Controllers\Instructor\DashboardController::class, 'reviews'])->name('reviews');
    
    Route::resource('courses', \App\Http\Controllers\Instructor\CourseController::class);
    Route::get('courses/{course}/curriculum', [\App\Http\Controllers\Instructor\CourseController::class, 'curriculum'])->name('courses.curriculum');
    
    // Sections & Lessons
    Route::post('courses/{course}/sections', [\App\Http\Controllers\Instructor\SectionController::class, 'store'])->name('sections.store');
    Route::put('sections/{section}', [\App\Http\Controllers\Instructor\SectionController::class, 'update'])->name('sections.update');
    Route::delete('sections/{section}', [\App\Http\Controllers\Instructor\SectionController::class, 'destroy'])->name('sections.destroy');
    
    Route::post('sections/{section}/lessons', [\App\Http\Controllers\Instructor\LessonController::class, 'store'])->name('lessons.store');
    Route::put('lessons/{lesson}', [\App\Http\Controllers\Instructor\LessonController::class, 'update'])->name('lessons.update');
    Route::delete('lessons/{lesson}', [\App\Http\Controllers\Instructor\LessonController::class, 'destroy'])->name('lessons.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/transactions', [\App\Http\Controllers\Admin\DashboardController::class, 'transactions'])->name('transactions');
    Route::get('/settings', [\App\Http\Controllers\Admin\DashboardController::class, 'settings'])->name('settings');
    Route::post('/settings/update', [\App\Http\Controllers\Admin\DashboardController::class, 'updateSettings'])->name('settings.update');
    Route::post('/payment-mode/toggle', [\App\Http\Controllers\Admin\DashboardController::class, 'togglePaymentMode'])->name('payment-mode.toggle');
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::patch('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    
    Route::get('/courses', [\App\Http\Controllers\Admin\CourseController::class, 'index'])->name('courses.index');
    Route::patch('/courses/{course}/toggle-status', [\App\Http\Controllers\Admin\CourseController::class, 'toggleStatus'])->name('courses.toggle-status');
    Route::delete('/courses/{course}', [\App\Http\Controllers\Admin\CourseController::class, 'destroy'])->name('courses.destroy');
    
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
});

Route::get('/auth/google', [\App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';
