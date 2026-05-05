<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

use App\Models\Certificate;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->enrolledCourses()->withPivot(['progress', 'completed_at']);

        if ($request->has('status')) {
            if ($request->status === 'completed') {
                $query->wherePivot('progress', '>=', 100);
            } elseif ($request->status === 'in_progress') {
                $query->wherePivot('progress', '>', 0)->wherePivot('progress', '<', 100);
            }
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $courses = $query->latest()->get();
        return view('student.my-courses', compact('courses'));
    }

    public function unenroll(Course $course)
    {
        auth()->user()->enrolledCourses()->detach($course->id);
        return back()->with('success', 'Successfully unenrolled from the course.');
    }

    public function learn(Course $course, Lesson $lesson = null)
    {
        $user = auth()->user();
        $enrollment = $user->enrolledCourses()->where('course_id', $course->id)->first();

        // Ensure student is enrolled
        if (!$enrollment) {
            return redirect()->route('courses.show', $course->id)->with('error', 'You must be enrolled to access this course.');
        }

        // Use the enrollment course object which has pivot data
        $course = $enrollment;

        $course->load(['sections.lessons' => function($query) {
            $query->orderBy('order');
        }]);

        // If no lesson specified, find the first uncompleted lesson or just the first lesson
        if (!$lesson) {
            $completedLessonIds = auth()->user()->completedLessons()->pluck('lesson_id')->toArray();
            
            foreach ($course->sections as $section) {
                foreach ($section->lessons as $l) {
                    if (!in_array($l->id, $completedLessonIds)) {
                        $lesson = $l;
                        break 2;
                    }
                }
            }

            if (!$lesson) {
                $lesson = $course->sections->first()->lessons->first();
            }
        }

        $completedLessons = auth()->user()->completedLessons()->whereIn('lesson_id', $course->sections->flatMap->lessons->pluck('id'))->pluck('lesson_id')->toArray();
        $certificate = auth()->user()->certificates()->where('course_id', $course->id)->first();

        return view('student.learn', compact('course', 'lesson', 'completedLessons', 'certificate'));
    }

    public function completeLesson(Course $course, Lesson $lesson)
    {
        $user = auth()->user();

        // Mark as complete
        $user->completedLessons()->syncWithoutDetaching([$lesson->id => ['completed_at' => now()]]);

        // Update course progress
        $this->updateProgress($user, $course);

        // Find next lesson
        $nextLesson = null;
        $allLessons = $course->sections->flatMap->lessons->sortBy('order');
        $found = false;
        foreach ($allLessons as $l) {
            if ($found) {
                $nextLesson = $l;
                break;
            }
            if ($l->id === $lesson->id) {
                $found = true;
            }
        }

        if ($nextLesson) {
            return redirect()->route('student.courses.learn', [$course, $nextLesson])->with('success', 'Lesson completed!');
        }

        return redirect()->route('student.courses.learn', $course)->with('success', 'Congratulations! You have completed all lessons in this course.');
    }

    public function certificates()
    {
        $certificates = auth()->user()->certificates()->with('course')->latest()->get();
        return view('student.certificates', compact('certificates'));
    }

    public function downloadCertificate(Course $course)
    {
        $certificate = auth()->user()->certificates()->where('course_id', $course->id)->firstOrFail();
        $theme = request('theme', 'classic');
        
        return view('student.certificate', compact('certificate', 'theme'));
    }

    protected function updateProgress($user, $course)
    {
        $totalLessons = $course->sections->flatMap->lessons->count();
        if ($totalLessons === 0) return;

        $completedCount = $user->completedLessons()
            ->whereIn('lesson_id', $course->sections->flatMap->lessons->pluck('id'))
            ->count();

        $progress = ($completedCount / $totalLessons) * 100;

        $user->enrolledCourses()->updateExistingPivot($course->id, [
            'progress' => $progress,
            'completed_at' => $progress >= 100 ? now() : null
        ]);

        // Issue certificate if completed
        if ($progress >= 100) {
            Certificate::firstOrCreate(
                ['user_id' => $user->id, 'course_id' => $course->id],
                [
                    'certificate_hash' => Str::random(40),
                    'issued_at' => now()
                ]
            );
        }
    }
}
