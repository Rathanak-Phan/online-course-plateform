<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Instructor Dashboard - EduPlatform')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 antialiased" x-data="{ sidebarOpen: false }">
    <!-- Sidebar for Mobile -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-40 lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="sidebarOpen = false"></div>
        <div class="fixed inset-y-0 left-0 w-64 bg-slate-900 shadow-2xl flex flex-col p-6">
            <div class="flex items-center justify-between mb-8">
                <a href="/" class="text-xl font-bold text-white">EduPlatform</a>
                <button @click="sidebarOpen = false" class="text-slate-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <nav class="space-y-2">
                @include('layouts.instructor-nav')
            </nav>
        </div>
    </div>

    <!-- Static Sidebar for Desktop -->
    <aside class="hidden lg:flex lg:flex-col lg:fixed lg:inset-y-0 lg:w-64 lg:bg-slate-900">
        <div class="p-8">
            <a href="/" class="text-2xl font-bold text-white">EduPlatform</a>
        </div>
        <nav class="flex-1 px-6 space-y-2">
            @include('layouts.instructor-nav')
        </nav>
        <div class="p-6 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 text-sm font-bold text-slate-400 hover:text-white transition-colors w-full">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="lg:pl-64 flex flex-col min-h-screen">
        <!-- Top Bar -->
        <header class="sticky top-0 z-30 h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-8">
            <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
            </button>
            
            <div class="flex-1 px-4">
                <h2 class="text-lg font-black text-slate-900">Instructor Portal</h2>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('instructor.courses.create') }}" class="hidden sm:block bg-indigo-600 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-indigo-700 transition-all">+ New Course</a>
                <div class="flex items-center gap-3 border-l border-slate-100 pl-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-black text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Instructor</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=1e293b&color=fff" class="w-8 h-8 rounded-lg shadow-sm">
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
