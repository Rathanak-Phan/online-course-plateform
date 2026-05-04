@extends('layouts.main')

@section('title', $course->title . ' - EduPlatform')

@section('content')
    <!-- Course Header -->
    <div class="bg-slate-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:w-2/3">
                <nav class="flex text-indigo-300 text-sm font-medium mb-6">
                    <a href="{{ route('courses.index') }}" class="hover:text-white transition-colors">Courses</a>
                    <span class="mx-3 opacity-50">/</span>
                    <a href="{{ route('courses.index', ['category' => $course->category_id]) }}" class="hover:text-white transition-colors">{{ $course->category->name ?? 'Uncategorized' }}</a>
                    <span class="mx-3 opacity-50">/</span>
                    <span class="text-white">{{ Str::limit($course->title, 30) }}</span>
                </nav>
                
                <h1 class="text-4xl lg:text-5xl font-extrabold text-white mb-6 leading-tight">
                    {{ $course->title }}
                </h1>
                
                <p class="text-xl text-slate-300 mb-8 max-w-3xl">
                    {{ $course->short_description ?? Str::limit(strip_tags($course->description), 160) }}
                </p>

                <div class="flex flex-wrap items-center gap-6 mb-8">
                    <div class="flex items-center gap-4 text-sm font-bold">
                        <div class="flex items-center text-amber-400">
                            @php $avgRating = $course->averageRating(); @endphp
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= round($avgRating) ? 'fill-current' : 'text-slate-600' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="text-amber-500">{{ number_format($avgRating, 1) }}</span>
                        <span class="text-slate-400">({{ $course->reviews->count() }} ratings)</span>
                        <span class="text-slate-600">•</span>
                        <span class="text-slate-300">{{ number_format($course->enrollments_count ?? 0) }} students</span>
                    </div>
                    <div class="text-slate-300">
                        Created by <a href="#" class="text-indigo-400 font-bold hover:underline">{{ $course->instructor->name }}</a>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-6 text-sm text-slate-300">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Last updated {{ $course->updated_at->format('m/Y') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h.5A2.5 2.5 0 0018 9.5V8.5a.5.5 0 011 0V5a2 2 0 00-2-2h-2.316a2 2 0 00-1.547.732L11 5" /></svg>
                        {{ $course->language ?? 'English' }}
                    </div>
                    <div class="flex items-center gap-2 uppercase tracking-widest text-[10px] font-black bg-white/10 px-2 py-1 rounded">
                        {{ $course->level }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-12">
            <div class="lg:w-2/3">
                @if($course->what_will_learn)
                    <!-- What you'll learn -->
                    <div class="bg-white border border-slate-200 rounded-3xl p-10 mb-12 shadow-sm">
                        <h2 class="text-2xl font-black text-slate-900 mb-6">What you'll learn</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach(explode("\n", $course->what_will_learn) as $outcome)
                                @if(trim($outcome))
                                    <div class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                        <span class="text-slate-600 font-medium">{{ trim($outcome) }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Description -->
                <div class="bg-white border border-slate-200 rounded-3xl p-10 mb-12 shadow-sm">
                    <h2 class="text-2xl font-black text-slate-900 mb-6">Course Description</h2>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                        {!! nl2br(e($course->description)) !!}
                    </div>
                </div>

                @if($course->requirements)
                    <!-- Requirements -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-black text-slate-900 mb-6">Requirements</h2>
                        <ul class="list-disc list-inside space-y-3 text-slate-600 font-medium ml-4">
                            @foreach(explode("\n", $course->requirements) as $requirement)
                                @if(trim($requirement))
                                    <li>{{ trim($requirement) }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($course->target_audience)
                    <!-- Target Audience -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-black text-slate-900 mb-6">Who this course is for:</h2>
                        <p class="text-slate-600 font-medium leading-relaxed">
                            {{ $course->target_audience }}
                        </p>
                    </div>
                @endif

                <!-- Curriculum -->
                <div class="mb-12" x-data="{ activeSection: 0 }">
                    <h2 class="text-2xl font-black text-slate-900 mb-6">Course Curriculum</h2>
                    <div class="flex justify-between items-center mb-6 text-sm text-slate-500 font-medium">
                        <span>{{ $course->sections->count() }} sections • {{ $course->sections->sum(fn($s) => $s->lessons->count()) }} lectures</span>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach($course->sections as $index => $section)
                            <div class="border border-slate-200 rounded-2xl overflow-hidden bg-white shadow-sm">
                                <button @click="activeSection = (activeSection === {{ $index }} ? null : {{ $index }})" 
                                        class="w-full flex items-center justify-between p-6 bg-slate-50/50 font-bold text-slate-900 hover:bg-slate-100 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <svg class="w-5 h-5 text-slate-400 transition-transform" :class="activeSection === {{ $index }} ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                        <span class="text-left">{{ $section->title }}</span>
                                    </div>
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $section->lessons->count() }} Lectures</span>
                                </button>
                                <div x-show="activeSection === {{ $index }}" x-collapse class="border-t border-slate-100">
                                    <div class="p-2 space-y-1">
                                        @foreach($section->lessons as $lesson)
                                            <div class="flex items-center justify-between p-4 rounded-xl hover:bg-slate-50 transition-colors group">
                                                <div class="flex items-center gap-4 text-sm font-bold text-slate-600">
                                                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 group-hover:text-indigo-600 group-hover:bg-indigo-50 transition-all">
                                                        @if($lesson->type === 'video')
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0013 8v4a1 1 0 001.553.894l2-1a1 1 0 000-1.788l-2-1z" /></svg>
                                                        @else
                                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                                        @endif
                                                    </div>
                                                    {{ $lesson->title }}
                                                </div>
                                                @if($lesson->is_preview)
                                                    <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-2 py-1 rounded uppercase tracking-widest">Preview</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Sticky Sidebar Card -->
            <div class="lg:w-1/3">
                <div class="sticky top-24 bg-white border border-slate-200 rounded-[32px] overflow-hidden shadow-2xl shadow-slate-200/50">
                    <div class="relative aspect-video">
                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/800x450?text=' . urlencode($course->title) }}" 
                             alt="Course Preview" class="w-full h-full object-cover">
                        @if($course->video_url)
                            <div class="absolute inset-0 flex items-center justify-center bg-slate-900/40 backdrop-blur-[2px]">
                                <button class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform group">
                                    <svg class="w-10 h-10 text-slate-900 ml-1 group-hover:text-indigo-600 transition-colors" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" /></svg>
                                </button>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-10">
                        <div class="flex items-baseline gap-3 mb-8">
                            <span class="text-5xl font-black text-slate-900">${{ number_format($course->price, 2) }}</span>
                            @if($course->discount_price)
                                <span class="text-2xl text-slate-300 line-through">${{ number_format($course->discount_price, 2) }}</span>
                                <span class="bg-rose-100 text-rose-600 px-3 py-1 rounded-full font-black text-xs uppercase tracking-widest">
                                    {{ round((($course->discount_price - $course->price) / $course->discount_price) * 100) }}% OFF
                                </span>
                            @endif
                        </div>
                        
                        <div class="space-y-4">
                            @auth
                                @if(auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists())
                                    <a href="{{ route('student.dashboard') }}" class="w-full bg-emerald-500 text-white text-center font-black py-5 rounded-2xl flex items-center justify-center gap-3 shadow-xl shadow-emerald-100 transition-all hover:bg-emerald-600">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                        CONTINUE LEARNING
                                    </a>
                                @elseif(auth()->user()->id === $course->instructor_id)
                                    <a href="{{ route('instructor.courses.curriculum', $course) }}" class="w-full bg-slate-900 text-white text-center font-black py-5 rounded-2xl hover:bg-slate-800 transition-all block uppercase tracking-widest shadow-xl shadow-slate-200">Manage Course</a>
                                @else
                                    @if($course->isPaid())
                                        <form action="{{ route('checkout', $course->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full bg-indigo-600 text-white font-black py-5 rounded-2xl hover:bg-indigo-700 transition-all shadow-2xl shadow-indigo-200 uppercase tracking-widest">Buy This Course</button>
                                        </form>
                                    @else
                                        <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full bg-indigo-600 text-white font-black py-5 rounded-2xl hover:bg-indigo-700 transition-all shadow-2xl shadow-indigo-200 uppercase tracking-widest">Enroll for Free</button>
                                        </form>
                                    @endif
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="w-full bg-indigo-600 text-white text-center font-black py-5 rounded-2xl hover:bg-indigo-700 transition-all shadow-2xl shadow-indigo-200 block uppercase tracking-widest">
                                    {{ $course->isPaid() ? 'Buy This Course' : 'Enroll for Free' }}
                                </a>
                            @endauth
                            <button class="w-full border-2 border-slate-100 font-black py-5 rounded-2xl hover:bg-slate-50 transition-all text-slate-400 uppercase tracking-widest">Add to Wishlist</button>
                        </div>
                        
                        <div class="mt-10">
                            <h4 class="font-black text-slate-900 text-sm uppercase tracking-widest mb-6">This course includes:</h4>
                            <ul class="space-y-4 text-sm text-slate-500 font-bold">
                                @if($course->duration)
                                    <li class="flex items-center gap-4">
                                        <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        </div>
                                        {{ $course->duration }} on-demand video
                                    </li>
                                @endif
                                <li class="flex items-center gap-4">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /></svg>
                                    </div>
                                    Full Lifetime Access
                                </li>
                                @if($course->has_certificate)
                                    <li class="flex items-center gap-4">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        </div>
                                        Certificate of Completion
                                    </li>
                                @endif
                                <li class="flex items-center gap-4">
                                    <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                    </div>
                                    Access on All Devices
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="mt-16 pt-16 border-t border-slate-100" id="reviews">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight">Student Feedback</h2>
                        <div class="flex items-center gap-6">
                            <div class="text-6xl font-black text-amber-500">{{ number_format($avgRating, 1) }}</div>
                            <div>
                                <div class="flex text-amber-400 mb-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= round($avgRating) ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                                <span class="text-sm font-black text-slate-400 uppercase tracking-widest">Course Rating</span>
                            </div>
                        </div>
                    </div>
                </div>

                @auth
                    @if(auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists() && !$course->reviews()->where('user_id', auth()->id())->exists())
                        <div class="bg-indigo-50/50 rounded-[32px] p-12 mb-16 border border-indigo-100">
                            <h3 class="text-2xl font-black text-slate-900 mb-2">How was your experience?</h3>
                            <p class="text-slate-500 font-medium mb-10">Your feedback helps thousands of students make the right choice.</p>
                            <form action="{{ route('reviews.store', $course) }}" method="POST" class="space-y-8">
                                @csrf
                                <div>
                                    <label class="block text-sm font-black text-slate-700 uppercase tracking-widest mb-4">Your Rating</label>
                                    <div class="flex gap-4">
                                        @for($i = 1; $i <= 5; $i++)
                                            <label class="cursor-pointer group">
                                                <input type="radio" name="rating" value="{{ $i }}" class="peer hidden" {{ $i == 5 ? 'checked' : '' }}>
                                                <div class="w-14 h-14 rounded-2xl bg-white border-2 border-slate-100 flex items-center justify-center text-slate-300 peer-checked:border-indigo-600 peer-checked:text-indigo-600 transition-all font-black shadow-sm group-hover:scale-110">
                                                    {{ $i }}
                                                </div>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-black text-slate-700 uppercase tracking-widest mb-4">Your Feedback</label>
                                    <textarea name="comment" rows="4" 
                                              class="w-full rounded-2xl border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 bg-white p-5 text-slate-900 font-medium outline-none transition-all resize-none" 
                                              placeholder="Tell us what you liked (or didn't like) about this course..."></textarea>
                                </div>
                                <button type="submit" class="bg-slate-900 text-white px-12 py-5 rounded-2xl font-black text-sm hover:bg-slate-800 transition-all shadow-xl shadow-slate-200 uppercase tracking-widest">Post My Review</button>
                            </form>
                        </div>
                    @endif
                @endauth

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    @forelse($course->reviews as $review)
                        <div class="bg-white p-10 rounded-[32px] border border-slate-100 shadow-sm relative group hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500">
                            <div class="flex items-center gap-5 mb-8">
                                <img src="{{ $review->user->profile_photo ? asset('storage/' . $review->user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($review->user->name) . '&background=f1f5f9&color=6366f1' }}" 
                                     class="w-14 h-14 rounded-2xl object-cover shadow-sm">
                                <div>
                                    <h4 class="font-black text-slate-900">{{ $review->user->name }}</h4>
                                    <div class="flex items-center gap-3">
                                        <div class="flex text-amber-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-3 h-3 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @endfor
                                        </div>
                                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-slate-600 leading-relaxed font-medium">"{{ $review->comment }}"</p>
                            
                            @auth
                                @if($review->user_id === auth()->id() || auth()->user()->role->slug === 'admin')
                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="absolute top-10 right-10 opacity-0 group-hover:opacity-100 transition-opacity">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-300 hover:text-rose-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-50 rounded-full text-slate-300 mb-6">
                                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 mb-2">No reviews yet</h3>
                            <p class="text-slate-500 font-medium">Be the first to share your thoughts about this course!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
