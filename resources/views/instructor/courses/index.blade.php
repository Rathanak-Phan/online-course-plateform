@extends('layouts.instructor')

@section('title', 'My Courses - Instructor Portal')

@section('content')
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">My Courses</h1>
                <p class="mt-2 text-lg text-slate-500 font-medium">Manage, edit, and track your educational content.</p>
            </div>
            <a href="{{ route('instructor.courses.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-8 py-4 rounded-2xl font-black text-sm hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-200 uppercase tracking-widest">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                Create New Course
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl mb-12 flex justify-between items-center shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="bg-emerald-500 text-white p-1 rounded-full">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                    </div>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        @endif

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse($courses as $course)
                <div class="group bg-white rounded-3xl border border-slate-200 overflow-hidden hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500 flex flex-col">
                    <!-- Thumbnail Container -->
                    <div class="relative aspect-video overflow-hidden">
                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/800x450?text=' . urlencode($course->title) }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                            <div class="flex gap-2 w-full">
                                <a href="{{ route('instructor.courses.edit', $course) }}" class="flex-1 bg-white/20 backdrop-blur-md text-white text-center py-2.5 rounded-xl text-xs font-bold hover:bg-white/40 transition-all border border-white/30">Edit Details</a>
                                <a href="{{ route('instructor.courses.curriculum', $course) }}" class="flex-1 bg-white text-slate-900 text-center py-2.5 rounded-xl text-xs font-bold hover:bg-slate-100 transition-all">Curriculum</a>
                            </div>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1.5 bg-white/90 backdrop-blur-sm rounded-lg text-[10px] font-black uppercase tracking-widest text-slate-900 shadow-sm">
                                {{ $course->category->name ?? 'Uncategorized' }}
                            </span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm {{ $course->status === 'published' ? 'bg-emerald-500 text-white' : 'bg-slate-900 text-white' }}">
                                {{ $course->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex-1">
                            <h3 class="text-xl font-black text-slate-900 leading-tight group-hover:text-indigo-600 transition-colors line-clamp-2 mb-2">{{ $course->title }}</h3>
                            <div class="flex items-center gap-4 text-xs font-bold text-slate-400 mb-6">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Updated {{ $course->updated_at->diffForHumans() }}
                                </div>
                                <div class="flex items-center gap-1.5 uppercase tracking-widest">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                                    {{ $course->level }}
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                            <div class="text-2xl font-black text-slate-900">${{ number_format($course->price, 2) }}</div>
                            <div class="flex items-center gap-1">
                                <form action="{{ route('instructor.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-300 hover:text-rose-500 transition-colors" title="Delete Course">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                                <a href="{{ route('instructor.courses.edit', $course) }}" class="p-2 text-slate-300 hover:text-indigo-600 transition-colors" title="Settings">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-slate-100 rounded-full text-slate-300 mb-6">
                        <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2">No courses yet</h3>
                    <p class="text-slate-500 font-medium mb-8">Ready to share your knowledge with the world?</p>
                    <a href="{{ route('instructor.courses.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black text-sm hover:bg-indigo-700 transition-all">Create Your First Course</a>
                </div>
            @endforelse
        </div>
    </div>
@endsection

