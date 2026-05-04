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
            'price' => $course->price,
            'progress' => 0,
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Successfully enrolled in ' . $course->title);
    }
}
