<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->courses()->latest()->get();
        return view('instructor.courses.index', compact('courses'));
    }

    public function curriculum(Course $course)
    {
        $this->authorizeInstructor($course);
        $course->load('sections.lessons');
        return view('instructor.courses.curriculum', compact('course'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('instructor.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['instructor_id'] = auth()->id();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        Course::create($data);

        return redirect()->route('instructor.courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        $this->authorizeInstructor($course);
        $categories = Category::all();
        return view('instructor.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorizeInstructor($course);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        $course->update($data);

        return redirect()->route('instructor.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $this->authorizeInstructor($course);

        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        return redirect()->route('instructor.courses.index')->with('success', 'Course deleted successfully.');
    }

    protected function authorizeInstructor(Course $course)
    {
        if ($course->instructor_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
