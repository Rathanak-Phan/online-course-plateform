@extends('layouts.student')

@section('title', 'My Learning - EduPlatform')

@section('content')
    <div class="mb-12">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-2">My Courses</h1>
        <p class="text-slate-500 font-medium">You are currently enrolled in <span class="text-indigo-600 font-bold">{{ $courses->count() }}</span> courses.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-8 flex justify-between items-center">
            <span class="font-medium">{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
        @forelse($courses as $course)
            <div class="group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-xl transition-all duration-300">
                <div class="relative aspect-video overflow-hidden">
                    <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225?text=' . urlencode($course->title) }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('courses.show', $course->id) }}" class="bg-white text-slate-900 px-6 py-2 rounded-full font-bold text-sm">Continue Learning</a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4 gap-4">
                        <h3 class="font-bold text-slate-900 leading-tight line-clamp-2 h-10">{{ $course->title }}</h3>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest text-slate-400">
                            <span>Progress</span>
                            <span class="text-indigo-600">{{ $course->pivot->progress ?? 0 }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-indigo-600 h-full rounded-full transition-all duration-1000" style="width: {{ $course->pivot->progress ?? 0 }}%"></div>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-slate-50 flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-400">Next: Lesson 12</span>
                        <a href="{{ route('courses.show', $course->id) }}" class="text-xs font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-800 transition-colors">Resume</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-24 text-center">
                <div class="inline-block p-6 rounded-full bg-slate-100 mb-6 text-slate-400">
                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">No courses found</h3>
                <p class="text-slate-500 mb-8">Start your learning journey by browsing our catalog.</p>
                <a href="{{ route('courses.index') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition-all">Browse Courses</a>
            </div>
        @endforelse
    </div>
@endsection
