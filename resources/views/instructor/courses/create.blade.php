@extends('layouts.instructor')

@section('title', 'Create New Course - EduPlatform')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs & Header -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <div>
                        <a href="{{ route('instructor.courses.index') }}" class="text-slate-400 hover:text-slate-500 transition-colors">
                            <span class="text-sm font-medium">My Courses</span>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" />
                        </svg>
                        <span class="ml-4 text-sm font-bold text-slate-900">Create New Course</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mb-12">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Launch Your Course</h1>
            <p class="mt-2 text-lg text-slate-500 font-medium">Fill in the details below to start building your educational masterpiece.</p>
        </div>

        <form action="{{ route('instructor.courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
            @csrf

            <!-- Basic Info Section -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-50 bg-slate-50/50">
                    <h2 class="text-xl font-black text-slate-900">Basic Information</h2>
                    <p class="text-sm text-slate-500 font-medium">This information will be displayed on the course landing page.</p>
                </div>
                <div class="p-8 space-y-8">
                    <div class="space-y-2">
                        <label for="title" class="text-sm font-bold text-slate-700 ml-1">Course Title</label>
                        <input id="title" name="title" type="text" 
                               class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" 
                               placeholder="e.g. Mastering Advanced UI Design" required autofocus />
                        @if($errors->has('title'))
                            <p class="text-xs font-bold text-rose-500 mt-2 ml-1">{{ $errors->first('title') }}</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="category_id" class="text-sm font-bold text-slate-700 ml-1">Category</label>
                            <div class="relative">
                                <select id="category_id" name="category_id" 
                                        class="appearance-none block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none cursor-pointer">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="level" class="text-sm font-bold text-slate-700 ml-1">Target Level</label>
                            <div class="relative">
                                <select id="level" name="level" 
                                        class="appearance-none block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none cursor-pointer">
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                    <option value="all">All Levels</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="text-sm font-bold text-slate-700 ml-1">Course Description</label>
                        <textarea id="description" name="description" rows="6" 
                                  class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none resize-none" 
                                  placeholder="What is your course about? Be as descriptive as possible."></textarea>
                    </div>
                </div>
            </div>

            <!-- Media & Pricing Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-8 border-b border-slate-50 bg-slate-50/50">
                        <h2 class="text-xl font-black text-slate-900">Thumbnail</h2>
                        <p class="text-sm text-slate-500 font-medium">Upload a high-quality cover image.</p>
                    </div>
                    <div class="p-8 flex-1 flex flex-col justify-center">
                        <div class="relative group" x-data="{ photoPreview: null }">
                            <div class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-slate-200 border-dashed rounded-3xl hover:border-indigo-400 transition-all cursor-pointer bg-slate-50/50"
                                 @click="$refs.thumbnailInput.click()">
                                <div class="space-y-4 text-center">
                                    <template x-if="!photoPreview">
                                        <div class="mx-auto h-16 w-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-slate-400 group-hover:text-indigo-600 transition-colors">
                                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg>
                                        </div>
                                    </template>
                                    <img x-show="photoPreview" :src="photoPreview" class="mx-auto h-32 w-full object-cover rounded-2xl shadow-lg border-2 border-white" style="display: none;">
                                    
                                    <div class="text-sm text-slate-600">
                                        <span class="font-black text-indigo-600 hover:text-indigo-500">Upload thumbnail</span>
                                        <p class="mt-1 text-slate-400 font-medium">PNG, JPG, WebP up to 5MB</p>
                                    </div>
                                    <input id="thumbnail" name="thumbnail" type="file" class="sr-only" x-ref="thumbnailInput"
                                           @change="
                                                const file = $event.target.files[0];
                                                if (file) {
                                                    const reader = new FileReader();
                                                    reader.onload = (e) => { photoPreview = e.target.result; };
                                                    reader.readAsDataURL(file);
                                                }
                                           ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-slate-50 bg-slate-50/50">
                        <h2 class="text-xl font-black text-slate-900">Pricing & Status</h2>
                        <p class="text-sm text-slate-500 font-medium">Set your price and visibility.</p>
                    </div>
                    <div class="p-8 space-y-8">
                        <div class="space-y-2">
                            <label for="price" class="text-sm font-bold text-slate-700 ml-1">Price ($)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-5 flex items-center text-slate-400 font-bold">$</span>
                                <input id="price" name="price" type="number" step="0.01" 
                                       class="block w-full pl-10 pr-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-black focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" 
                                       value="{{ old('price', 0.00) }}" required />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="status" class="text-sm font-bold text-slate-700 ml-1">Course Status</label>
                            <div class="flex gap-4 p-2 bg-slate-50 rounded-2xl border border-slate-100">
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="status" value="draft" class="peer hidden" checked>
                                    <div class="text-center py-3 rounded-xl font-black text-xs uppercase tracking-widest text-slate-400 peer-checked:bg-white peer-checked:text-indigo-600 peer-checked:shadow-sm transition-all border border-transparent peer-checked:border-slate-100">
                                        Draft
                                    </div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="status" value="published" class="peer hidden">
                                    <div class="text-center py-3 rounded-xl font-black text-xs uppercase tracking-widest text-slate-400 peer-checked:bg-white peer-checked:text-emerald-600 peer-checked:shadow-sm transition-all border border-transparent peer-checked:border-slate-100">
                                        Publish
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="pt-12 border-t border-slate-200 flex items-center justify-between">
                <button type="button" onclick="history.back()" class="text-sm font-black text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-colors">Discard Changes</button>
                <div class="flex gap-4">
                    <button type="submit" name="action" value="draft" class="px-8 py-4 rounded-2xl font-black text-sm text-slate-600 hover:bg-slate-100 transition-all uppercase tracking-widest">Save as Draft</button>
                    <button type="submit" class="px-12 py-4 bg-slate-900 text-white rounded-2xl font-black text-sm hover:bg-slate-800 transition-all shadow-xl shadow-slate-200 uppercase tracking-widest">Create Course &rarr;</button>
                </div>
            </div>
        </form>
    </div>
@endsection

