<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function store(Request $request, Section $section)
    {
        $this->authorizeInstructor($section->course);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:video,text,quiz,assignment',
            'video_url' => 'nullable|url',
            'attachment' => 'nullable|file|mimes:pdf,zip,doc,docx|max:10240',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title) . '-' . uniqid();
        $data['section_id'] = $section->id;
        $data['order'] = $section->lessons()->count() + 1;

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('lessons/attachments', 'public');
        }

        Lesson::create($data);

        return back()->with('success', 'Lesson added successfully.');
    }

    public function update(Request $request, Lesson $lesson)
    {
        $this->authorizeInstructor($lesson->section->course);

        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
        ]);

        $data = $request->all();
        if ($request->hasFile('attachment')) {
            if ($lesson->attachment) {
                Storage::disk('public')->delete($lesson->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('lessons/attachments', 'public');
        }

        $lesson->update($data);

        return back()->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Lesson $lesson)
    {
        $this->authorizeInstructor($lesson->section->course);
        
        if ($lesson->attachment) {
            Storage::disk('public')->delete($lesson->attachment);
        }
        
        $lesson->delete();
        return back()->with('success', 'Lesson deleted successfully.');
    }

    protected function authorizeInstructor($course)
    {
        if ($course->instructor_id !== auth()->id()) {
            abort(403);
        }
    }
}
