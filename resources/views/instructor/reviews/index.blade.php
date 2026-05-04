@extends('layouts.instructor')

@section('title', 'Student Reviews - EduPlatform Instructor')

@section('content')
<div x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 50)" 
     x-show="shown" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
    
    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 mb-2 tracking-tight">Student Feedback</h1>
        <p class="text-slate-500 font-medium">Hear what your students have to say about your courses.</p>
    </div>

    <!-- Reviews Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @forelse($reviews as $review)
            <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 group hover:scale-[1.02] transition-all duration-500">
                <div class="flex justify-between items-start mb-6">
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=f8fafc&color=6366f1" class="w-12 h-12 rounded-2xl shadow-sm">
                        <div>
                            <h4 class="text-sm font-black text-slate-900">{{ $review->user->name }}</h4>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="flex gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-amber-400' : 'text-slate-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                </div>
                
                <div class="mb-6">
                    <span class="text-[10px] font-black uppercase text-indigo-600 tracking-widest block mb-2">{{ $review->course->title }}</span>
                    <p class="text-slate-600 font-medium leading-relaxed italic">"{{ $review->comment }}"</p>
                </div>

                <div class="flex justify-end">
                    <button class="px-4 py-2 bg-slate-50 text-slate-400 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all">
                        Reply to Student
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 p-20 text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.921-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 mb-2">No reviews yet</h3>
                <p class="text-slate-400 font-medium">Student feedback will appear here once they complete your courses.</p>
            </div>
        @endforelse
    </div>

    @if($reviews->hasPages())
        <div class="mt-12">
            {{ $reviews->links() }}
        </div>
    @endif
</div>
@endsection
