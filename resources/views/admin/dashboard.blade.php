@extends('layouts.admin')

@section('title', 'System Overview - EduPlatform Admin')

@section('content')
    <div class="flex justify-between items-start mb-12" 
         x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 50)" 
         x-show="shown" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
        <div>
            <h1 class="text-4xl font-black text-slate-900 mb-2 tracking-tight">System Dashboard</h1>
            <p class="text-slate-500 font-medium">Global overview of your educational platform's performance.</p>
        </div>
        
        <!-- Payment Mode Toggle -->
        <div class="bg-white px-6 py-4 rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 flex items-center gap-6 group hover:border-indigo-200 transition-all duration-300">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Payment Mode</p>
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full {{ $stats['payment_mode'] === 'fake' ? 'bg-amber-500 animate-pulse' : 'bg-emerald-500' }}"></div>
                    <span class="font-black text-xs uppercase tracking-widest {{ $stats['payment_mode'] === 'fake' ? 'text-amber-600' : 'text-emerald-600' }}">
                        {{ $stats['payment_mode'] === 'fake' ? 'Demo / Fake' : 'Stripe Live' }}
                    </span>
                </div>
            </div>
            <form action="{{ route('admin.payment-mode.toggle') }}" method="POST">
                @csrf
                <button type="submit" class="px-5 py-2.5 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-600 hover:scale-105 active:scale-95 transition-all duration-300 shadow-lg shadow-slate-200">
                    Switch Mode
                </button>
            </form>
        </div>
    </div>

    <!-- Alert Banner for Pending Items -->
    @if($stats['pending_payments'] > 0 || $stats['pending_courses'] > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 animate-in fade-in slide-in-from-top-4 duration-700">
        @if($stats['pending_payments'] > 0)
            <div class="bg-indigo-600 rounded-[32px] p-6 flex items-center justify-between text-white shadow-xl shadow-indigo-200 group cursor-pointer hover:bg-indigo-700 transition-all">
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-md">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black uppercase tracking-widest opacity-80">Manual Payments</p>
                        <h4 class="text-lg font-black">{{ $stats['pending_payments'] }} Pending Approvals</h4>
                    </div>
                </div>
                <svg class="w-6 h-6 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
            </div>
        @endif
        @if($stats['pending_courses'] > 0)
            <div class="bg-slate-900 rounded-[32px] p-6 flex items-center justify-between text-white shadow-xl shadow-slate-200 group cursor-pointer hover:bg-slate-800 transition-all">
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black uppercase tracking-widest opacity-80">Course Reviews</p>
                        <h4 class="text-lg font-black">{{ $stats['pending_courses'] }} Courses to Review</h4>
                    </div>
                </div>
                <svg class="w-6 h-6 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
            </div>
        @endif
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 group hover:scale-[1.02] hover:shadow-2xl transition-all duration-500">
            <div class="flex items-center gap-6 mb-8">
                <div class="w-16 h-16 bg-indigo-50 rounded-[24px] text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
                <div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Users</p>
                    <h3 class="text-4xl font-black text-slate-900 tracking-tight">{{ number_format($stats['total_users']) }}</h3>
                </div>
            </div>
            <div class="h-1.5 w-full bg-slate-50 rounded-full overflow-hidden">
                <div class="h-full bg-indigo-600 rounded-full" style="width: 70%"></div>
            </div>
        </div>

        <div class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 group hover:scale-[1.02] hover:shadow-2xl transition-all duration-500">
            <div class="flex items-center gap-6 mb-8">
                <div class="w-16 h-16 bg-emerald-50 rounded-[24px] text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Courses</p>
                    <h3 class="text-4xl font-black text-slate-900 tracking-tight">{{ number_format($stats['total_courses']) }}</h3>
                </div>
            </div>
            <div class="h-1.5 w-full bg-slate-50 rounded-full overflow-hidden">
                <div class="h-full bg-emerald-500 rounded-full" style="width: 45%"></div>
            </div>
        </div>

        <div class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 group hover:scale-[1.02] hover:shadow-2xl transition-all duration-500">
            <div class="flex items-center gap-6 mb-8">
                <div class="w-16 h-16 bg-amber-50 rounded-[24px] text-amber-600 flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-all duration-500">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Revenue</p>
                    <h3 class="text-4xl font-black text-slate-900 tracking-tight">${{ number_format($stats['total_revenue'], 2) }}</h3>
                </div>
            </div>
            <div class="h-1.5 w-full bg-slate-50 rounded-full overflow-hidden">
                <div class="h-full bg-amber-500 rounded-full" style="width: 85%"></div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-16">
        <!-- Recent Users -->
        <div class="space-y-8">
            <div class="flex justify-between items-end px-2">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Recent Users</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Latest platform additions</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-slate-50 text-indigo-600 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-50 transition-all">Manage All</a>
            </div>
            <div class="bg-white rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="divide-y divide-slate-50">
                    @foreach($stats['recent_users'] as $user)
                        <div class="p-8 flex items-center justify-between hover:bg-slate-50/50 transition-all group">
                            <div class="flex items-center gap-5">
                                <div class="relative">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f8fafc&color=6366f1" class="w-14 h-14 rounded-2xl shadow-sm">
                                    <div class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full border-4 border-white bg-emerald-500"></div>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-400 font-medium">{{ $user->email }}</p>
                                </div>
                            </div>
                            <span class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm {{ $user->role_id == 1 ? 'bg-rose-50 text-rose-600' : ($user->role_id == 2 ? 'bg-indigo-50 text-indigo-600' : 'bg-slate-50 text-slate-600') }}">
                                {{ $user->role->name ?? 'Student' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="space-y-8">
            <div class="flex justify-between items-end px-2">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Latest Transactions</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Money flow oversight</p>
                </div>
                <a href="#" class="px-4 py-2 bg-slate-50 text-indigo-600 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-50 transition-all">View All</a>
            </div>
            <div class="bg-white rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="divide-y divide-slate-50">
                    @forelse($stats['recent_orders'] as $order)
                        <div class="p-8 flex items-center justify-between hover:bg-slate-50/50 transition-all">
                            <div class="flex items-center gap-5">
                                <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-900">Order #{{ $order->id }}</p>
                                    <p class="text-xs text-slate-400 font-medium">{{ $order->user->name }} • {{ $order->created_at->format('M d, H:i') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-base font-black text-slate-900">${{ number_format($order->total_amount, 2) }}</p>
                                <div class="flex items-center gap-2 justify-end mt-1">
                                    <div class="w-1.5 h-1.5 rounded-full {{ $order->status === 'completed' ? 'bg-emerald-500' : 'bg-amber-500' }}"></div>
                                    <span class="text-[10px] font-black uppercase tracking-widest {{ $order->status === 'completed' ? 'text-emerald-600' : 'text-amber-600' }}">{{ $order->status }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-20 text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-50 rounded-full text-slate-300 mb-6">
                                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 mb-2">No transactions yet</h3>
                            <p class="text-slate-400 font-medium">Platform revenue data will appear here.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
