@extends('layouts.admin')

@section('title', 'Manage Courses - EduPlatform Admin')

@section('content')
    <div class="mb-12 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-slate-900 mb-2 tracking-tight">Course Repository</h1>
            <p class="text-slate-500 font-medium">Review, moderate, and manage all educational content.</p>
        </div>
        <div class="flex gap-4">
            <select class="pl-4 pr-10 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all appearance-none">
                <option>All Categories</option>
            </select>
            <div class="relative">
                <input type="text" placeholder="Search courses..." class="pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all w-64">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 shadow-sm shadow-emerald-100/50">
            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            <span class="font-bold text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/40 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/50 border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                    <tr>
                        <th class="px-8 py-5">Course Details</th>
                        <th class="px-8 py-5">Instructor</th>
                        <th class="px-8 py-5 text-center">Status</th>
                        <th class="px-8 py-5 text-center">Pricing</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($courses as $course)
                        <tr class="hover:bg-slate-50/80 transition-all duration-300 group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-5">
                                    <div class="relative group-hover:scale-105 transition-transform duration-500">
                                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225?text=' . urlencode($course->title) }}" 
                                             class="w-24 aspect-video rounded-xl object-cover shadow-sm ring-2 ring-white">
                                        <div class="absolute inset-0 bg-slate-900/10 rounded-xl group-hover:bg-transparent transition-colors"></div>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-900 leading-tight mb-1">{{ $course->title }}</p>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded uppercase tracking-widest">{{ $course->category->name ?? 'Uncategorized' }}</span>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $course->level }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($course->instructor->name) }}&background=f1f5f9&color=6366f1" class="w-7 h-7 rounded-lg">
                                    <span class="text-xs font-bold text-slate-600">{{ $course->instructor->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <form action="{{ route('admin.courses.toggle-status', $course) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest border transition-all
                                        {{ $course->status === 'published' ? 'bg-emerald-50 text-emerald-600 border-emerald-100 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-100' : 'bg-slate-50 text-slate-400 border-slate-100 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-100' }}">
                                        {{ $course->status === 'published' ? 'Published' : 'Draft' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <p class="text-sm font-black text-slate-900">${{ number_format($course->price, 2) }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">{{ $course->enrollments()->count() }} Enrolled</p>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('courses.show', $course->id) }}" target="_blank" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </a>
                                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Archive this course repository?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-300 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-8 bg-slate-50/50 border-t border-slate-100">
            {{ $courses->links() }}
        </div>
    </div>
@endsection
