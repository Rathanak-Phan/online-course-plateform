<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['instructor', 'category'])->latest()->paginate(20);
        return view('admin.courses.index', compact('courses'));
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Course deleted successfully.');
    }
}
