<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/courses', [\App\Http\Controllers\PublicCourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [\App\Http\Controllers\PublicCourseController::class, 'show'])->name('courses.show');

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
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
    
    Route::get('/my-learning', [\App\Http\Controllers\EnrollmentController::class, 'myCourses'])->name('student.my-courses');
    Route::post('/courses/{course}/enroll', [\App\Http\Controllers\EnrollmentController::class, 'enroll'])->name('courses.enroll');
    
    // Stripe Payments
    Route::post('/checkout/{course}', [\App\Http\Controllers\PaymentController::class, 'checkout'])->name('checkout');
    Route::get('/payment/success', [\App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
    
    // Reviews
    Route::post('/courses/{course}/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Wishlist
    Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('student.wishlist');
    Route::post('/wishlist/{course}/toggle', [\App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

Route::middleware(['auth', 'role:instructor'])->prefix('instructor')->name('instructor.')->group(function () {
    Route::get('/dashboard', function () {
        return view('instructor.dashboard');
    })->name('dashboard');
    
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
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/courses', [\App\Http\Controllers\Admin\CourseController::class, 'index'])->name('courses.index');
    Route::delete('/courses/{course}', [\App\Http\Controllers\Admin\CourseController::class, 'destroy'])->name('courses.destroy');
});

require __DIR__.'/auth.php';
