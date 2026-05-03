@extends('layouts.main')

@section('title', 'Browse Courses - EduPlatform')

@section('content')
    <div class="bg-indigo-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold text-white mb-4">All Courses</h1>
            <nav class="flex text-indigo-200 text-sm font-medium">
                <a href="/" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 opacity-50">/</span>
                <span class="text-white">Courses</span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <form action="{{ route('courses.index') }}" method="GET" class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-64 space-y-8 flex-shrink-0">
                <!-- Search -->
                <div>
                    <h4 class="font-bold text-slate-900 mb-4">Search</h4>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Course title..." class="w-full pl-10 pr-4 py-2 rounded-xl border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <h4 class="font-bold text-slate-900 mb-4">Categories</h4>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} class="border-slate-300 text-indigo-600 focus:ring-indigo-500 w-4 h-4">
                            <span class="text-sm text-slate-600 group-hover:text-indigo-600 transition-colors">All Categories</span>
                        </label>
                        @foreach($categories as $category)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="category" value="{{ $category->id }}" {{ request('category') == $category->id ? 'checked' : '' }} class="border-slate-300 text-indigo-600 focus:ring-indigo-500 w-4 h-4">
                                <span class="text-sm text-slate-600 group-hover:text-indigo-600 transition-colors">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Price -->
                <div>
                    <h4 class="font-bold text-slate-900 mb-4">Price</h4>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="price" value="" {{ !request('price') ? 'checked' : '' }} class="border-slate-300 text-indigo-600 focus:ring-indigo-500 w-4 h-4">
                            <span class="text-sm text-slate-600">All</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="price" value="free" {{ request('price') == 'free' ? 'checked' : '' }} class="border-slate-300 text-indigo-600 focus:ring-indigo-500 w-4 h-4">
                            <span class="text-sm text-slate-600">Free</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="price" value="paid" {{ request('price') == 'paid' ? 'checked' : '' }} class="border-slate-300 text-indigo-600 focus:ring-indigo-500 w-4 h-4">
                            <span class="text-sm text-slate-600">Paid</span>
                        </label>
                    </div>
                </div>

                <!-- Rating -->
                <div>
                    <h4 class="font-bold text-slate-900 mb-4">Ratings</h4>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="rating" value="" {{ !request('rating') ? 'checked' : '' }} class="border-slate-300 text-indigo-600 focus:ring-indigo-500 w-4 h-4">
                            <span class="text-sm text-slate-600">Any Rating</span>
                        </label>
                        @for($r = 4; $r >= 1; $r--)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="rating" value="{{ $r }}" {{ request('rating') == $r ? 'checked' : '' }} class="border-slate-300 text-indigo-600 focus:ring-indigo-500 w-4 h-4">
                                <div class="flex items-center gap-1">
                                    <div class="flex text-amber-400">
                                        @for($j = 1; $j <= 5; $j++)
                                            <svg class="w-3.5 h-3.5 {{ $j <= $r ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                    </div>
                                    <span class="text-xs text-slate-600 font-medium">& Up</span>
                                </div>
                            </label>
                        @endfor
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200 mb-3">Apply Filters</button>
                    <a href="{{ route('courses.index') }}" class="block text-center text-sm font-bold text-slate-400 hover:text-slate-600">Clear All</a>
                </div>
            </aside>

            <!-- Main Listing -->
            <div class="flex-1">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
                    <p class="text-sm font-medium text-slate-500">Showing <span class="text-slate-900">12</span> of <span class="text-slate-900">1.2k</span> results</p>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-slate-500">Sort by:</span>
                        <select class="text-sm font-bold border-none bg-transparent focus:ring-0 text-slate-900 cursor-pointer">
                            <option>Most Popular</option>
                            <option>Highest Rated</option>
                            <option>Newest</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @forelse($courses as $course)
                        <x-course-card 
                            :title="$course->title" 
                            :instructor="$course->instructor->name" 
                            :price="$course->price" 
                            :rating="number_format($course->averageRating(), 1)" 
                            :reviews="$course->reviews->count()" 
                            :image="$course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225?text=' . urlencode($course->title)" 
                            :id="$course->id"
                        />
                    @empty
                        <div class="col-span-full py-24 text-center">
                            <h3 class="text-xl font-bold text-slate-900 mb-2">No courses found</h3>
                            <p class="text-slate-500">Try adjusting your filters or check back later.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-16 flex justify-center gap-2">
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-indigo-600 text-white font-bold">1</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 font-bold hover:border-indigo-600 hover:text-indigo-600 transition-all">2</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 font-bold hover:border-indigo-600 hover:text-indigo-600 transition-all">3</a>
                    <span class="w-10 h-10 flex items-center justify-center text-slate-400">...</span>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 font-bold hover:border-indigo-600 hover:text-indigo-600 transition-all">10</a>
                </div>
            </div>
        </div>
    </div>
@endsection
