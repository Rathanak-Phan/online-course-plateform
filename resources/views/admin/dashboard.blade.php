@extends('layouts.admin')

@section('title', 'System Overview - EduPlatform Admin')

@section('content')
    <div class="mb-12">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-2">System Dashboard</h1>
        <p class="text-slate-500 font-medium">Global overview of your educational platform's performance.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm group hover:border-indigo-200 transition-all">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Users</p>
            </div>
            <h3 class="text-3xl font-black text-slate-900">{{ number_format($stats['total_users']) }}</h3>
        </div>
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm group hover:border-indigo-200 transition-all">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Courses</p>
            </div>
            <h3 class="text-3xl font-black text-slate-900">{{ number_format($stats['total_courses']) }}</h3>
        </div>
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm group hover:border-indigo-200 transition-all">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-amber-50 rounded-xl text-amber-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Revenue</p>
            </div>
            <h3 class="text-3xl font-black text-slate-900">${{ number_format($stats['total_revenue'], 2) }}</h3>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-12">
        <!-- Recent Users -->
        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-black text-slate-900">Recent Users</h2>
                <a href="{{ route('admin.users.index') }}" class="text-indigo-600 font-bold text-sm hover:underline">Manage All</a>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="divide-y divide-slate-100">
                    @foreach($stats['recent_users'] as $user)
                        <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                            <div class="flex items-center gap-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f1f5f9&color=64748b" class="w-10 h-10 rounded-full">
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $user->role_id == 1 ? 'bg-rose-100 text-rose-600' : ($user->role_id == 2 ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-600') }}">
                                {{ $user->role->name ?? 'Student' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="space-y-6">
            <h2 class="text-xl font-black text-slate-900">Latest Transactions</h2>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="divide-y divide-slate-100">
                    @forelse($stats['recent_orders'] as $order)
                        <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                            <div>
                                <p class="text-sm font-bold text-slate-900">Order #{{ $order->id }}</p>
                                <p class="text-xs text-slate-400">{{ $order->user->name }} • {{ $order->created_at->format('M d, H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-black text-slate-900">${{ number_format($order->total_amount, 2) }}</p>
                                <span class="text-[10px] font-bold text-emerald-500 uppercase">{{ $order->status }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="p-12 text-center text-slate-400 text-sm">No transactions yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
