<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with(['instructor', 'category'])
            ->filter($request->only(['search', 'category', 'status']))
            ->latest()
            ->paginate(20)
            ->withQueryString();
            
        $categories = \App\Models\Category::all();
        
        return view('admin.courses.index', compact('courses', 'categories'));
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
