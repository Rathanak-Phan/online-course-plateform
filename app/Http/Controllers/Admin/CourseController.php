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

    public function toggleStatus(Course $course)
    {
        $course->status = $course->status === 'published' ? 'draft' : 'published';
        $course->save();

        return back()->with('success', 'Course status updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Course deleted successfully.');
    }
}
