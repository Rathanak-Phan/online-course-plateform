@extends('layouts.student')

@section('title', 'My Wishlist - EduPlatform')

@section('content')
    <div class="mb-12">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-2">My Wishlist</h1>
        <p class="text-slate-500 font-medium">Courses you've saved to learn later.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-8 flex justify-between items-center">
            <span class="font-medium">{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

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
                <div class="inline-block p-6 rounded-full bg-slate-100 mb-6 text-slate-400">
                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Your wishlist is empty</h3>
                <p class="text-slate-500 mb-8">Save courses you're interested in and they'll show up here.</p>
                <a href="{{ route('courses.index') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition-all">Browse Courses</a>
            </div>
        @endforelse
    </div>
@endsection
