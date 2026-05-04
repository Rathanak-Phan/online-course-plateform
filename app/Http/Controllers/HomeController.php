<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('courses')
            ->orderBy('courses_count', 'desc')
            ->take(6)
            ->get();

        $featuredCourses = Course::with(['instructor', 'category', 'reviews'])
            ->where('status', 'published')
            ->withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->take(4)
            ->get();

        $totalStudents = User::where('role_id', 3)->count(); // Assuming 3 is Student role

        return view('home', compact('categories', 'featuredCourses', 'totalStudents'));
    }
}
