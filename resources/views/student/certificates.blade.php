@extends('layouts.student')

@section('title', 'My Certificates - EduPlatform')

@section('content')
    <div class="mb-12">
        <h1 class="text-3xl font-black text-slate-900 mb-2">My Certificates</h1>
        <p class="text-slate-500 font-medium">You've earned {{ $certificates->count() }} certificates so far. Great job!</p>
    </div>

    @if($certificates->isEmpty())
        <div class="bg-white rounded-[3rem] p-16 text-center shadow-sm border border-slate-100">
            <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z" /></svg>
            </div>
            <h2 class="text-2xl font-black text-slate-900 mb-2">No certificates yet</h2>
            <p class="text-slate-500 max-w-sm mx-auto mb-8 font-medium">Complete your first course to earn your official certificate of achievement.</p>
            <a href="{{ route('student.dashboard') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-100">Browse My Courses</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($certificates as $certificate)
                <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-xl transition-all group border border-slate-100">
                    <div class="aspect-[1.414/1] bg-slate-900 relative p-6 flex flex-col items-center justify-center text-center overflow-hidden">
                        <!-- Mini Certificate Preview -->
                        <div class="absolute inset-0 opacity-20 group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 border-[10px] border-white/20 m-4"></div>
                            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500 rounded-full blur-3xl -mr-16 -mt-16"></div>
                        </div>
                        
                        <div class="relative z-10">
                            <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center text-white mb-4 mx-auto border border-white/10">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z" /></svg>
                            </div>
                            <h3 class="text-white font-black text-sm uppercase tracking-widest leading-relaxed px-4">{{ $certificate->course->title }}</h3>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Earned on</p>
                                <p class="text-sm font-black text-slate-900">{{ $certificate->issued_at->format('M d, Y') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Instructor</p>
                                <p class="text-sm font-black text-slate-900">{{ $certificate->course->instructor->name }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-3">
                            <a href="{{ route('student.courses.certificate', $certificate->course_id) }}" target="_blank" class="w-full bg-slate-900 text-white text-center py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-800 transition-all shadow-xl shadow-slate-100 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                View Certificate
                            </a>
                            <div class="flex gap-2">
                                <a href="{{ route('student.courses.certificate', [$certificate->course_id, 'theme' => 'classic']) }}" class="flex-1 bg-white border border-slate-100 text-slate-600 text-center py-3 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-slate-50 transition-all">Classic</a>
                                <a href="{{ route('student.courses.certificate', [$certificate->course_id, 'theme' => 'modern']) }}" class="flex-1 bg-white border border-slate-100 text-slate-600 text-center py-3 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-slate-50 transition-all">Modern</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
