<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCourseAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $course = $request->route('course'); // Assuming the route has {course}

        if (!$course) {
            return $next($request);
        }

        // Allow if user is instructor of the course
        if (auth()->check() && auth()->id() === $course->instructor_id) {
            return $next($request);
        }

        // Allow if course is free (optional logic, usually free courses still need enrollment)
        // For now, let's strictly require enrollment
        if (auth()->check() && auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return $next($request);
        }

        return redirect()->route('courses.show', $course->id)->with('error', 'You must be enrolled to access this content.');
    }
}
