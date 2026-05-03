@extends('layouts.instructor')

@section('title', 'Instructor Dashboard - EduPlatform')

@section('content')
    <div class="mb-12">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Instructor Dashboard</h1>
        <p class="text-slate-500 font-medium">Manage your courses and track your performance.</p>
    </div>

    @php
        $coursesCount = auth()->user()->courses()->count();
        $totalStudents = auth()->user()->courses()->withCount('enrollments')->get()->sum('enrollments_count');
        $totalEarnings = auth()->user()->courses()->withSum('enrollments as total_revenue', 'price')->get()->sum('total_revenue');
    @endphp

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Total Courses</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $coursesCount }}</h3>
            <div class="mt-4 flex items-center text-xs font-bold text-emerald-600">
                <span>+2 this month</span>
            </div>
        </div>
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Total Students</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $totalStudents }}</h3>
            <div class="mt-4 flex items-center text-xs font-bold text-emerald-600">
                <span>+15 new enrollments</span>
            </div>
        </div>
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Total Earnings</p>
            <h3 class="text-3xl font-black text-slate-900">${{ number_format($totalEarnings, 2) }}</h3>
            <div class="mt-4 flex items-center text-xs font-bold text-emerald-600">
                <span>+12% vs last month</span>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-12">
        <!-- Top Performing Courses -->
        <div class="lg:col-span-2 space-y-8">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-black text-slate-900">Your Courses</h2>
                <a href="{{ route('instructor.courses.index') }}" class="text-indigo-600 font-bold text-sm hover:underline">Manage All</a>
            </div>
            
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-400 uppercase">
                        <tr>
                            <th class="px-6 py-4">Course</th>
                            <th class="px-6 py-4">Sales</th>
                            <th class="px-6 py-4">Revenue</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach(auth()->user()->courses()->latest()->take(5)->get() as $course)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225?text=' . urlencode($course->title) }}" class="w-12 aspect-video rounded object-cover">
                                        <span class="text-sm font-bold text-slate-900">{{ $course->title }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-600">{{ $course->enrollments()->count() }}</td>
                                <td class="px-6 py-4 text-sm font-black text-slate-900">${{ number_format($course->enrollments()->count() * $course->price, 2) }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('instructor.courses.edit', $course) }}" class="text-xs font-bold text-indigo-600 hover:underline">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="space-y-8">
            <h2 class="text-xl font-black text-slate-900">Recent Enrollments</h2>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
                @forelse(App\Models\Enrollment::whereIn('course_id', auth()->user()->courses()->pluck('id'))->latest()->take(5)->get() as $enrollment)
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($enrollment->user->name) }}&background=f1f5f9&color=64748b" class="w-10 h-10 rounded-full">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-900 truncate">{{ $enrollment->user->name }}</p>
                            <p class="text-xs text-slate-400 truncate">Enrolled in {{ $enrollment->course->title }}</p>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $enrollment->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="text-center text-slate-400 text-sm py-12">No recent enrollments yet.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
