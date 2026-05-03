@extends('layouts.instructor')

@section('title', 'Edit Course - EduPlatform')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <nav class="mb-8">
            <a href="{{ route('instructor.courses.index') }}" class="text-sm font-bold text-indigo-600 hover:underline flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                Back to My Courses
            </a>
        </nav>

        <h1 class="text-3xl font-extrabold text-slate-900 mb-8">Edit Course: {{ $course->title }}</h1>

        <form action="{{ route('instructor.courses.update', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white p-10 rounded-2xl border border-slate-200 shadow-sm">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="title" :value="__('Course Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $course->title)" required autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="category_id" :value="__('Category')" />
                <select id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Course Description')" />
                <textarea id="description" name="description" rows="6" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $course->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="grid grid-cols-2 gap-8">
                <div>
                    <x-input-label for="price" :value="__('Price ($)')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price', $course->price)" step="0.01" required />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="status" :value="__('Status')" />
                    <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $course->status) == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
            </div>

            <div>
                <x-input-label for="thumbnail" :value="__('Course Thumbnail')" />
                @if($course->thumbnail)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" class="w-40 rounded-lg shadow-md border border-slate-200">
                        <p class="text-xs text-slate-400 mt-2">Current Thumbnail</p>
                    </div>
                @endif
                <div class="mt-2 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-xl hover:border-indigo-400 transition-colors cursor-pointer group">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-slate-300 group-hover:text-indigo-400 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-slate-600">
                            <label for="thumbnail" class="relative cursor-pointer bg-white rounded-md font-bold text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                <span>Upload a new file</span>
                                <input id="thumbnail" name="thumbnail" type="file" class="sr-only">
                            </label>
                        </div>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-4">
                <a href="{{ route('instructor.courses.index') }}" class="px-8 py-4 text-slate-600 font-bold hover:text-slate-900">Cancel</a>
                <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-200">Update Course</button>
            </div>
        </form>
    </div>
@endsection
