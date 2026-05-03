<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Student Dashboard - EduPlatform')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 antialiased" x-data="{ sidebarOpen: false }">
    <!-- Sidebar for Mobile -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-40 lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="sidebarOpen = false"></div>
        <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-2xl flex flex-col p-6">
            <div class="flex items-center justify-between mb-8">
                <a href="/" class="text-xl font-bold gradient-text">EduPlatform</a>
                <button @click="sidebarOpen = false" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <nav class="space-y-2">
                @include('layouts.student-nav')
            </nav>
        </div>
    </div>

    <!-- Static Sidebar for Desktop -->
    <aside class="hidden lg:flex lg:flex-col lg:fixed lg:inset-y-0 lg:w-64 lg:bg-white lg:border-r lg:border-slate-200">
        <div class="p-8">
            <a href="/" class="text-2xl font-bold gradient-text">EduPlatform</a>
        </div>
        <nav class="flex-1 px-6 space-y-2">
            @include('layouts.student-nav')
        </nav>
        <div class="p-6 border-t border-slate-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 text-sm font-bold text-slate-400 hover:text-rose-600 transition-colors w-full">
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
            
            <div class="flex-1 px-4 hidden md:block">
                <div class="relative max-w-sm">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </span>
                    <input type="text" placeholder="Search my courses..." class="block w-full pl-9 pr-3 py-1.5 border border-slate-100 rounded-lg bg-slate-50 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button class="p-2 text-slate-400 hover:text-slate-600 relative">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                </button>
                <div class="flex items-center gap-3 ml-2 border-l border-slate-100 pl-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-black text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Student</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff" class="w-8 h-8 rounded-lg shadow-sm">
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
