@extends('layouts.main')

@section('title', 'Secure Checkout - Demo Mode')

@section('content')
<div class="min-h-screen bg-slate-50 py-20">
    <div class="max-w-xl mx-auto px-4">
        <!-- Demo Banner -->
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mb-8 flex items-center gap-4">
            <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
            <div>
                <h4 class="font-black text-amber-900 text-sm uppercase tracking-widest">Demo Mode Active</h4>
                <p class="text-amber-700 text-sm font-medium">No real money will be charged. This is a simulation.</p>
            </div>
        </div>

        <div class="bg-white rounded-[32px] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="p-10 border-b border-slate-50 bg-slate-50/30">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">Payment Details</h1>
                    <div class="flex gap-2">
                        <div class="w-8 h-5 bg-slate-200 rounded-sm"></div>
                        <div class="w-8 h-5 bg-slate-200 rounded-sm"></div>
                        <div class="w-8 h-5 bg-slate-200 rounded-sm"></div>
                    </div>
                </div>

                <div class="flex items-center gap-4 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
                    <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/100x100?text=Course' }}" 
                         class="w-16 h-16 rounded-xl object-cover shadow-sm">
                    <div>
                        <h3 class="font-black text-slate-900 line-clamp-1">{{ $course->title }}</h3>
                        <p class="text-indigo-600 font-black">${{ number_format($course->price, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="p-10">
                <form action="{{ route('payment.fake.process', $course) }}" method="POST" id="fake-payment-form">
                    @csrf
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Cardholder Name</label>
                            <input type="text" value="{{ auth()->user()->name }}" readonly
                                   class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:border-indigo-500 transition-all outline-none">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Card Number</label>
                            <div class="relative">
                                <input type="text" value="**** **** **** 4242" readonly
                                       class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:border-indigo-500 transition-all outline-none">
                                <div class="absolute right-5 top-1/2 -translate-y-1/2 flex gap-2">
                                    <svg class="w-8 h-8 text-indigo-600" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Expiry Date</label>
                                <input type="text" value="12/26" readonly
                                       class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:border-indigo-500 transition-all outline-none">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">CVC</label>
                                <input type="text" value="***" readonly
                                       class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 font-bold text-slate-900 focus:border-indigo-500 transition-all outline-none">
                            </div>
                        </div>
                    </div>

                    <div class="mt-12">
                        <button type="submit" id="pay-button"
                                class="w-full bg-slate-900 text-white font-black py-5 rounded-2xl hover:bg-slate-800 transition-all shadow-xl shadow-slate-200 uppercase tracking-widest flex items-center justify-center gap-3">
                            <span id="button-text">Pay ${{ number_format($course->price, 2) }}</span>
                            <div id="spinner" class="hidden">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </button>
                    </div>
                </form>

                <p class="mt-8 text-center text-xs font-bold text-slate-400 uppercase tracking-widest flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    Secure Demo Payment SSL Encrypted
                </p>
            </div>
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('courses.show', $course) }}" class="text-sm font-black text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-colors">Cancel and return</a>
        </div>
    </div>
</div>

<script>
    document.getElementById('fake-payment-form').addEventListener('submit', function() {
        const button = document.getElementById('pay-button');
        const text = document.getElementById('button-text');
        const spinner = document.getElementById('spinner');

        button.disabled = true;
        button.classList.add('opacity-75', 'cursor-not-allowed');
        text.innerText = 'Processing Demo Payment...';
        spinner.classList.remove('hidden');
    });
</script>
@endsection
