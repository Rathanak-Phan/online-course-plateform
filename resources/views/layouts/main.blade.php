<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'EduPlatform - Online Learning')</title>
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-8">
                    <a href="/" class="text-2xl font-bold gradient-text">EduPlatform</a>
                    
                    <div class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-600">
                        <a href="/courses" class="hover:text-indigo-600 transition-colors">Courses</a>
                        <a href="#" class="hover:text-indigo-600 transition-colors">Categories</a>
                        <a href="#" class="hover:text-indigo-600 transition-colors">For Business</a>
                    </div>
                </div>

                <div class="flex-1 max-w-md mx-8 hidden lg:block">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </span>
                        <input type="text" placeholder="Search for courses..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-full bg-slate-50 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        @if(auth()->user()->hasRole('student'))
                            <a href="{{ route('student.my-courses') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600">My Learning</a>
                        @endif
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600">Log in</a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200">Sign up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-16 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12">
                <div class="col-span-2 md:col-span-1">
                    <a href="/" class="text-2xl font-bold text-white mb-6 block">EduPlatform</a>
                    <p class="text-sm leading-relaxed">Empowering learners worldwide with premium courses and industry-leading instructors.</p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Platform</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">All Courses</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Learning Paths</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Mentors</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Success Stories</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Company</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Support</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 mt-16 pt-8 text-sm flex flex-col md:flex-row justify-between items-center gap-4">
                <p>&copy; {{ date('Y') }} EduPlatform. All rights reserved.</p>
                <div class="flex gap-6">
                    <!-- Social Icons Placeholder -->
                    <a href="#" class="hover:text-white"><svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
