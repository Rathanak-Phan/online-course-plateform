@extends('layouts.instructor')

@section('title', 'My Students - EduPlatform Instructor')

@section('content')
<div x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 50)" 
     x-show="shown" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
    
    <div class="mb-12 flex justify-between items-end">
        <div>
            <h1 class="text-4xl font-black text-slate-900 mb-2 tracking-tight">Student Community</h1>
            <p class="text-slate-500 font-medium">Manage and track your students' learning progress.</p>
        </div>
    </div>

    <!-- Students Table -->
    <div class="bg-white rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Student</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Enrolled Course</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Enrollment Date</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Progress</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($students as $enrollment)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($enrollment->user->name) }}&background=f8fafc&color=6366f1" class="w-12 h-12 rounded-2xl shadow-sm">
                                <div>
                                    <p class="text-sm font-black text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $enrollment->user->name }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">{{ $enrollment->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-bold text-slate-700">{{ $enrollment->course->title }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-slate-600">{{ $enrollment->created_at->format('M d, Y') }}</p>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <div class="w-24 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-600 rounded-full" style="width: {{ $enrollment->progress ?? 0 }}%"></div>
                                </div>
                                <span class="text-xs font-black text-slate-900">{{ $enrollment->progress ?? 0 }}%</span>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <p class="text-slate-400 font-medium">No students enrolled in your courses yet.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($students->hasPages())
            <div class="p-8 border-t border-slate-50">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
