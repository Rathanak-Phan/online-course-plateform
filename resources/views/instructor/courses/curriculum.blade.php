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
                <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <!-- Section Header -->
                    <div class="p-6 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
                        <div class="flex items-center gap-4">
                            <span class="text-slate-400 font-bold text-[10px] uppercase tracking-[0.2em]">Section {{ $loop->iteration }}</span>
                            <h3 class="font-black text-slate-900 tracking-tight">{{ $section->title }}</h3>
                            <button onclick="toggleModal('edit-section-{{ $section->id }}')" class="p-1.5 text-slate-400 hover:text-indigo-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            </button>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="toggleModal('lesson-modal-{{ $section->id }}')" class="text-xs font-black bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">+ Add Lesson</button>
                            <form action="{{ route('instructor.sections.destroy', $section) }}" method="POST" onsubmit="return confirm('Delete this section and all its lessons?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-700 p-2 rounded-xl border border-rose-100 bg-rose-50/50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Lessons List -->
                    <div class="p-3 space-y-2">
                        @forelse($section->lessons as $lesson)
                            <div class="flex items-center justify-between p-4 rounded-2xl border border-transparent hover:border-slate-100 hover:bg-slate-50/50 transition-all group">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-white border border-slate-100 flex items-center justify-center text-slate-500 shadow-sm">
                                        @if($lesson->type === 'video')
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0013 8v4a1 1 0 001.553.894l2-1a1 1 0 000-1.788l-2-1z" /></svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm tracking-tight">{{ $lesson->title }}</h4>
                                        <div class="flex items-center gap-3 mt-1">
                                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">{{ $lesson->type }}</span>
                                            @if($lesson->attachment)
                                                <span class="text-[10px] font-bold text-indigo-500 flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.414a4 4 0 00-5.656-5.656l-6.415 6.414a6 6 0 108.486 8.486L20.5 13" /></svg>
                                                    Resources
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-all translate-x-2 group-hover:translate-x-0">
                                    <button onclick="toggleModal('edit-lesson-{{ $lesson->id }}')" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-white rounded-xl transition-all shadow-sm border border-transparent hover:border-slate-100">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                    </button>
                                    <form action="{{ route('instructor.lessons.destroy', $lesson) }}" method="POST" onsubmit="return confirm('Delete this lesson?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-white rounded-xl transition-all shadow-sm border border-transparent hover:border-slate-100">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Edit Lesson Modal -->
                            <div id="edit-lesson-{{ $lesson->id }}" class="hidden fixed inset-0 z-[60] overflow-y-auto bg-slate-900/60 backdrop-blur-sm">
                                <div class="flex items-center justify-center min-h-screen p-4">
                                    <div class="bg-white rounded-3xl w-full max-w-2xl p-8 shadow-2xl">
                                        <h3 class="text-2xl font-black text-slate-900 mb-6 tracking-tight">Edit Lesson</h3>
                                        <form action="{{ route('instructor.lessons.update', $lesson) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                            @csrf
                                            @method('PUT')
                                            <div class="grid grid-cols-2 gap-6">
                                                <div class="col-span-2">
                                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Lesson Title</label>
                                                    <input type="text" name="title" value="{{ $lesson->title }}" required class="w-full rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 font-bold transition-all">
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Lesson Type</label>
                                                    <select name="type" class="w-full rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 font-bold transition-all">
                                                        <option value="video" {{ $lesson->type === 'video' ? 'selected' : '' }}>Video Lesson</option>
                                                        <option value="text" {{ $lesson->type === 'text' ? 'selected' : '' }}>Text Content</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Video URL</label>
                                                    <input type="url" name="video_url" value="{{ $lesson->video_url }}" class="w-full rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 font-bold transition-all" placeholder="https://youtube.com/...">
                                                </div>
                                                <div class="col-span-2">
                                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Lesson Content (Markdown/HTML)</label>
                                                    <textarea name="content" rows="6" class="w-full rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 font-medium transition-all">{{ $lesson->content }}</textarea>
                                                </div>
                                                <div class="col-span-2">
                                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Attachment (PDF)</label>
                                                    <div class="mt-1 flex items-center gap-4">
                                                        <input type="file" name="attachment" class="flex-1 text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:tracking-widest file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                                                        @if($lesson->attachment)
                                                            <span class="text-[10px] font-bold text-emerald-500 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100">Has File</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex justify-end gap-4 pt-6 border-t border-slate-100">
                                                <button type="button" onclick="toggleModal('edit-lesson-{{ $lesson->id }}')" class="font-black text-xs uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors">Cancel</button>
                                                <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 shadow-xl shadow-indigo-100 transition-all">Update Lesson</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                </div>
                                <h4 class="font-bold text-slate-900 mb-1 text-sm">No lessons yet</h4>
                                <p class="text-xs text-slate-400 font-medium">Click "+ Add Lesson" to start building this section.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Edit Section Modal -->
                <div id="edit-section-{{ $section->id }}" class="hidden fixed inset-0 z-[60] overflow-y-auto bg-slate-900/60 backdrop-blur-sm">
                    <div class="flex items-center justify-center min-h-screen p-4">
                        <div class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl">
                            <h3 class="text-2xl font-black text-slate-900 mb-6 tracking-tight">Edit Section</h3>
                            <form action="{{ route('instructor.sections.update', $section) }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Section Title</label>
                                    <input type="text" name="title" value="{{ $section->title }}" required class="w-full rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 font-bold transition-all">
                                </div>
                                <div class="flex justify-end gap-4 pt-6 border-t border-slate-100">
                                    <button type="button" onclick="toggleModal('edit-section-{{ $section->id }}')" class="font-black text-xs uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors">Cancel</button>
                                    <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 shadow-xl shadow-indigo-100 transition-all">Update Section</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Add Lesson Modal -->
                <div id="lesson-modal-{{ $section->id }}" class="hidden fixed inset-0 z-[60] overflow-y-auto bg-slate-900/60 backdrop-blur-sm">
                    <div class="flex items-center justify-center min-h-screen p-4">
                        <div class="bg-white rounded-3xl w-full max-w-xl p-8 shadow-2xl">
                            <h3 class="text-2xl font-black text-slate-900 mb-6 tracking-tight">Add New Lesson</h3>
                            <form action="{{ route('instructor.lessons.store', $section) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                <div>
                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Lesson Title</label>
                                    <input type="text" name="title" required class="w-full rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 font-bold transition-all" placeholder="e.g. Introduction to the course">
                                </div>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Lesson Type</label>
                                        <select name="type" class="w-full rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 font-bold transition-all">
                                            <option value="video">Video Lesson</option>
                                            <option value="text">Text Content</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Video URL</label>
                                        <input type="url" name="video_url" class="w-full rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 font-bold transition-all" placeholder="https://youtube.com/...">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Attachment (PDF)</label>
                                    <input type="file" name="attachment" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:tracking-widest file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                                </div>
                                <div class="flex justify-end gap-4 pt-6 border-t border-slate-100">
                                    <button type="button" onclick="toggleModal('lesson-modal-{{ $section->id }}')" class="font-black text-xs uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors">Cancel</button>
                                    <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 shadow-xl shadow-indigo-100 transition-all">Save Lesson</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Add Section Form -->
            <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-100">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    </div>
                    <div>
                        <h3 class="font-black text-slate-900 tracking-tight">Add New Section</h3>
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-widest">Create a new module for your course</p>
                    </div>
                </div>
                <form action="{{ route('instructor.sections.store', $course) }}" method="POST" class="flex gap-4">
                    @csrf
                    <input type="text" name="title" required placeholder="e.g. Advanced Concepts" class="flex-1 rounded-2xl border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 font-bold transition-all px-6">
                    <button type="submit" class="bg-slate-900 text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-slate-800 transition-all shadow-xl shadow-slate-200">Add Section</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
            if (!modal.classList.contains('hidden')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'auto';
            }
        }
    </script>
@endsection
