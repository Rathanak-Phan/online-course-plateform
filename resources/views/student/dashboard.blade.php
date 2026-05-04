@extends('layouts.student')

@section('title', 'Dashboard - EduPlatform')

@section('content')
    <div class="mb-12">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h1>
        <p class="text-slate-500 font-medium">You've completed <span class="text-indigo-600 font-bold">{{ $stats['completed_count'] }}</span> courses so far. Keep it up!</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-20 h-20 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Enrolled</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $stats['enrolled_count'] }} Courses</h3>
        </div>
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-20 h-20 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z" /></svg>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Completed</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $stats['completed_count'] }} Certificates</h3>
        </div>
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-20 h-20 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Learning</p>
            <h3 class="text-3xl font-black text-slate-900">{{ number_format($stats['learning_hours'], 1) }} Hours</h3>
        </div>
    </div>

    <!-- Continue Learning Hero -->
    @if($latestCourse)
        <div class="bg-slate-900 rounded-3xl p-8 mb-12 flex flex-col md:flex-row items-center gap-8 shadow-xl shadow-indigo-100 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl -mr-32 -mt-32"></div>
            <div class="w-full md:w-1/3 aspect-video rounded-2xl overflow-hidden shadow-2xl">
                <img src="{{ $latestCourse->thumbnail ? asset('storage/' . $latestCourse->thumbnail) : 'https://placehold.co/400x225?text=' . urlencode($latestCourse->title) }}" class="w-full h-full object-cover">
            </div>
            <div class="flex-1">
                <span class="inline-block px-3 py-1 rounded-lg bg-indigo-500/20 text-indigo-300 text-[10px] font-black uppercase tracking-widest mb-4">In Progress</span>
                <h2 class="text-2xl font-black text-white mb-2 leading-tight">{{ $latestCourse->title }}</h2>
                <p class="text-slate-400 text-sm mb-6">Continue where you left off and reach your goal!</p>
                
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex-1 bg-slate-800 h-2 rounded-full overflow-hidden">
                        <div class="bg-indigo-500 h-full rounded-full" style="width: {{ $latestCourse->pivot->progress ?? 0 }}%"></div>
                    </div>
                    <span class="text-sm font-bold text-white">{{ $latestCourse->pivot->progress ?? 0 }}%</span>
                </div>
                
                <a href="{{ route('courses.show', $latestCourse->id) }}" class="inline-flex items-center gap-3 bg-white text-slate-900 px-8 py-3.5 rounded-xl font-bold hover:bg-slate-100 transition-all">
                    Continue Learning
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </a>
            </div>
        </div>
    @endif

    <!-- My Learning Section -->
    <div>
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-black text-slate-900">My Learning</h2>
            <div class="flex gap-2">
                <button class="px-4 py-2 bg-indigo-600 text-white text-xs font-bold rounded-lg shadow-sm">All Courses</button>
                <button class="px-4 py-2 bg-white text-slate-500 text-xs font-bold rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">In Progress</button>
                <button class="px-4 py-2 bg-white text-slate-500 text-xs font-bold rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">Completed</button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($enrolledCourses as $course)
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all group">
                    <div class="relative aspect-video rounded-xl overflow-hidden mb-6">
                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225?text=' . urlencode($course->title) }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('courses.show', $course->id) }}" class="bg-white text-slate-900 px-6 py-2 rounded-full font-bold text-xs">Resume Learning</a>
                        </div>
                    </div>
                    <h3 class="font-bold text-slate-900 text-sm mb-4 line-clamp-2 h-10">{{ $course->title }}</h3>
                    <div class="w-full bg-slate-50 h-1.5 rounded-full overflow-hidden mb-2">
                        <div class="bg-indigo-600 h-full rounded-full transition-all duration-700" style="width: {{ $course->pivot->progress ?? 0 }}%"></div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] font-bold text-slate-400">{{ $course->pivot->progress ?? 0 }}% Complete</span>
                        <a href="{{ route('courses.show', $course->id) }}" class="text-indigo-600 font-bold text-xs uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">Resume &rarr;</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-3xl border-2 border-dashed border-slate-200">
                    <div class="inline-block p-6 rounded-full bg-slate-50 mb-4 text-slate-400">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">No courses yet</h3>
                    <p class="text-slate-500 mb-8 max-w-sm mx-auto">You haven't enrolled in any courses yet. Start your journey today!</p>
                    <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200">
                        Browse Courses
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </a>
                </div>
            @endforelse
        </div>
    </div>
@endsection

