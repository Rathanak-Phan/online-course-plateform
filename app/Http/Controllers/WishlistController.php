<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->wishlistedCourses()->with(['instructor', 'category'])->latest()->get();
        return view('student.wishlist', compact('courses'));
    }

    public function toggle(Course $course)
    {
        $user = auth()->user();
        
        if ($user->wishlistedCourses()->where('course_id', $course->id)->exists()) {
            $user->wishlistedCourses()->detach($course->id);
            $message = 'Course removed from wishlist.';
        } else {
            $user->wishlistedCourses()->attach($course->id);
            $message = 'Course added to wishlist.';
        }

        return back()->with('success', $message);
    }
}
