@extends('layouts.instructor')

@section('title', 'My Earnings - EduPlatform Instructor')

@section('content')
<div x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 50)" 
     x-show="shown" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
    
    <div class="mb-12 flex justify-between items-end">
        <div>
            <h1 class="text-4xl font-black text-slate-900 mb-2 tracking-tight">Earnings Overview</h1>
            <p class="text-slate-500 font-medium">Track your platform revenue and payout history.</p>
        </div>
        <div class="bg-white px-8 py-4 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Lifetime Balance</p>
            <h3 class="text-3xl font-black text-indigo-600 tracking-tight">${{ number_format($total_earnings, 2) }}</h3>
        </div>
    </div>

    <!-- Earnings Table -->
    <div class="bg-white rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Transaction ID</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Customer</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Course Purchased</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Amount</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($earnings as $item)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-8 py-6">
                            <span class="text-xs font-black text-slate-900 uppercase">#ORD-{{ $item->order->id }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->order->user->name) }}&background=f8fafc&color=6366f1" class="w-8 h-8 rounded-lg shadow-sm">
                                <span class="text-sm font-bold text-slate-900">{{ $item->order->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-bold text-slate-700">{{ $item->course->title }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-base font-black text-emerald-600">${{ number_format($item->price, 2) }}</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <span class="text-xs font-bold text-slate-400 uppercase">{{ $item->created_at->format('M d, Y') }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <p class="text-slate-400 font-medium">No earnings recorded yet.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($earnings->hasPages())
            <div class="p-8 border-t border-slate-50">
                {{ $earnings->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
