<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $enrolledCourses = $user->enrolledCourses()->withPivot('progress')->latest()->get();
        $latestCourse = $enrolledCourses->first();
        
        // Calculate stats
        $stats = [
            'enrolled_count' => $enrolledCourses->count(),
            'completed_count' => $user->enrollments()->where('progress', 100)->count(),
            // Placeholder for learning hours, in a real app this would be calculated from lesson completions
            'learning_hours' => $enrolledCourses->count() * 12.5, 
        ];

        return view('student.dashboard', compact('enrolledCourses', 'latestCourse', 'stats'));
    }
}
