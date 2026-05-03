@extends('layouts.main')

@section('title', 'EduPlatform - Unlock Your Potential')

@section('content')
    <!-- Hero Section -->
    <header class="relative bg-white pt-16 pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="inline-block px-4 py-1.5 rounded-full bg-indigo-50 text-indigo-600 text-sm font-bold mb-6">Learn from the best</span>
                    <h1 class="text-5xl lg:text-7xl font-extrabold text-slate-900 leading-[1.1] mb-8">
                        Unlock Your <span class="gradient-text">Potential</span> with World-Class Courses.
                    </h1>
                    <p class="text-xl text-slate-600 mb-10 leading-relaxed">
                        Join over 25 million learners and start your journey today. High-quality video lessons, hands-on projects, and expert mentorship.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="/courses" class="px-8 py-4 bg-indigo-600 text-white rounded-full font-bold text-lg hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-200">Browse Courses</a>
                        <a href="#" class="px-8 py-4 bg-white text-slate-900 border border-slate-200 rounded-full font-bold text-lg hover:bg-slate-50 transition-all">How it Works</a>
                    </div>
                    
                    <div class="mt-12 flex items-center gap-6">
                        <div class="flex -space-x-3">
                            @for($i = 1; $i <= 4; $i++)
                                <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" src="https://i.pravatar.cc/100?img={{ $i+10 }}" alt="User">
                            @endfor
                        </div>
                        <p class="text-sm text-slate-500 font-medium">Trusted by <span class="text-slate-900 font-bold">10k+</span> students worldwide</p>
                    </div>
                </div>
                
                <div class="relative hidden lg:block">
                    <div class="absolute -top-20 -right-20 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-50 animate-pulse"></div>
                    <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-violet-100 rounded-full blur-3xl opacity-50 animate-pulse delay-700"></div>
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Students learning" class="relative z-10 rounded-3xl shadow-2xl rotate-2">
                </div>
            </div>
        </div>
    </header>

    <!-- Categories Section -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Top Categories</h2>
                    <p class="text-slate-600">Explore our most popular subjects and start learning.</p>
                </div>
                <a href="#" class="text-indigo-600 font-bold hover:underline">View all categories &rarr;</a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @php
                    $categories = [
                        ['name' => 'Development', 'icon' => '💻', 'count' => '1.2k'],
                        ['name' => 'Design', 'icon' => '🎨', 'count' => '850'],
                        ['name' => 'Business', 'icon' => '📈', 'count' => '600'],
                        ['name' => 'Marketing', 'icon' => '🚀', 'count' => '430'],
                        ['name' => 'Music', 'icon' => '🎸', 'count' => '210'],
                        ['name' => 'Photography', 'icon' => '📷', 'count' => '180'],
                    ];
                @endphp
                @foreach($categories as $cat)
                    <a href="#" class="bg-white p-8 rounded-2xl border border-slate-200 text-center hover:border-indigo-500 hover:shadow-xl transition-all group">
                        <span class="text-4xl mb-4 block group-hover:scale-110 transition-transform">{{ $cat['icon'] }}</span>
                        <h4 class="font-bold text-slate-900 mb-1">{{ $cat['name'] }}</h4>
                        <p class="text-xs text-slate-400 font-medium">{{ $cat['count'] }} Courses</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Courses -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Featured Courses</h2>
                <p class="text-slate-600 max-w-2xl mx-auto text-lg">Hand-picked premium content from our expert instructors, designed to help you master new skills.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $featured = [
                        ['title' => 'Full-Stack Web Development Bootcamp 2024', 'instructor' => 'Dr. Angela Yu', 'price' => 99.99, 'rating' => 4.9, 'reviews' => '12.4k', 'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=400&q=80', 'badge' => 'Best Seller'],
                        ['title' => 'Advanced UI/UX Design Mastery', 'instructor' => 'Gary Simon', 'price' => 84.99, 'rating' => 4.8, 'reviews' => '8.2k', 'image' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=400&q=80', 'badge' => 'New'],
                        ['title' => 'Python for Data Science and AI', 'instructor' => 'Jose Portilla', 'price' => 74.99, 'rating' => 4.7, 'reviews' => '25k', 'image' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=400&q=80', 'badge' => null],
                        ['title' => 'Digital Marketing Strategy 2024', 'instructor' => 'Seth Godin', 'price' => 89.99, 'rating' => 4.9, 'reviews' => '5.1k', 'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=400&q=80', 'badge' => 'Popular'],
                    ];
                @endphp
                @foreach($featured as $course)
                    <x-course-card 
                        :title="$course['title']" 
                        :instructor="$course['instructor']" 
                        :price="$course['price']" 
                        :rating="$course['rating']" 
                        :reviews="$course['reviews']" 
                        :image="$course['image']" 
                        :badge="$course['badge']"
                    />
                @endforeach
            </div>
            
            <div class="mt-16 text-center">
                <a href="/courses" class="inline-flex items-center gap-2 text-indigo-600 font-bold text-lg hover:underline">
                    Explore all courses
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
