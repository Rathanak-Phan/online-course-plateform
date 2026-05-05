<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Certificate - EduPlatform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-2xl w-full bg-white rounded-[3rem] shadow-2xl shadow-indigo-100 overflow-hidden border border-slate-100">
        <div class="bg-indigo-600 p-12 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -ml-32 -mb-32"></div>
            
            <div class="relative z-10">
                <div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-xl">
                    <svg class="w-12 h-12 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                </div>
                <h1 class="text-3xl font-black text-white mb-2 tracking-tight">Verified Certificate</h1>
                <p class="text-indigo-100 font-medium tracking-wide uppercase text-xs">Official Verification Status: Active</p>
            </div>
        </div>

        <div class="p-12">
            <div class="space-y-8">
                <div class="flex items-start gap-6 pb-8 border-b border-slate-50">
                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Student Name</p>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight">{{ $certificate->user->name }}</h2>
                    </div>
                </div>

                <div class="flex items-start gap-6 pb-8 border-b border-slate-50">
                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Course Completed</p>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight">{{ $certificate->course->title }}</h2>
                        <p class="text-slate-500 text-sm font-medium mt-1">Instructor: {{ $certificate->course->instructor->name }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-6 pb-8 border-b border-slate-50">
                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Issue Date</p>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight">{{ $certificate->issued_at->format('F d, Y') }}</h2>
                    </div>
                </div>

                <div class="flex items-start gap-6">
                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04 Pel6 12a11.955 11.955 0 018.618 3.04 Pel6 12z" /></svg>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Certificate ID</p>
                        <p class="text-xs font-mono font-bold text-slate-600 break-all bg-slate-50 p-3 rounded-xl border border-slate-100">{{ $certificate->certificate_hash }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-12 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('home') }}" class="flex-1 bg-slate-900 text-white text-center py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-800 transition-all shadow-xl shadow-slate-100">Browse Our Platform</a>
                <button onclick="window.print()" class="flex-1 bg-white border border-slate-200 text-slate-600 text-center py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-50 transition-all">Print Verification</button>
            </div>
        </div>

        <div class="p-8 bg-slate-50 text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">EduPlatform Verified Credential</p>
        </div>
    </div>
</body>
</html>
