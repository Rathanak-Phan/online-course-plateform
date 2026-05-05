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
                    <span class="text-sm font-bold text-white">{{ round($latestCourse->pivot->progress ?? 0) }}%</span>
                </div>
                
                <a href="{{ route('student.courses.learn', $latestCourse->id) }}" class="inline-flex items-center gap-3 bg-white text-slate-900 px-8 py-3.5 rounded-xl font-bold hover:bg-slate-100 transition-all">
                    Continue Learning
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </a>
            </div>
        </div>
    @endif

    <!-- My Learning Section -->
    <div x-data="{ activeFilter: 'all' }">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-black text-slate-900">My Learning</h2>
            <div class="flex bg-white p-1 rounded-xl border border-slate-200 shadow-sm">
                <button 
                    @click="activeFilter = 'all'" 
                    :class="activeFilter === 'all' ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-400 hover:text-slate-600'"
                    class="px-6 py-2 rounded-lg text-xs font-black uppercase tracking-widest transition-all">
                    All
                </button>
                <button 
                    @click="activeFilter = 'progress'" 
                    :class="activeFilter === 'progress' ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-400 hover:text-slate-600'"
                    class="px-6 py-2 rounded-lg text-xs font-black uppercase tracking-widest transition-all">
                    In Progress
                </button>
                <button 
                    @click="activeFilter = 'completed'" 
                    :class="activeFilter === 'completed' ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-400 hover:text-slate-600'"
                    class="px-6 py-2 rounded-lg text-xs font-black uppercase tracking-widest transition-all">
                    Completed
                </button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($enrolledCourses as $course)
                @php
                    $progress = $course->pivot->progress ?? 0;
                @endphp
                <div 
                    x-show="activeFilter === 'all' || (activeFilter === 'progress' && {{ $progress }} < 100 && {{ $progress }} > 0) || (activeFilter === 'completed' && {{ $progress }} >= 100)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-2xl transition-all group flex flex-col">
                    
                    <div class="relative aspect-video rounded-2xl overflow-hidden mb-6">
                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225?text=' . urlencode($course->title) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-slate-900/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('student.courses.learn', $course->id) }}" class="bg-white text-slate-900 px-8 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-500">Resume</a>
                        </div>
                        @if($progress >= 100)
                            <div class="absolute top-4 left-4 bg-emerald-500 text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg">Completed</div>
                        @endif
                    </div>

                    <div class="mb-6 flex-1">
                        <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-2">{{ $course->category->name ?? 'Course' }}</p>
                        <h3 class="font-black text-slate-900 text-sm leading-tight line-clamp-2 h-10 group-hover:text-indigo-600 transition-colors">{{ $course->title }}</h3>
                    </div>

                    <div class="mt-auto">
                        <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest mb-3">
                            <span class="text-slate-400">Progress</span>
                            <span class="text-indigo-600 bg-indigo-50 px-2 py-1 rounded-lg">{{ round($progress) }}%</span>
                        </div>
                        <div class="w-full bg-slate-50 h-2 rounded-full overflow-hidden mb-6 border border-slate-100 p-0.5">
                            <div class="bg-indigo-600 h-full rounded-full transition-all duration-1000 shadow-[0_0_12px_rgba(79,70,229,0.3)]" style="width: {{ $progress }}%"></div>
                        </div>
                        
                        <div class="flex justify-between items-center pt-6 border-t border-slate-50">
                            <div class="flex items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($course->instructor->name) }}&background=f1f5f9&color=64748b" class="w-6 h-6 rounded-lg">
                                <span class="text-[10px] font-bold text-slate-400">{{ $course->instructor->name }}</span>
                            </div>
                            <a href="{{ route('student.courses.learn', $course->id) }}" class="text-[10px] font-black text-slate-900 uppercase tracking-widest hover:text-indigo-600 transition-colors">
                                Resume &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-100">
                    <div class="inline-block p-6 rounded-full bg-slate-50 mb-4 text-slate-300">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">No courses yet</h3>
                    <p class="text-slate-500 mb-8 max-w-sm mx-auto font-medium">You haven't enrolled in any courses yet. Start your journey today!</p>
                    <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-2xl shadow-indigo-100">
                        Browse Catalog
                    </a>
                </div>
            @endforelse
        </div>
    </div>
@endsection

