<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-6 bg-slate-50 relative overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-violet-100 rounded-full blur-3xl opacity-50"></div>

        <div class="w-full max-w-md relative z-10">
            <div class="text-center mb-10">
                <a href="/" class="inline-flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
                        <span class="text-white text-2xl font-black">E</span>
                    </div>
                    <span class="text-3xl font-bold text-slate-900 tracking-tight">EduPlatform</span>
                </a>
                <h2 class="text-2xl font-extrabold text-slate-900 mb-2">Forgot Password?</h2>
                <p class="text-slate-500 text-sm leading-relaxed">
                    {{ __('No problem. Enter your email and we\'ll send you a reset link.') }}
                </p>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100">
                <!-- Session Status -->
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com" class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-900 placeholder:text-slate-400">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <button type="submit" class="w-full btn-primary-gradient shadow-lg">
                        {{ __('Send Reset Link') }}
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <a href="{{ route('login') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
