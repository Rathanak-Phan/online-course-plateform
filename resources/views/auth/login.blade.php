<x-guest-layout>
    <div class="flex min-h-screen">
        <!-- Left Side: Visual/Hero -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-indigo-900">
            <div class="absolute inset-0 z-0">
                <img src="/home/rathanak-phan/.gemini/antigravity/brain/6b6d60a3-4fe7-4af6-b4e8-c7b1aca87a7d/auth_background_image_1777868165494.png" alt="Education Background" class="w-full h-full object-cover opacity-60">
                <div class="absolute inset-0 bg-gradient-to-tr from-indigo-900 via-indigo-900/40 to-transparent"></div>
            </div>
            
            <div class="relative z-10 w-full flex flex-col justify-between p-16">
                <div>
                    <a href="/" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-indigo-600 text-2xl font-black">E</span>
                        </div>
                        <span class="text-2xl font-bold text-white tracking-tight">EduPlatform</span>
                    </a>
                </div>

                <div class="animate-float">
                    <div class="inline-block px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-sm font-bold mb-6">Welcome Back</div>
                    <h1 class="text-6xl font-black text-white leading-tight mb-8">
                        Continue Your <br>
                        <span class="text-indigo-300">Learning Journey</span>
                    </h1>
                    <p class="text-xl text-indigo-100/80 max-w-lg leading-relaxed">
                        Access over 1,000+ premium courses and join a community of 25 million learners worldwide.
                    </p>
                </div>

                <div class="flex items-center gap-4 text-indigo-200">
                    <div class="flex -space-x-3">
                        @for($i = 1; $i <= 4; $i++)
                            <img class="h-10 w-10 rounded-full ring-2 ring-indigo-900" src="https://i.pravatar.cc/100?img={{ $i+20 }}" alt="User">
                        @endfor
                    </div>
                    <p class="text-sm font-medium">Join 10k+ students today</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <div class="lg:hidden mb-12">
                    <a href="/" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-2xl font-black">E</span>
                        </div>
                        <span class="text-2xl font-bold text-slate-900 tracking-tight">EduPlatform</span>
                    </a>
                </div>

                <div class="mb-10">
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Login to Account</h2>
                    <p class="text-slate-500">Please enter your details to sign in.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
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

                    <!-- Password -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="text-sm font-bold text-slate-700">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-700">Forgot Password?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </span>
                            <input id="password" type="password" name="password" required placeholder="••••••••" class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-900 placeholder:text-slate-400">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 rounded-lg border-slate-300 text-indigo-600 focus:ring-indigo-500 transition-all cursor-pointer">
                        <label for="remember_me" class="ml-3 text-sm font-medium text-slate-600 cursor-pointer">Remember me for 30 days</label>
                    </div>

                    <div>
                        <button type="submit" class="w-full btn-primary-gradient shadow-xl">
                            Sign In to Account
                        </button>
                    </div>

                    <div class="relative py-4">
                        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-100"></div></div>
                        <div class="relative flex justify-center text-sm"><span class="px-4 bg-white text-slate-400 font-medium">Or continue with</span></div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" class="flex items-center justify-center gap-3 px-4 py-3 border border-slate-200 rounded-2xl hover:bg-slate-50 transition-all font-bold text-slate-700">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
                            Google
                        </button>
                        <button type="button" class="flex items-center justify-center gap-3 px-4 py-3 border border-slate-200 rounded-2xl hover:bg-slate-50 transition-all font-bold text-slate-700">
                            <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" class="w-5 h-5" alt="Facebook">
                            Facebook
                        </button>
                    </div>
                </form>

                <p class="mt-10 text-center text-slate-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:text-indigo-700">Create account</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
