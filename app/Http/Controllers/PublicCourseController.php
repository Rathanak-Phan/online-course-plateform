<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class PublicCourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with(['category', 'instructor', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->where('status', 'published')
            ->filter($request->only(['search', 'category', 'price', 'rating', 'level', 'sort']))
            ->paginate(12)
            ->withQueryString();

        $categories = Category::withCount(['courses' => function($query) {
            $query->where('status', 'published');
        }])->get();
        
        return view('courses.index', compact('courses', 'categories'));
    }

    public function show($id)
    {
        $course = Course::with(['category', 'instructor', 'sections.lessons', 'reviews.user'])->findOrFail($id);
        return view('courses.show', compact('course'));
    }
}
