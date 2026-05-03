<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $this->authorizeInstructor($course);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $course->sections()->create([
            'title' => $request->title,
            'order' => $course->sections()->count() + 1,
        ]);

        return back()->with('success', 'Section added successfully.');
    }

    public function update(Request $request, Section $section)
    {
        $this->authorizeInstructor($section->course);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $section->update($request->only('title'));

        return back()->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        $this->authorizeInstructor($section->course);
        $section->delete();
        return back()->with('success', 'Section deleted successfully.');
    }

    protected function authorizeInstructor(Course $course)
    {
        if ($course->instructor_id !== auth()->id()) {
            abort(403);
        }
    }
}
