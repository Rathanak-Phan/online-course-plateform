@extends('layouts.admin')

@section('title', 'Platform Settings - EduPlatform Admin')

@section('content')
<div class="max-w-4xl" 
     x-data="{ activeTab: 'general' }"
     x-init="setTimeout(() => $el.classList.add('opacity-100'), 50)"
     class="opacity-0 transition-opacity duration-700">
    
    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 mb-2 tracking-tight">Platform Settings</h1>
        <p class="text-slate-500 font-medium">Global configuration for your learning ecosystem.</p>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl font-bold flex items-center gap-3 animate-in fade-in slide-in-from-top-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
        <!-- Tabs Sidebar -->
        <div class="space-y-2">
            <button @click="activeTab = 'general'" :class="activeTab === 'general' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-100'" class="w-full text-left px-5 py-3 rounded-xl font-black text-xs uppercase tracking-widest transition-all">
                General
            </button>
            <button @click="activeTab = 'payment'" :class="activeTab === 'payment' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-100'" class="w-full text-left px-5 py-3 rounded-xl font-black text-xs uppercase tracking-widest transition-all">
                Payment
            </button>
            <button @click="activeTab = 'instructor'" :class="activeTab === 'instructor' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-100'" class="w-full text-left px-5 py-3 rounded-xl font-black text-xs uppercase tracking-widest transition-all">
                Instructors
            </button>
        </div>

        <!-- Form Content -->
        <div class="md:col-span-3">
            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
                @csrf
                
                <!-- General Settings -->
                <div x-show="activeTab === 'general'" x-transition class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 space-y-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Platform Name</label>
                        <input type="text" name="platform_name" value="{{ $settings['platform_name'] }}" 
                               class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 font-bold text-slate-900 focus:border-indigo-500 transition-all outline-none">
                    </div>
                </div>

                <!-- Payment Settings -->
                <div x-show="activeTab === 'payment'" x-transition class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 space-y-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Default Payment Mode</label>
                        <select name="payment_mode" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 font-bold text-slate-900 focus:border-indigo-500 transition-all outline-none appearance-none">
                            <option value="fake" {{ $settings['payment_mode'] === 'fake' ? 'selected' : '' }}>Demo / Fake (No real money)</option>
                            <option value="stripe" {{ $settings['payment_mode'] === 'stripe' ? 'selected' : '' }}>Stripe Live</option>
                        </select>
                    </div>
                    
                    <div class="p-6 bg-amber-50 rounded-3xl border border-amber-100">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600 shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-black text-amber-900 text-xs uppercase tracking-widest mb-1">Configuration Note</h4>
                                <p class="text-amber-700 text-xs font-medium leading-relaxed">Switching to Stripe Live requires valid API keys in your .env file.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Instructor Settings -->
                <div x-show="activeTab === 'instructor'" x-transition class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-xl shadow-slate-200/50 space-y-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Platform Commission (%)</label>
                        <div class="relative">
                            <input type="number" name="platform_commission" value="{{ $settings['platform_commission'] }}" 
                                   class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 font-bold text-slate-900 focus:border-indigo-500 transition-all outline-none">
                            <span class="absolute right-6 top-1/2 -translate-y-1/2 font-black text-slate-400">%</span>
                        </div>
                        <p class="text-[10px] text-slate-400 font-bold mt-2 ml-1">Percentage taken from every course sale.</p>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-600 hover:scale-105 active:scale-95 transition-all duration-300 shadow-xl shadow-slate-200">
                        Save Configuration
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
