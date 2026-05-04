<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $instructorId = auth()->id();
        $courses = Course::where('instructor_id', $instructorId)->get();
        $courseIds = $courses->pluck('id');

        $stats = [
            'total_courses' => $courses->count(),
            'total_students' => Enrollment::whereIn('course_id', $courseIds)->distinct('user_id')->count('user_id'),
            'total_earnings' => OrderItem::whereIn('course_id', $courseIds)
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.status', 'completed')
                ->sum('order_items.price'),
            'recent_enrollments' => Enrollment::with(['user', 'course'])
                ->whereIn('course_id', $courseIds)
                ->latest()
                ->take(5)
                ->get(),
            'top_courses' => Course::where('instructor_id', $instructorId)
                ->withCount('enrollments')
                ->orderBy('enrollments_count', 'desc')
                ->take(3)
                ->get(),
        ];

        return view('instructor.dashboard', compact('stats'));
    }

    public function students()
    {
        $instructorId = auth()->id();
        $courseIds = Course::where('instructor_id', $instructorId)->pluck('id');
        
        $students = Enrollment::with(['user', 'course'])
            ->whereIn('course_id', $courseIds)
            ->latest()
            ->paginate(15);

        return view('instructor.students.index', compact('students'));
    }

    public function earnings()
    {
        $instructorId = auth()->id();
        $courseIds = Course::where('instructor_id', $instructorId)->pluck('id');

        $earnings = OrderItem::with(['order.user', 'course'])
            ->whereIn('course_id', $courseIds)
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->select('order_items.*')
            ->latest()
            ->paginate(15);

        $total_earnings = OrderItem::whereIn('course_id', $courseIds)
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->sum('order_items.price');

        return view('instructor.earnings.index', compact('earnings', 'total_earnings'));
    }

    public function reviews()
    {
        $instructorId = auth()->id();
        $courseIds = Course::where('instructor_id', $instructorId)->pluck('id');

        $reviews = Review::with(['user', 'course'])
            ->whereIn('course_id', $courseIds)
            ->latest()
            ->paginate(15);

        return view('instructor.reviews.index', compact('reviews'));
    }
}
