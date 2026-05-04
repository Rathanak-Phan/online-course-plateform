<x-guest-layout>
    <div class="flex min-h-screen">
        <!-- Left Side: Visual/Hero -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-indigo-900">
            <div class="absolute inset-0 z-0">
                <img src="/home/rathanak-phan/.gemini/antigravity/brain/6b6d60a3-4fe7-4af6-b4e8-c7b1aca87a7d/auth_background_image_1777868165494.png" alt="Education Background" class="w-full h-full object-cover opacity-60">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-indigo-900/40 to-transparent"></div>
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
                    <div class="inline-block px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-sm font-bold mb-6">Join Us Today</div>
                    <h1 class="text-6xl font-black text-white leading-tight mb-8">
                        Start Your <br>
                        <span class="text-indigo-300">New Career</span>
                    </h1>
                    <p class="text-xl text-indigo-100/80 max-w-lg leading-relaxed">
                        Create an account to start learning or teaching. Join a global community of experts and students.
                    </p>
                </div>

                <div class="bg-white/10 backdrop-blur-md border border-white/10 p-6 rounded-3xl max-w-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex -space-x-2">
                            @for($i = 1; $i <= 3; $i++)
                                <img class="h-8 w-8 rounded-full ring-2 ring-indigo-800" src="https://i.pravatar.cc/100?img={{ $i+30 }}" alt="User">
                            @endfor
                        </div>
                        <span class="text-sm text-indigo-100 font-bold">500+ New students this week</span>
                    </div>
                    <p class="text-xs text-indigo-200/70">"The best decision I ever made for my professional growth. The courses are top-notch!"</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md py-12">
                <div class="lg:hidden mb-12">
                    <a href="/" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-2xl font-black">E</span>
                        </div>
                        <span class="text-2xl font-bold text-slate-900 tracking-tight">EduPlatform</span>
                    </a>
                </div>

                <div class="mb-10">
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Create Account</h2>
                    <p class="text-slate-500">Join our community and start your journey.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Full Name</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </span>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe" class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-900 placeholder:text-slate-400">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="name@example.com" class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-900 placeholder:text-slate-400">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                            <input id="password" type="password" name="password" required placeholder="••••••••" class="block w-full px-4 py-3.5 bg-slate-50 border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-900 placeholder:text-slate-400">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Confirm</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="••••••••" class="block w-full px-4 py-3.5 bg-slate-50 border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-900 placeholder:text-slate-400">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">I want to be a</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative flex items-center justify-center p-4 border border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 group">
                                <input type="radio" name="role" value="student" class="sr-only" checked>
                                <div class="text-center">
                                    <span class="block text-2xl mb-1">🎓</span>
                                    <span class="block text-sm font-bold text-slate-700 group-has-[:checked]:text-indigo-600">Student</span>
                                </div>
                            </label>
                            <label class="relative flex items-center justify-center p-4 border border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 group">
                                <input type="radio" name="role" value="instructor" class="sr-only">
                                <div class="text-center">
                                    <span class="block text-2xl mb-1">👨‍🏫</span>
                                    <span class="block text-sm font-bold text-slate-700 group-has-[:checked]:text-indigo-600">Instructor</span>
                                </div>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full btn-primary-gradient shadow-xl">
                            Create Free Account
                        </button>
                    </div>
                </form>

                <p class="mt-10 text-center text-slate-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-700">Sign in here</a>
                </p>
                
                <div class="mt-8 pt-8 border-t border-slate-100 text-center">
                    <p class="text-xs text-slate-400 leading-relaxed">
                        By signing up, you agree to our <a href="#" class="underline">Terms of Service</a> and <a href="#" class="underline">Privacy Policy</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
