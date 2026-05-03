<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function enroll(Request $request, Course $course)
    {
        $user = auth()->user();

        // Prevent duplicate enrollment
        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'You are already enrolled in this course.');
        }

        // Create enrollment
        $user->enrollments()->create([
            'course_id' => $course->id,
            'progress' => 0,
        ]);

        return redirect()->route('student.my-courses')->with('success', 'Successfully enrolled in ' . $course->title);
    }

    public function myCourses()
    {
        $courses = auth()->user()->enrolledCourses()->latest()->get();
        return view('student.my-courses', compact('courses'));
    }
}
