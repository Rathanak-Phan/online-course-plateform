@extends('layouts.instructor')

@section('title', 'Instructor Insights - EduPlatform')

@section('content')
    <div class="mb-12 flex justify-between items-end"
         x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 50)" 
         x-show="shown" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
        <div>
            <h1 class="text-4xl font-black text-slate-900 mb-2 tracking-tight">Instructor Dashboard</h1>
            <p class="text-slate-500 font-medium">Empowering your teaching journey with data.</p>
        </div>
        <a href="{{ route('instructor.courses.create') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 hover:scale-105 transition-all shadow-xl shadow-indigo-100 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
            Create New Course
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 group hover:scale-[1.02] hover:shadow-2xl transition-all duration-500">
            <div class="flex items-center gap-6 mb-8">
                <div class="w-16 h-16 bg-indigo-50 rounded-[24px] text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Courses</p>
                    <h3 class="text-4xl font-black text-slate-900 tracking-tight">{{ number_format($stats['total_courses']) }}</h3>
                </div>
            </div>
            <div class="flex items-center text-xs font-bold text-emerald-600 gap-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                <span>Active Content</span>
            </div>
        </div>

        <div class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 group hover:scale-[1.02] hover:shadow-2xl transition-all duration-500">
            <div class="flex items-center gap-6 mb-8">
                <div class="w-16 h-16 bg-emerald-50 rounded-[24px] text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
                <div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Students</p>
                    <h3 class="text-4xl font-black text-slate-900 tracking-tight">{{ number_format($stats['total_students']) }}</h3>
                </div>
            </div>
            <div class="flex items-center text-xs font-bold text-emerald-600 gap-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                <span>Growing Community</span>
            </div>
        </div>

        <div class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 group hover:scale-[1.02] hover:shadow-2xl transition-all duration-500">
            <div class="flex items-center gap-6 mb-8">
                <div class="w-16 h-16 bg-amber-50 rounded-[24px] text-amber-600 flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-all duration-500">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Revenue</p>
                    <h3 class="text-4xl font-black text-slate-900 tracking-tight">${{ number_format($stats['total_earnings'], 2) }}</h3>
                </div>
            </div>
            <div class="flex items-center text-xs font-bold text-emerald-600 gap-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                <span>Net Earnings</span>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-16">
        <!-- Top Performing Courses -->
        <div class="lg:col-span-2 space-y-8">
            <div class="flex justify-between items-end px-2">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Your Courses</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Manage your catalog</p>
                </div>
                <a href="{{ route('instructor.courses.index') }}" class="px-4 py-2 bg-slate-50 text-indigo-600 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-50 transition-all">Manage All</a>
            </div>
            
            <div class="bg-white rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50 border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-6">Course Content</th>
                            <th class="px-8 py-6 text-center">Enrollments</th>
                            <th class="px-8 py-6 text-right">Revenue</th>
                            <th class="px-8 py-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($stats['top_courses'] as $course)
                            <tr class="hover:bg-slate-50/50 transition-all group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-5">
                                        <div class="relative">
                                            <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225?text=' . urlencode($course->title) }}" 
                                                 class="w-20 aspect-video rounded-2xl object-cover shadow-sm group-hover:scale-105 transition-transform duration-500">
                                            <div class="absolute inset-0 bg-slate-900/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                        </div>
                                        <div>
                                            <span class="text-[10px] font-black uppercase text-indigo-600 tracking-widest">{{ $course->category->name ?? 'Course' }}</span>
                                            <h4 class="text-sm font-black text-slate-900 mt-0.5">{{ $course->title }}</h4>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="px-4 py-2 bg-slate-50 rounded-xl text-xs font-black text-slate-900">{{ number_format($course->enrollments_count) }}</span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <span class="text-base font-black text-slate-900">${{ number_format($course->enrollments_count * $course->price, 2) }}</span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('instructor.courses.edit', $course) }}" class="inline-flex items-center justify-center w-10 h-10 bg-slate-50 text-slate-400 hover:bg-indigo-600 hover:text-white rounded-xl transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Enrollments -->
        <div class="space-y-8">
            <div class="flex justify-between items-end px-2">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Recent Students</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Who's learning now</p>
                </div>
                <a href="{{ route('instructor.students') }}" class="text-indigo-600 font-bold text-xs hover:underline">View All</a>
            </div>
            <div class="bg-white rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 p-10 space-y-8">
                @forelse($stats['recent_enrollments'] as $enrollment)
                    <div class="flex items-center gap-5 group">
                        <div class="relative shrink-0">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($enrollment->user->name) }}&background=f8fafc&color=6366f1" 
                                 class="w-14 h-14 rounded-2xl shadow-sm group-hover:scale-105 transition-transform">
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full border-4 border-white bg-emerald-500"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-black text-slate-900 group-hover:text-indigo-600 transition-colors truncate">{{ $enrollment->user->name }}</p>
                            <p class="text-xs text-slate-400 font-medium truncate">{{ $enrollment->course->title }}</p>
                        </div>
                        <div class="text-right shrink-0">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">{{ $enrollment->created_at->diffForHumans(null, true) }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <h3 class="text-lg font-black text-slate-900 mb-1">Waiting for students</h3>
                        <p class="text-xs text-slate-400 font-medium">Promote your courses to see growth!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

