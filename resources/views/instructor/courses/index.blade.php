@extends('layouts.instructor')

@section('title', 'My Courses - Instructor Portal')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 mb-2">My Courses</h1>
                <p class="text-slate-500">Manage and update your educational content.</p>
            </div>
            <a href="{{ route('instructor.courses.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 transition-all">Create New Course</a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-8 flex justify-between items-center">
                <span class="font-medium">{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Course</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Category</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Price</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($courses as $course)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225?text=No+Thumbnail' }}" class="w-20 aspect-video object-cover rounded-lg">
                                    <span class="font-bold text-slate-900">{{ $course->title }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-sm text-slate-600">{{ $course->category->name ?? 'N/A' }}</td>
                            <td class="px-8 py-6 font-bold text-slate-900">${{ number_format($course->price, 2) }}</td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $course->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $course->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex gap-4">
                                    <a href="{{ route('instructor.courses.curriculum', $course) }}" class="text-emerald-600 hover:text-emerald-800 font-bold text-sm">Curriculum</a>
                                    <a href="{{ route('instructor.courses.edit', $course) }}" class="text-indigo-600 hover:text-indigo-800 font-bold text-sm">Edit</a>
                                    <form action="{{ route('instructor.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold text-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center text-slate-500">
                                You haven't created any courses yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
