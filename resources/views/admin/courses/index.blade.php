@extends('layouts.admin')

@section('title', 'Manage Courses - EduPlatform Admin')

@section('content')
    <div class="mb-12 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Course Management</h1>
            <p class="text-slate-500 font-medium">Monitor and manage all courses published on the platform.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-8">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase">
                <tr>
                    <th class="px-8 py-4">Course</th>
                    <th class="px-8 py-4">Instructor</th>
                    <th class="px-8 py-4">Price</th>
                    <th class="px-8 py-4">Sales</th>
                    <th class="px-8 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($courses as $course)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225?text=' . urlencode($course->title) }}" class="w-16 aspect-video rounded object-cover shadow-sm">
                                <p class="text-sm font-bold text-slate-900">{{ $course->title }}</p>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-sm text-slate-600">{{ $course->instructor->name }}</td>
                        <td class="px-8 py-6 text-sm font-black text-slate-900">${{ number_format($course->price, 2) }}</td>
                        <td class="px-8 py-6 text-sm font-medium text-slate-500">{{ $course->enrollments()->count() }}</td>
                        <td class="px-8 py-6">
                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Delete this course permanently?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-6 bg-slate-50 border-t border-slate-200">
            {{ $courses->links() }}
        </div>
    </div>
@endsection
