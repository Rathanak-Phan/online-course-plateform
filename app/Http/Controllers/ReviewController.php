<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Check if enrolled
        if (!auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'You must be enrolled to review this course.');
        }

        // Check if already reviewed
        if ($course->reviews()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You have already reviewed this course.');
        }

        $course->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }

    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review->update($request->only('rating', 'comment'));

        return back()->with('success', 'Review updated successfully!');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== auth()->id() && !auth()->user()->hasRole('admin')) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Review deleted successfully!');
    }
}
