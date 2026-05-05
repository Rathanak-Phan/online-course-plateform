@extends('layouts.main')

@section('title', $user->name . ' - Instructor Profile')

@section('content')
<div class="bg-slate-50 min-h-screen">
    <!-- Header/Hero -->
    <div class="bg-white border-b border-slate-200 pt-32 pb-16">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="relative">
                    <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=6366f1&color=fff&size=200' }}" 
                         class="w-48 h-48 rounded-[3rem] shadow-2xl border-8 border-white object-cover">
                    @if($user->hasRole('instructor'))
                        <div class="absolute -bottom-2 -right-2 bg-indigo-600 text-white p-3 rounded-2xl shadow-xl">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        </div>
                    @endif
                </div>
                
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-4 mb-4">
                        <span class="px-4 py-1 rounded-full bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest">Instructor</span>
                        <div class="flex items-center gap-1 text-amber-400">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                            <span class="text-slate-400 text-xs font-bold ml-1">(4.9 Rating)</span>
                        </div>
                    </div>
                    
                    <h1 class="text-5xl font-black text-slate-900 mb-4">{{ $user->name }}</h1>
                    <p class="text-xl text-slate-500 font-medium max-w-2xl mb-8 leading-relaxed">
                        {{ $user->headline ?? 'Passionate educator and industry expert dedicated to student success.' }}
                    </p>
                    
                    <div class="flex flex-wrap justify-center md:justify-start gap-6">
                        @if($user->website)
                            <a href="{{ $user->website }}" target="_blank" class="text-slate-400 hover:text-indigo-600 transition-colors"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg></a>
                        @endif
                        @if($user->twitter)
                            <a href="{{ $user->twitter }}" target="_blank" class="text-slate-400 hover:text-indigo-600 transition-colors"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                        @endif
                        @if($user->linkedin)
                            <a href="{{ $user->linkedin }}" target="_blank" class="text-slate-400 hover:text-indigo-600 transition-colors"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container mx-auto px-6 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
            <!-- Bio & Info -->
            <div class="lg:col-span-1">
                <div class="sticky top-32">
                    <h2 class="text-2xl font-black text-slate-900 mb-8">About the Instructor</h2>
                    <div class="prose prose-slate prose-lg max-w-none text-slate-500 font-medium leading-relaxed">
                        {!! nl2br(e($user->bio ?? 'No bio provided yet.')) !!}
                    </div>
                    
                    <div class="mt-12 grid grid-cols-2 gap-4">
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Students</p>
                            <h4 class="text-2xl font-black text-slate-900">{{ number_format($user->courses->sum('enrollments_count')) }}</h4>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Courses</p>
                            <h4 class="text-2xl font-black text-slate-900">{{ $user->courses->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Courses -->
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-black text-slate-900 mb-8">Courses by {{ $user->name }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($user->courses as $course)
                        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all group overflow-hidden">
                            <div class="relative aspect-[16/10] overflow-hidden p-3">
                                <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/600x400?text=' . urlencode($course->title) }}" 
                                     class="w-full h-full object-cover rounded-[2rem] group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute top-6 left-6 px-4 py-1.5 rounded-full bg-white/90 backdrop-blur-md text-[10px] font-black text-indigo-600 uppercase tracking-widest shadow-sm">
                                    {{ $course->category->name ?? 'Course' }}
                                </div>
                            </div>
                            
                            <div class="p-8">
                                <h3 class="text-xl font-black text-slate-900 mb-4 group-hover:text-indigo-600 transition-colors line-clamp-2 h-14">
                                    {{ $course->title }}
                                </h3>
                                
                                <div class="flex items-center gap-6 mb-8 text-slate-400 font-bold text-xs uppercase tracking-widest">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                        {{ $course->enrollments_count }} Students
                                    </div>
                                    <div class="flex items-center gap-2 text-amber-500">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        4.9
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                                    <span class="text-2xl font-black text-slate-900">${{ number_format($course->price, 2) }}</span>
                                    <a href="{{ route('courses.show', $course->id) }}" class="bg-slate-900 text-white px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-indigo-600 transition-all">
                                        View Course
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-100">
                            <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">No courses published yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
