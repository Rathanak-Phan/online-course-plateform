@extends('layouts.instructor')

@section('title', 'Manage Curriculum - ' . $course->title)

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <nav class="mb-8 flex justify-between items-center">
            <a href="{{ route('instructor.courses.index') }}" class="text-sm font-bold text-indigo-600 hover:underline flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                Back to Courses
            </a>
            <div class="flex gap-4">
                <a href="{{ route('courses.show', $course->id) }}" target="_blank" class="text-sm font-bold text-slate-600 hover:text-slate-900">Preview Course</a>
            </div>
        </nav>

        <div class="mb-12">
            <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Curriculum Builder</h1>
            <p class="text-slate-500">Organize your course content into sections and lessons.</p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-xl mb-8 flex justify-between items-center shadow-sm">
                <span class="font-bold text-sm">{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-50 border border-rose-100 text-rose-700 px-6 py-4 rounded-xl mb-8 flex justify-between items-center shadow-sm">
                <span class="font-bold text-sm">{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-rose-400 hover:text-rose-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        @endif

        <!-- Sections & Lessons -->
        <div class="space-y-8">
            @foreach($course->sections as $section)
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    <!-- Section Header -->
                    <div class="p-6 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
                        <div class="flex items-center gap-4">
                            <span class="text-slate-400 font-bold text-xs uppercase tracking-widest">Section {{ $loop->iteration }}</span>
                            <h3 class="font-black text-slate-900">{{ $section->title }}</h3>
                        </div>
                        <div class="flex gap-3">
                            <button onclick="toggleModal('lesson-modal-{{ $section->id }}')" class="text-xs font-bold bg-indigo-600 text-white px-3 py-1.5 rounded-lg hover:bg-indigo-700 transition-all">+ Add Lesson</button>
                            <form action="{{ route('instructor.sections.destroy', $section) }}" method="POST" onsubmit="return confirm('Delete this section and all its lessons?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 p-1.5 rounded-lg border border-rose-100 bg-rose-50">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Lessons List -->
                    <div class="p-2 space-y-1">
                        @forelse($section->lessons as $lesson)
                            <div class="flex items-center justify-between p-4 rounded-xl hover:bg-slate-50 transition-colors group">
                                <div class="flex items-center gap-4">
                                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500">
                                        @if($lesson->type === 'video')
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0013 8v4a1 1 0 001.553.894l2-1a1 1 0 000-1.788l-2-1z" /></svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">{{ $lesson->title }}</h4>
                                        @if($lesson->attachment)
                                            <span class="text-[10px] font-medium text-indigo-500">📎 Includes Resources</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <form action="{{ route('instructor.lessons.destroy', $lesson) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-rose-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center text-slate-400 text-sm">
                                No lessons yet. Click "+ Add Lesson" to start.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Lesson Modal Placeholder -->
                <div id="lesson-modal-{{ $section->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm">
                    <div class="flex items-center justify-center min-h-screen p-4">
                        <div class="bg-white rounded-2xl w-full max-w-xl p-8 shadow-2xl">
                            <h3 class="text-2xl font-bold text-slate-900 mb-6">Add New Lesson</h3>
                            <form action="{{ route('instructor.lessons.store', $section) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Lesson Title</label>
                                    <input type="text" name="title" required class="w-full rounded-xl border-slate-200 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Lesson Type</label>
                                    <select name="type" class="w-full rounded-xl border-slate-200 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="video">Video Lesson</option>
                                        <option value="text">Text Content</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Video URL (YouTube/Vimeo)</label>
                                    <input type="url" name="video_url" class="w-full rounded-xl border-slate-200 focus:ring-indigo-500 focus:border-indigo-500" placeholder="https://youtube.com/...">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Attachment (PDF)</label>
                                    <input type="file" name="attachment" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                </div>
                                <div class="flex justify-end gap-4 pt-6 border-t border-slate-100">
                                    <button type="button" onclick="toggleModal('lesson-modal-{{ $section->id }}')" class="font-bold text-slate-600">Cancel</button>
                                    <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 shadow-xl shadow-indigo-200">Save Lesson</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Add Section Form -->
            <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-8">
                <h3 class="font-bold text-indigo-900 mb-4">Add New Section</h3>
                <form action="{{ route('instructor.sections.store', $course) }}" method="POST" class="flex gap-4">
                    @csrf
                    <input type="text" name="title" required placeholder="e.g. Getting Started" class="flex-1 rounded-xl border-slate-200 focus:ring-indigo-500 focus:border-indigo-500">
                    <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-200">Add Section</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
        }
    </script>
@endsection
