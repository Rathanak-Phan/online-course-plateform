<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class PublicCourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with(['category', 'instructor', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->where('status', 'published');

        // Search Keyword
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Category Filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Price Filter
        if ($request->filled('price')) {
            if ($request->price == 'free') {
                $query->where('price', 0);
            } elseif ($request->price == 'paid') {
                $query->where('price', '>', 0);
            }
        }

        // Rating Filter
        if ($request->filled('rating')) {
            $query->having('reviews_avg_rating', '>=', $request->rating);
        }

        $courses = $query->latest()->get();
        $categories = Category::all();
        
        return view('courses.index', compact('courses', 'categories'));
    }

    public function show($id)
    {
        $course = Course::with(['category', 'instructor', 'sections.lessons', 'reviews.user'])->findOrFail($id);
        return view('courses.show', compact('course'));
    }
}
