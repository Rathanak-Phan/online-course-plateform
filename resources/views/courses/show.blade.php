@extends('layouts.main')

@section('title', 'Course Title - EduPlatform')

@section('content')
    <!-- Course Header -->
    <div class="bg-slate-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:w-2/3">
                <nav class="flex text-indigo-300 text-sm font-medium mb-6">
                    <a href="/courses" class="hover:text-white transition-colors">Courses</a>
                    <span class="mx-3 opacity-50">/</span>
                    <a href="#" class="hover:text-white transition-colors">Development</a>
                    <span class="mx-3 opacity-50">/</span>
                    <span class="text-white">Web Development</span>
                </nav>
                
                <h1 class="text-4xl lg:text-5xl font-extrabold text-white mb-6 leading-tight">
                    Full-Stack Web Development Bootcamp 2024: From Zero to Hero
                </h1>
                
                <p class="text-xl text-slate-300 mb-8 max-w-3xl">
                    Master HTML, CSS, Javascript, React, Node.js, and more with the most comprehensive web development course on the market.
                </p>

                <div class="flex flex-wrap items-center gap-6 mb-8">
                    <div class="flex items-center gap-4 text-sm font-bold">
                        <div class="flex items-center text-amber-400">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= round($course->averageRating()) ? 'fill-current' : 'text-slate-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="text-amber-600">{{ number_format($course->averageRating(), 1) }}</span>
                        <span class="text-slate-400">({{ $course->reviews->count() }} ratings)</span>
                        <span class="text-slate-400">•</span>
                        <span class="text-slate-600">12,450 students</span>
                    </div>
                    <div class="text-slate-300">
                        Created by <a href="#" class="text-indigo-400 font-bold hover:underline">Dr. Angela Yu</a>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-6 text-sm text-slate-300">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Last updated 04/2024
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h.5A2.5 2.5 0 0018 9.5V8.5a.5.5 0 011 0V5a2 2 0 00-2-2h-2.316a2 2 0 00-1.547.732L11 5" /></svg>
                        English
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-12">
            <div class="lg:w-2/3">
                <!-- What you'll learn -->
                <div class="bg-white border border-slate-200 rounded-2xl p-8 mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">What you'll learn</h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach([
                            'Build 16 web development projects for your portfolio',
                            'Master the latest tools and technologies like React 18',
                            'Learn professional workflow using Git and GitHub',
                            'Design and implement robust RESTful APIs',
                            'Understand database design with MongoDB and SQL',
                            'Deploy your applications to the cloud with ease'
                        ] as $item)
                            <div class="flex gap-3 text-slate-600 text-sm">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                {{ $item }}
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Curriculum -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Course Curriculum</h2>
                    <div class="flex justify-between items-center mb-4 text-sm text-slate-500">
                        <span>32 sections • 456 lectures • 65h 32m total length</span>
                        <button class="font-bold text-indigo-600">Expand all sections</button>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach(['Introduction to Web Development', 'HTML5 Deep Dive', 'CSS3 Layouts and Flexbox', 'Javascript Fundamentals', 'Modern React with Hooks'] as $index => $section)
                            <div class="border border-slate-200 rounded-xl overflow-hidden bg-white">
                                <button class="w-full flex items-center justify-between p-5 bg-slate-50 font-bold text-slate-900 hover:bg-slate-100 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                        {{ $section }}
                                    </div>
                                    <span class="text-xs font-normal text-slate-500">12 lectures • 45m</span>
                                </button>
                                @if($index === 0)
                                    <div class="p-2 space-y-1">
                                        @foreach(['Welcome to the Course', 'How the Internet Works', 'Setting up your Dev Environment'] as $lecture)
                                            <div class="flex items-center justify-between p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                                <div class="flex items-center gap-4 text-sm text-slate-600">
                                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /></svg>
                                                    {{ $lecture }}
                                                </div>
                                                <span class="text-xs text-slate-400">05:23</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Sticky Sidebar Card -->
            <div class="lg:w-1/3">
                <div class="sticky top-24 bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-2xl">
                    <div class="relative aspect-video">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80" alt="Course Preview" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center bg-slate-900/40">
                            <button class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-xl hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-indigo-600 ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" /></svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <div class="flex items-baseline gap-3 mb-6">
                            <span class="text-4xl font-extrabold text-slate-900">$99.99</span>
                            <span class="text-xl text-slate-400 line-through">$199.99</span>
                            <span class="text-indigo-600 font-bold text-sm">50% off</span>
                        </div>
                        
                        <div class="space-y-4">
                            @auth
                                @if(auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists())
                                    <button class="w-full bg-emerald-600 text-white font-bold py-4 rounded-xl cursor-default flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        Enrolled
                                    </button>
                                @elseif(auth()->user()->id === $course->instructor_id)
                                    <a href="{{ route('instructor.courses.curriculum', $course) }}" class="w-full bg-slate-900 text-white text-center font-bold py-4 rounded-xl hover:bg-slate-800 transition-all block">Manage Course</a>
                                @else
                                    @if($course->isPaid())
                                        <form action="{{ route('checkout', $course->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-xl hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-200">Buy Now (${{ number_format($course->price, 2) }})</button>
                                        </form>
                                    @else
                                        <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-xl hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-200">Enroll Now</button>
                                        </form>
                                    @endif
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="w-full bg-indigo-600 text-white text-center font-bold py-4 rounded-xl hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-200 block">
                                    {{ $course->isPaid() ? 'Buy Now' : 'Enroll Now' }}
                                </a>
                            @endauth
                            <button class="w-full border border-slate-200 font-bold py-4 rounded-xl hover:bg-slate-50 transition-all">Add to Cart</button>
                        </div>
                        
                        <p class="text-center text-xs text-slate-400 mt-6">30-Day Money-Back Guarantee</p>
                        
                        <div class="mt-8">
                            <h4 class="font-bold text-slate-900 mb-4">This course includes:</h4>
                            <ul class="space-y-3 text-sm text-slate-600">
                                <li class="flex items-center gap-3">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /></svg>
                                    65 hours on-demand video
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    85 downloadable resources
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                    Access on mobile and TV
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Certificate of completion
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="mt-16 pt-16 border-t border-slate-200" id="reviews">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <h2 class="text-3xl font-black text-slate-900 mb-2">Student Feedback</h2>
                        <div class="flex items-center gap-4">
                            <div class="flex text-amber-400">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 {{ $i <= round($course->averageRating()) ? 'fill-current' : 'text-slate-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <span class="text-2xl font-black text-amber-600">{{ number_format($course->averageRating(), 1) }} Course Rating</span>
                        </div>
                    </div>
                </div>

                @auth
                    @if(auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists() && !$course->reviews()->where('user_id', auth()->id())->exists())
                        <div class="bg-slate-50 rounded-3xl p-10 mb-12 border border-slate-100">
                            <h3 class="text-xl font-bold text-slate-900 mb-6">Write a Review</h3>
                            <form action="{{ route('reviews.store', $course) }}" method="POST" class="space-y-6">
                                @csrf
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Rating</label>
                                    <select name="rating" class="rounded-xl border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 w-full md:w-32">
                                        @for($i = 5; $i >= 1; $i--)
                                            <option value="{{ $i }}">{{ $i }} Stars</option>
                                        @endfor
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Comment</label>
                                    <textarea name="comment" rows="4" class="w-full rounded-2xl border-slate-200 focus:ring-indigo-500 focus:border-indigo-500" placeholder="What did you think of this course?"></textarea>
                                </div>
                                <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-200">Submit Review</button>
                            </form>
                        </div>
                    @endif
                @endauth

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($course->reviews as $review)
                        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm relative group">
                            <div class="flex items-center gap-4 mb-6">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=f1f5f9&color=6366f1" class="w-12 h-12 rounded-full border-2 border-white shadow-sm">
                                <div>
                                    <h4 class="font-bold text-slate-900">{{ $review->user->name }}</h4>
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-amber-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-3 h-3 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @endfor
                                        </div>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-slate-600 leading-relaxed italic">"{{ $review->comment }}"</p>
                            
                            @auth
                                @if($review->user_id === auth()->id() || auth()->user()->hasRole('admin'))
                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="absolute top-8 right-8 opacity-0 group-hover:opacity-100 transition-opacity">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-400 hover:text-rose-600">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-slate-400 font-medium">
                            No reviews yet. Be the first to review this course!
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
