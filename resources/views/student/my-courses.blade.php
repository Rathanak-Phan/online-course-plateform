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

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-black text-slate-900 mb-2">My Learning</h1>
            <p class="text-slate-500 font-medium">Manage your enrolled courses and track your progress.</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
            <form action="{{ route('student.courses.index') }}" method="GET" class="relative w-full sm:w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search my courses..." class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold">
                <svg class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </form>
            <div class="flex bg-white p-1 rounded-2xl border border-slate-200 shadow-sm">
                <a href="{{ route('student.courses.index') }}" class="px-6 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-all {{ !request('status') ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-400 hover:text-slate-600' }}">All</a>
                <a href="{{ route('student.courses.index', ['status' => 'in_progress']) }}" class="px-6 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-all {{ request('status') === 'in_progress' ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-400 hover:text-slate-600' }}">Learning</a>
                <a href="{{ route('student.courses.index', ['status' => 'completed']) }}" class="px-6 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-all {{ request('status') === 'completed' ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-400 hover:text-slate-600' }}">Completed</a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl mb-8 flex justify-between items-center shadow-sm">
            <span class="font-bold text-sm">{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($courses as $course)
            <div class="group bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden hover:shadow-2xl transition-all duration-500 flex flex-col">
                <div class="relative aspect-video overflow-hidden">
                    <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225?text=' . urlencode($course->title) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3 px-6">
                        <a href="{{ route('student.courses.learn', $course->id) }}" class="flex-1 bg-white text-slate-900 text-center py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-500 delay-75 shadow-xl">Continue</a>
                        
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="p-3 bg-white/20 backdrop-blur-md rounded-xl text-white hover:bg-white/30 transition-all transform translate-y-4 group-hover:translate-y-0 duration-500 delay-150">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 bottom-full mb-2 w-48 bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden py-2">
                                <form action="{{ route('student.courses.unenroll', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to unenroll? All progress will be lost.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-left px-4 py-3 text-xs font-bold text-rose-600 hover:bg-rose-50 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        Unenroll Course
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($course->pivot->progress >= 100)
                        <div class="absolute top-4 left-4 bg-emerald-500 text-white px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-500/20 flex items-center gap-2">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                            Completed
                        </div>
                    @endif
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <div class="mb-6">
                        <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-2">{{ $course->category->name ?? 'Course' }}</p>
                        <h3 class="font-black text-slate-900 leading-tight line-clamp-2 h-12 group-hover:text-indigo-600 transition-colors">{{ $course->title }}</h3>
                    </div>
                    
                    <div class="mt-auto space-y-4">
                        <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest">
                            <span class="text-slate-400">Your Progress</span>
                            <span class="text-indigo-600 bg-indigo-50 px-2 py-1 rounded-lg">{{ round($course->pivot->progress ?? 0) }}%</span>
                        </div>
                        <div class="w-full bg-slate-50 h-3 rounded-full overflow-hidden border border-slate-100 p-0.5">
                            <div class="bg-indigo-600 h-full rounded-full transition-all duration-1000 shadow-[0_0_12px_rgba(79,70,229,0.4)]" style="width: {{ $course->pivot->progress ?? 0 }}%"></div>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-8 border-t border-slate-50 flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($course->instructor->name) }}&background=f1f5f9&color=64748b" class="w-6 h-6 rounded-lg">
                            <span class="text-[10px] font-bold text-slate-400">{{ $course->instructor->name }}</span>
                        </div>
                        <a href="{{ route('student.courses.learn', $course->id) }}" class="flex items-center gap-2 text-[10px] font-black text-slate-900 uppercase tracking-widest group-hover:text-indigo-600 transition-colors">
                            Resume
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-32 text-center bg-white rounded-[3rem] border border-slate-100 shadow-sm">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 text-slate-200">
                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <h3 class="text-2xl font-black text-slate-900 mb-2">No courses found</h3>
                <p class="text-slate-500 mb-10 max-w-sm mx-auto font-medium">Try adjusting your filters or search terms to find what you're looking for.</p>
                <a href="{{ route('courses.index') }}" class="inline-flex bg-slate-900 text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-800 transition-all shadow-2xl shadow-slate-200">Browse Catalog</a>
            </div>
        @endforelse
    </div>
@endsection
