@extends('layouts.admin')

@section('title', 'Financial Transactions - EduPlatform Admin')

@section('content')
<div x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 50)" 
     x-show="shown" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
    
    <div class="mb-12 flex justify-between items-end">
        <div>
            <h1 class="text-4xl font-black text-slate-900 mb-2 tracking-tight">Transactions</h1>
            <p class="text-slate-500 font-medium">History of all platform sales and enrollments.</p>
        </div>
        <div class="flex gap-4">
            <button class="px-5 py-3 bg-white border border-slate-100 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 transition-all shadow-sm">
                Export CSV
            </button>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="bg-white rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">ID / Date</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Customer</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Amount</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Method</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($orders as $order)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-8 py-6">
                            <p class="text-sm font-black text-slate-900 group-hover:text-indigo-600 transition-colors">#{{ $order->id }}</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">{{ $order->created_at->format('M d, Y • H:i') }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($order->user->name) }}&background=f8fafc&color=6366f1" class="w-10 h-10 rounded-xl">
                                <div>
                                    <p class="text-sm font-black text-slate-900">{{ $order->user->name }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">{{ $order->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-base font-black text-slate-900">${{ number_format($order->total_amount, 2) }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full {{ $order->payment_method === 'stripe' ? 'bg-indigo-500' : 'bg-slate-400' }}"></div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-600">{{ $order->payment_method ?? 'Unknown' }}</p>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <span class="inline-block px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest {{ $order->status === 'completed' ? 'bg-emerald-50 text-emerald-600' : ($order->status === 'pending' ? 'bg-amber-50 text-amber-600' : 'bg-rose-50 text-rose-600') }}">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <p class="text-slate-400 font-medium">No transactions recorded yet.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($orders->hasPages())
            <div class="p-8 border-t border-slate-50">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
