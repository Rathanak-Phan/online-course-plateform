@extends('layouts.student')

@section('title', $lesson->title . ' - ' . $course->title)

@section('content')
    <div class="flex flex-col lg:flex-row h-[calc(100vh-120px)] -m-8 overflow-hidden">
        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col bg-slate-950 overflow-y-auto">
            <!-- Video/Content Player -->
            <div class="aspect-video w-full bg-black relative">
                @if($lesson->video_url)
                    @php
                        $videoId = '';
                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $lesson->video_url, $match)) {
                            $videoId = $match[1];
                        }
                    @endphp
                    @if($videoId)
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @else
                        <video class="w-full h-full" controls src="{{ $lesson->video_url }}"></video>
                    @endif
                @else
                    <div class="w-full h-full flex items-center justify-center text-slate-500">
                        <div class="text-center">
                            <svg class="w-20 h-20 mx-auto mb-4 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                            <p class="font-medium">No video content for this lesson</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Lesson Info -->
            <div class="p-8 lg:p-12 bg-white flex-1">
                <div class="max-w-4xl">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h1 class="text-3xl font-black text-slate-900 mb-2">{{ $lesson->title }}</h1>
                            <p class="text-slate-500 font-medium">{{ $course->title }}</p>
                        </div>
                        <div class="flex flex-col items-end gap-3">
                            <form action="{{ route('student.courses.complete-lesson', [$course, $lesson]) }}" method="POST">
                                @csrf
                                @if(in_array($lesson->id, $completedLessons))
                                    <button type="button" class="flex items-center gap-2 px-6 py-3 bg-emerald-100 text-emerald-700 rounded-xl font-bold text-sm cursor-default">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                        Completed
                                    </button>
                                @else
                                    <button type="submit" class="flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold text-sm hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                                        Mark as Complete
                                    </button>
                                @endif
                            </form>
                            
                            @if($certificate)
                                <a href="{{ route('student.courses.certificate', $course) }}" class="flex items-center gap-2 px-6 py-3 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z" /></svg>
                                    Get Certificate
                                </a>
                            @endif
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                            <span class="text-sm font-bold">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="prose prose-slate max-w-none">
                        {!! $lesson->content !!}
                    </div>

                    @if($lesson->attachment)
                        <div class="mt-12 p-6 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-slate-400 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Lesson Resources</p>
                                    <p class="text-xs text-slate-500">Download attached files for this lesson</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $lesson->attachment) }}" download class="px-6 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-black text-slate-600 hover:bg-slate-50 transition-all shadow-sm">Download</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar Curriculum -->
        <div class="w-full lg:w-96 bg-white border-l border-slate-200 flex flex-col">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-black text-slate-900 uppercase tracking-widest text-xs">Course Content</h3>
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex-1 bg-slate-200 h-1.5 rounded-full overflow-hidden mr-4">
                        <div class="bg-indigo-600 h-full rounded-full" style="width: {{ $course->pivot->progress ?? 0 }}%"></div>
                    </div>
                    <span class="text-xs font-black text-indigo-600">{{ round($course->pivot->progress ?? 0) }}%</span>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto">
                @foreach($course->sections as $section)
                    <div x-data="{ open: true }">
                        <button @click="open = !open" class="w-full flex items-center justify-between p-6 hover:bg-slate-50 transition-all border-b border-slate-50">
                            <span class="font-bold text-sm text-slate-900">{{ $section->title }}</span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div x-show="open" x-collapse>
                            @foreach($section->lessons as $l)
                                <a href="{{ route('student.courses.learn', [$course, $l]) }}" 
                                   class="flex items-center gap-4 p-5 hover:bg-indigo-50/50 transition-all border-b border-slate-50 {{ $lesson->id === $l->id ? 'bg-indigo-50' : '' }}">
                                    <div class="flex-shrink-0">
                                        @if(in_array($l->id, $completedLessons))
                                            <div class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                            </div>
                                        @else
                                            <div class="w-6 h-6 rounded-full border-2 {{ $lesson->id === $l->id ? 'border-indigo-600' : 'border-slate-200' }} flex items-center justify-center text-[10px] font-black {{ $lesson->id === $l->id ? 'text-indigo-600' : 'text-slate-400' }}">
                                                {{ $loop->iteration }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs font-bold {{ $lesson->id === $l->id ? 'text-indigo-600' : 'text-slate-700' }}">{{ $l->title }}</p>
                                        <div class="flex items-center gap-2 mt-1 text-[10px] font-medium text-slate-400">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            15:00
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
